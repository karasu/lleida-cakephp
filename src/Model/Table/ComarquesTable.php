<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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

        $this->belongsTo('Delegacions', [
            'foreignKey' => 'delegacio_id',
            'joinType' => 'INNER',
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
}
