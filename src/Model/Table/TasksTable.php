<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tasks Model
 *
 * @method \App\Model\Entity\Task newEmptyEntity()
 * @method \App\Model\Entity\Task newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Task[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Task get($primaryKey, $options = [])
 * @method \App\Model\Entity\Task findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Task patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Task[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Task|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Task saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TasksTable extends Table
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

        $this->setTable('tasks');
        $this->setDisplayField('task_id');
        $this->setPrimaryKey('task_id');

        $this->hasOne('EmployeeTasks', [
            'foreignKey' => 'task_id',
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
            ->integer('task_id')
            ->allowEmptyString('task_id', null, 'create');

        $validator
            ->scalar('task_name')
            ->maxLength('task_name', 50, __('Please limit the task name to less than 50 characters'))
            ->requirePresence('task_name', 'create')
            ->notEmptyString('task_name');

        $validator
            ->decimal('task_rate')
            ->add('task_rate','custom',[
                'rule' => function ($value, $context) {
                    if ($value >=0){
                        return true;
                    }
                    return false;
                },
                'message' => ' task rate must be a positive number'
            ])
            ->maxLength('task_rate', 8, __('Limit to 8 characters including decimal'))
            ->requirePresence('task_rate', 'create')
            ->notEmptyString('task_rate');


//        ->integer('street_no')
//        ->add('street_no', 'custom',[
//            'rule' => function ($value, $context) {
//                if ($value >= 1) {
//                    return true;
//                }
//
//                return false;
//            },
//
//            'message' => 'street no. must be a positive number'
//
//        ])
//        ->maxLength('street_no', 5, __('Maximum of 5 digits are allowed'))
//        ->requirePresence('street_no', 'create')
//        ->notEmptyString('street_no');


        return $validator;
    }
}
