<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaskBillableTotalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaskBillableTotalsTable Test Case
 */
class TaskBillableTotalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TaskBillableTotalsTable
     */
    protected $TaskBillableTotals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TaskBillableTotals',
        'app.Tasks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TaskBillableTotals') ? [] : ['className' => TaskBillableTotalsTable::class];
        $this->TaskBillableTotals = $this->getTableLocator()->get('TaskBillableTotals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TaskBillableTotals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TaskBillableTotalsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TaskBillableTotalsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
