<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeeTasksFixture
 */
class EmployeeTasksFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'employee_tasks_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'time' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'time submitted', 'precision' => null],
        'billable_time' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Time worked in minutes', 'precision' => null, 'autoIncrement' => null],
        'approval_status' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'no_charge_status' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'employee_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'task_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'client_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_employees_employee_tasks' => ['type' => 'index', 'columns' => ['employee_id'], 'length' => []],
            'fk_tasks_employee_tasks' => ['type' => 'index', 'columns' => ['task_id'], 'length' => []],
            'fk_client_employee_tasks' => ['type' => 'index', 'columns' => ['client_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['employee_tasks_id'], 'length' => []],
            'fk_client_employee_tasks' => ['type' => 'foreign', 'columns' => ['client_id'], 'references' => ['clients', 'client_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_employees_employee_tasks' => ['type' => 'foreign', 'columns' => ['employee_id'], 'references' => ['employees', 'employee_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_tasks_employee_tasks' => ['type' => 'foreign', 'columns' => ['task_id'], 'references' => ['tasks', 'task_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_0900_ai_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'employee_tasks_id' => 1,
                'date' => '2021-08-12',
                'time' => '05:00:32',
                'billable_time' => 1,
                'approval_status' => 1,
                'no_charge_status' => 1,
                'employee_id' => 1,
                'task_id' => 1,
                'client_id' => 1,
            ],
        ];
        parent::init();
    }
}
