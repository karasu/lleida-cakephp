<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NaturalesesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NaturalesesTable Test Case
 */
class NaturalesesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NaturalesesTable
     */
    protected $Naturaleses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Naturaleses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Naturaleses') ? [] : ['className' => NaturalesesTable::class];
        $this->Naturaleses = TableRegistry::getTableLocator()->get('Naturaleses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Naturaleses);

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
