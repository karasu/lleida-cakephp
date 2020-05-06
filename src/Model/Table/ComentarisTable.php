<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comentaris Model
 *
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\BelongsTo $Centres
 *
 * @method \App\Model\Entity\Comentari newEmptyEntity()
 * @method \App\Model\Entity\Comentari newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Comentari[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Comentari get($primaryKey, $options = [])
 * @method \App\Model\Entity\Comentari findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Comentari patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Comentari[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Comentari|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comentari saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comentari[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comentari[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comentari[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comentari[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ComentarisTable extends Table
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

        $this->setTable('comentaris');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Centres', [
            'foreignKey' => 'centre_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('Timestamp');
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
            ->scalar('text')
            ->requirePresence('text', 'create')
            ->notEmptyString('text');

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
        $rules->add($rules->existsIn(['centre_id'], 'Centres'));

        return $rules;
    }
}
