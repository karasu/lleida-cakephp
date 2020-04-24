<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TitularitatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TitularitatsTable Test Case
 */
class TitularitatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TitularitatsTable
     */
    protected $Titularitats;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Titularitats',
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
        $config = TableRegistry::getTableLocator()->exists('Titularitats') ? [] : ['className' => TitularitatsTable::class];
        $this->Titularitats = TableRegistry::getTableLocator()->get('Titularitats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Titularitats);

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
