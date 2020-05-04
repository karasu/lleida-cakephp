<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComentarisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComentarisTable Test Case
 */
class ComentarisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComentarisTable
     */
    protected $Comentaris;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Comentaris',
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
        $config = TableRegistry::getTableLocator()->exists('Comentaris') ? [] : ['className' => ComentarisTable::class];
        $this->Comentaris = TableRegistry::getTableLocator()->get('Comentaris', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Comentaris);

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
