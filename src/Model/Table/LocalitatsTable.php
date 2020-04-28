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
 * Localitats Model
 *
 * @property \App\Model\Table\MunicipisTable&\Cake\ORM\Association\BelongsTo $Municipis
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\HasMany $Centres
 *
 * @method \App\Model\Entity\Localitat newEmptyEntity()
 * @method \App\Model\Entity\Localitat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Localitat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Localitat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Localitat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Localitat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Localitat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Localitat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Localitat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Localitat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Localitat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Localitat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Localitat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LocalitatsTable extends Table
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

        $this->setTable('localitats');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Municipis', [
            'foreignKey' => 'municipi_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Centres', [
            'foreignKey' => 'localitat_id',
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
            ->scalar('id')
            ->maxLength('id', 2)
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->allowEmptyString('nom');
            // ->add('nom', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        // $rules->add($rules->isUnique(['nom']));
        $rules->add($rules->existsIn(['municipi_id'], 'Municipis'));

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
        $processed_codis = array();

        while (!$file->eof()) {
            $row = $file->fgetcsv();
            // for each header field 
 			foreach ($header as $k=>$head) {
                $head = mb_convert_encoding($head, "UTF-8", "ISO-8859-1");
                if (isset($row[$k])) {
                    $value = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                    if ($head == 'Codi municipi') {
                        $municipi_id = $value;
                    } else if ($head == 'Codi localitat') {
                        $codi = intval($value);
                    } else if ($head == 'Nom localitat') {
                        $nom = $value;
                    }
                }
            }

            //debug($municipi_id);

            // Només guardem aquelles localitats diferents del municipi
            if (!in_array($codi, $processed_codis) && isset($municipi_id) && isset($codi) && isset($nom) && $codi != 1) {
                $processed_codis[] = $codi;
                try {
                    //$localitat = $this->get($id);
                    $query = $this->find('all')
                        ->where(['Localitats.codi =' => $codi, 'Localitats.municipi_id =' => $municipi_id])
                        ->limit(1);
                    $olddata = $query->toArray();
                    if (!empty($olddata)) {
                        // debug($olddata);
                        $localitat = $this->get($olddata[0]['id']);
                    }
                    else {
                        $localitat = $this->newEmptyEntity();
                    }
                } catch (RecordNotFoundException $e) {
                    $localitat = $this->newEmptyEntity();
                    $localitat->id = $id;
                }

                $localitat->codi = $codi;
                $localitat->nom = $nom;
                $localitat->municipi_id = $municipi_id;

                if (!$this->save($localitat)) {
                    // No podem guardar el registre. Error!
                    debug($localitat->getErrors());
                    $file = null;
                    return false;
                }
            }
        }
        $file = null;
        return true;
    }
}
