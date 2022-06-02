<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeTasksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeTasksTable Test Case
 */
class EmployeeTasksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeTasksTable
     */
    protected $EmployeeTasks;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.EmployeeTasks',
        'app.Employees',
        'app.Tasks',
        'app.Clients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('EmployeeTasks') ? [] : ['className' => EmployeeTasksTable::class];
        $this->EmployeeTasks = $this->getTableLocator()->get('EmployeeTasks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EmployeeTasks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EmployeeTasksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\EmployeeTasksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
