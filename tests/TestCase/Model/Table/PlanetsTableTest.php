<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanetsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanetsTable Test Case
 */
class PlanetsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanetsTable
     */
    protected $Planets;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Planets',
        'app.People',
        'app.Species',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Planets') ? [] : ['className' => PlanetsTable::class];
        $this->Planets = $this->getTableLocator()->get('Planets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Planets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlanetsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
