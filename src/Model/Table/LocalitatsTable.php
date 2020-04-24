<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
            ->allowEmptyString('nom')
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
        $rules->add($rules->existsIn(['municipi_id'], 'Municipis'));

        return $rules;
    }
}
