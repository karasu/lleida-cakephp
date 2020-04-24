<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EstudisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EstudisTable Test Case
 */
class EstudisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EstudisTable
     */
    protected $Estudis;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Estudis',
        'app.Centres',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Estudis') ? [] : ['className' => EstudisTable::class];
        $this->Estudis = TableRegistry::getTableLocator()->get('Estudis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Estudis);

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
