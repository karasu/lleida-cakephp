<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MunicipisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MunicipisTable Test Case
 */
class MunicipisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MunicipisTable
     */
    protected $Municipis;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Municipis',
        'app.Comarques',
        'app.Centres',
        'app.Districtes',
        'app.Localitats',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Municipis') ? [] : ['className' => MunicipisTable::class];
        $this->Municipis = TableRegistry::getTableLocator()->get('Municipis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Municipis);

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
