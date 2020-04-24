<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DistrictesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DistrictesTable Test Case
 */
class DistrictesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DistrictesTable
     */
    protected $Districtes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Districtes',
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
        $config = TableRegistry::getTableLocator()->exists('Districtes') ? [] : ['className' => DistrictesTable::class];
        $this->Districtes = TableRegistry::getTableLocator()->get('Districtes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Districtes);

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
