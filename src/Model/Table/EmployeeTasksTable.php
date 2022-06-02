<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeTasks Model
 *
 * @property \App\Model\Table\EmployeesTable&\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\TasksTable&\Cake\ORM\Association\BelongsTo $Tasks
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\EmployeeTask newEmptyEntity()
 * @method \App\Model\Entity\EmployeeTask newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTask[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTask get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeTask findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EmployeeTask patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTask[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTask|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeTask saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeTask[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeTask[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeTask[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeTask[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EmployeeTasksTable extends Table
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

        $this->setTable('employee_tasks');
        $this->setDisplayField('employee_tasks_id');
        $this->setPrimaryKey('employee_tasks_id');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
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
            ->integer('employee_tasks_id')
            ->allowEmptyString('employee_tasks_id', null, 'create');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->time('time')
            ->requirePresence('time', 'create')
            ->notEmptyTime('time');

        $validator
            ->integer('billable_time')
            ->requirePresence('billable_time', 'create')
            ->add('billable_time','custom',[
                'rule' => function ($value, $context) {
                   if ($value >=0){
                    return true;
                  }
                return false;
            },
            'message' => 'billable time must be a positive number'
             ])
            ->MinLength('billable_time', 1, __('Please add the time worked'))
            ->MaxLength('billable_time', 3, __('Please limit the time worked to under under 999 minutes'))
            ->notEmptyString('billable_time');

        $validator
            ->boolean('approval_status')
            ->allowEmptyString('approval_status');

        $validator
            ->boolean('no_charge_status')
            ->allowEmptyString('no_charge_status');

        $validator
            ->decimal('subtotal')
            ->add('subtotal','custom',[
                'rule' => function ($value, $context) {
                    if ($value >=0){
                        return true;
                    }
                    return false;
                },
                'message' => 'subtotal must be a positive number'
            ])
            ->maxLength('task_rate', 8, __('Limit the subtotal to 8 characters including decimal'))
            ->allowEmptyString('subtotal', null);

        $validator
            ->boolean('invoice_status')
            ->allowEmptyString('invoice_status');

        $validator
            ->scalar('task_description')
            ->maxLength('task_description', 250, __('Please limit description to 250 characters'))
            ->allowEmptyString('task_description', null);

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
        $rules->add($rules->existsIn(['employee_id'], 'Employees'), ['errorField' => 'employee_id']);
        $rules->add($rules->existsIn(['task_id'], 'Tasks'), ['errorField' => 'task_id']);
        $rules->add($rules->existsIn(['client_id'], 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }
}
