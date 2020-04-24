<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EstudisCentresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EstudisCentresTable Test Case
 */
class EstudisCentresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EstudisCentresTable
     */
    protected $EstudisCentres;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.EstudisCentres',
        'app.Centres',
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
        $config = TableRegistry::getTableLocator()->exists('EstudisCentres') ? [] : ['className' => EstudisCentresTable::class];
        $this->EstudisCentres = TableRegistry::getTableLocator()->get('EstudisCentres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EstudisCentres);

        parent::tearDown();
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
