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
 * Naturaleses Model
 *
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\HasMany $Centres
 * 
 * @method \App\Model\Entity\Naturalesa newEmptyEntity()
 * @method \App\Model\Entity\Naturalesa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Naturalesa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Naturalesa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Naturalesa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Naturalesa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Naturalesa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Naturalesa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Naturalesa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Naturalesa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Naturalesa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Naturalesa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Naturalesa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class NaturalesesTable extends Table
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

        $this->setEntityClass('App\Model\Entity\Naturalesa');

        $this->setTable('naturaleses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Centres', [
            'foreignKey' => 'naturalesa_id',
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
        $processed_ids = array();
        while (!$file->eof()) {
            $row = $file->fgetcsv();
            // for each header field 
 			foreach ($header as $k=>$head) {
                if (isset($row[$k])) {
                    $head = mb_convert_encoding($head, "UTF-8", "ISO-8859-1");                
                    if ($head == 'Codi naturalesa') {
                        $id = intval(mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1"));
                    }
                    else if ($head == 'Nom naturalesa') {
                        $nom = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                    }
                }
            }

            if (!in_array($id, $processed_ids) && isset($id) && isset($nom)) {
                $processed_ids[] = $id;
                try {
                    $naturalesa = $this->get($id);
                } catch (RecordNotFoundException $e) {
                    $naturalesa = $this->newEmptyEntity();
                    $naturalesa->id = $id;
                }
                
                $naturalesa->nom = $nom;

                if (!$this->save($naturalesa)) {
                    // No podem guardar el registre. Error!
                    $file = null;
                    return false;
                }
            }
        }
        $file = null;
        return true;
    }
}
