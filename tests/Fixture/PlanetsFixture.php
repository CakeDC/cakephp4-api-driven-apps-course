<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlanetsFixture
 */
class PlanetsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'climate' => 'Lorem ipsum dolor sit amet',
                'diameter' => 'Lorem ipsum dolor sit amet',
                'orbital_period' => 'Lorem ipsum dolor sit amet',
                'gravity' => 'Lorem ipsum dolor sit amet',
                'terrain' => 'Lorem ipsum dolor sit amet',
                'population' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
