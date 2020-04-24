<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Estudis Model
 *
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\BelongsToMany $Centres
 *
 * @method \App\Model\Entity\Estudi newEmptyEntity()
 * @method \App\Model\Entity\Estudi newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Estudi[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Estudi get($primaryKey, $options = [])
 * @method \App\Model\Entity\Estudi findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Estudi patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Estudi[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Estudi|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Estudi saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Estudi[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Estudi[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Estudi[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Estudi[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EstudisTable extends Table
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

        $this->setTable('estudis');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Centres', [
            'foreignKey' => 'estudi_id',
            'targetForeignKey' => 'centre_id',
            'joinTable' => 'estudis_centres',
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
            ->scalar('codi')
            ->maxLength('codi', 8)
            ->allowEmptyString('codi')
            ->add('codi', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->allowEmptyString('nom');

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
        $rules->add($rules->isUnique(['codi']));

        return $rules;
    }
}
