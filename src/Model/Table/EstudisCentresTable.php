<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EstudisCentres Model
 *
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\BelongsTo $Centres
 * @property \App\Model\Table\EstudisTable&\Cake\ORM\Association\BelongsTo $Estudis
 *
 * @method \App\Model\Entity\EstudisCentre newEmptyEntity()
 * @method \App\Model\Entity\EstudisCentre newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre get($primaryKey, $options = [])
 * @method \App\Model\Entity\EstudisCentre findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EstudisCentre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EstudisCentre saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EstudisCentresTable extends Table
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

        $this->setTable('estudis_centres');
        $this->setDisplayField('centre_id');
        $this->setPrimaryKey(['centre_id', 'estudi_id']);

        $this->belongsTo('Centres', [
            'foreignKey' => 'centre_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Estudis', [
            'foreignKey' => 'estudi_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['estudi_id'], 'Estudis'));

        return $rules;
    }
}
