<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientBillingTotalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientBillingTotalsTable Test Case
 */
class ClientBillingTotalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientBillingTotalsTable
     */
    protected $ClientBillingTotals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ClientBillingTotals',
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
        $config = $this->getTableLocator()->exists('ClientBillingTotals') ? [] : ['className' => ClientBillingTotalsTable::class];
        $this->ClientBillingTotals = $this->getTableLocator()->get('ClientBillingTotals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ClientBillingTotals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientBillingTotalsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientBillingTotalsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
