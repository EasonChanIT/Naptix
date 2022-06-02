<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaskBillableTotals Model
 *
 * @property \App\Model\Table\TasksTable&\Cake\ORM\Association\BelongsTo $Tasks
 *
 * @method \App\Model\Entity\TaskBillableTotal newEmptyEntity()
 * @method \App\Model\Entity\TaskBillableTotal newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TaskBillableTotal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaskBillableTotal get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaskBillableTotal findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TaskBillableTotal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaskBillableTotal[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaskBillableTotal|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaskBillableTotal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaskBillableTotal[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TaskBillableTotal[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TaskBillableTotal[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TaskBillableTotal[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TaskBillableTotalsTable extends Table
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

        $this->setTable('task_billable_totals');
        $this->setDisplayField('task_billable_total_id');
        $this->setPrimaryKey('task_billable_total_id');

        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id',
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
            ->integer('task_billable_total_id')
            ->allowEmptyString('task_billable_total_id', null, 'create');

        $validator
            ->integer('task_total')
            ->requirePresence('task_total', 'create')
            ->notEmptyString('task_total');

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
        $rules->add($rules->existsIn(['task_id'], 'Tasks'), ['errorField' => 'task_id']);

        return $rules;
    }
}
