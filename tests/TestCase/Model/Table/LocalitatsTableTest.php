<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocalitatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocalitatsTable Test Case
 */
class LocalitatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LocalitatsTable
     */
    protected $Localitats;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Localitats',
        'app.Municipis',
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
        $config = TableRegistry::getTableLocator()->exists('Localitats') ? [] : ['className' => LocalitatsTable::class];
        $this->Localitats = TableRegistry::getTableLocator()->get('Localitats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Localitats);

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
