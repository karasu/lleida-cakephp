<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use \SplFileObject;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Comarques Model
 *
 * @property \App\Model\Table\DelegacionsTable&\Cake\ORM\Association\BelongsTo $Delegacions
 *
 * @method \App\Model\Entity\Comarca newEmptyEntity()
 * @method \App\Model\Entity\Comarca newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Comarca[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Comarca get($primaryKey, $options = [])
 * @method \App\Model\Entity\Comarca findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Comarca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Comarca[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Comarca|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comarca saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comarca[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comarca[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comarca[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comarca[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ComarquesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('comarques');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->setEntityClass('App\Model\Entity\Comarca');

        $this->belongsTo('Delegacions', [
            'foreignKey' => 'delegacio_id',
            'joinType' => 'INNER',
            'propertyName' => 'delegacio',
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom')
            ->add('nom', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['nom']));
        $rules->add($rules->existsIn(['delegacio_id'], 'Delegacions'));

        return $rules;
    }

    public function import($uploadedFile) : bool
    {
        // Check that the upload was ok and the uploaded file is a csv one
        if ($uploadedFile->getError() != 0 || $uploadedFile->getClientMediaType() != 'text/csv')
        {
            return false;
        }

        // move file
        $filename = '/tmp/lleida-import.csv';
        $uploadedFile->moveTo($filename);

        // open file
        $file = new SplFileObject($filename);
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        $file->setCsvControl(';');

        $header = $file->fgetcsv();
        $processed_noms = array();

        while (!$file->eof()) {
            $row = $file->fgetcsv();
            // for each header field 
 			foreach ($header as $k=>$head) {
                $head = mb_convert_encoding($head, "UTF-8", "ISO-8859-1");
                if (isset($row[$k])) {
                    if ($head == 'Codi delegació') {
                        $delegacio_id = intval(mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1"));
                    } else if ($head == 'Codi comarca') {
                        $id = intval(mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1"));
                    } else if ($head == 'Nom comarca') {
                        $nom = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                    }
                }
            }

            if (!in_array($nom, $processed_noms) && isset($delegacio_id) && isset($id) && isset($nom)) {              
                $processed_noms[] = $nom;
                try {
                    $comarca = $this->get($id);
                } catch (RecordNotFoundException $e) {
                    $comarca = $this->newEmptyEntity();
                    $comarca->id = $id;
                }
                
                $comarca->nom = $nom;
                $comarca->delegacio_id = $delegacio_id;

                if (!$this->save($comarca)) {
                    // No podem guardar el registre. Error!
                    debug($comarca->getErrors());
                    $file = null;
                    return false;
                }
            }
        }
        $file = null;
        return true;
    }
}
