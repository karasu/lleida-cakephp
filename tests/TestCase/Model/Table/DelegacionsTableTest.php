<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DelegacionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DelegacionsTable Test Case
 */
class DelegacionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DelegacionsTable
     */
    protected $Delegacions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Delegacions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Delegacions') ? [] : ['className' => DelegacionsTable::class];
        $this->Delegacions = TableRegistry::getTableLocator()->get('Delegacions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Delegacions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
