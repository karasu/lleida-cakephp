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
 * Titularitats Model
 *
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\HasMany $Centres
 *
 * @method \App\Model\Entity\Titularitat newEmptyEntity()
 * @method \App\Model\Entity\Titularitat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Titularitat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Titularitat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Titularitat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Titularitat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Titularitat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Titularitat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Titularitat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Titularitat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Titularitat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Titularitat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Titularitat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TitularitatsTable extends Table
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

        $this->setTable('titularitats');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Centres', [
            'foreignKey' => 'titularitat_id',
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

        while (!$file->eof()) {
            $row = $file->fgetcsv();
            // for each header field 
 			foreach ($header as $k=>$head) {
                $head = mb_convert_encoding($head, "UTF-8", "ISO-8859-1");
                if ($head == 'Codi titularitat' && isset($row[$k])) {
                    $id = intval(mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1"));
                }
                else if ($head == 'Nom titularitat' && isset($row[$k])) {
                   $nom = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                }
            }

            if (isset($id) && isset($nom)) {              
                try {
                    $titularitat = $this->get($id);
                } catch (RecordNotFoundException $e) {
                    $titularitat = $this->newEmptyEntity();
                    $titularitat->id = $id;
                }
                
                $titularitat->nom = $nom;

                if (!$this->save($titularitat)) {
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
