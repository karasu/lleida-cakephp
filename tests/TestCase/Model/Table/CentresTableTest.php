<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CentresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CentresTable Test Case
 */
class CentresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CentresTable
     */
    protected $Centres;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Centres',
        'app.Naturaleses',
        'app.Titularitats',
        'app.Municipis',
        'app.Districtes',
        'app.Localitats',
        'app.Estudis',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Centres') ? [] : ['className' => CentresTable::class];
        $this->Centres = TableRegistry::getTableLocator()->get('Centres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Centres);

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
