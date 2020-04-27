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
 * Municipis Model
 *
 * @property \App\Model\Table\ComarquesTable&\Cake\ORM\Association\BelongsTo $Comarques
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\HasMany $Centres
 * @property \App\Model\Table\DistrictesTable&\Cake\ORM\Association\HasMany $Districtes
 * @property \App\Model\Table\LocalitatsTable&\Cake\ORM\Association\HasMany $Localitats
 *
 * @method \App\Model\Entity\Municipi newEmptyEntity()
 * @method \App\Model\Entity\Municipi newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Municipi[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Municipi get($primaryKey, $options = [])
 * @method \App\Model\Entity\Municipi findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Municipi patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Municipi[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Municipi|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Municipi saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Municipi[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Municipi[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Municipi[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Municipi[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MunicipisTable extends Table
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

        $this->setTable('municipis');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Comarques', [
            'foreignKey' => 'comarca_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Centres', [
            'foreignKey' => 'municipi_id',
        ]);
        $this->hasMany('Districtes', [
            'foreignKey' => 'municipi_id',
        ]);
        $this->hasMany('Localitats', [
            'foreignKey' => 'municipi_id',
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
            ->maxLength('id', 5)
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
        $rules->add($rules->existsIn(['comarca_id'], 'Comarques'));

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
                if ($head == 'Codi comarca' && isset($row[$k])) {
                    $comarca_id = intval(mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1"));
                } else if ($head == 'Codi municipi' && isset($row[$k])) {
                    $id = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                } else if ($head == 'Nom municipi' && isset($row[$k])) {
                   $nom = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                }
            }

            if (isset($comarca_id) && isset($id) && isset($nom)) {              
                try {
                    $municipi = $this->get($id);
                } catch (RecordNotFoundException $e) {
                    $municipi = $this->newEmptyEntity();
                    $municipi->id = $id;
                }
                
                $municipi->nom = $nom;
                $municipi->comarca_id = $comarca_id;

                if (!$this->save($municipi)) {
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
