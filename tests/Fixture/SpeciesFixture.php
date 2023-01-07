<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SpeciesFixture
 */
class SpeciesFixture extends TestFixture
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
                'classification' => 'Lorem ipsum dolor sit amet',
                'designation' => 'Lorem ipsum dolor sit amet',
                'average_height' => 'Lorem ipsum dolor sit amet',
                'average_lifespan' => 'Lorem ipsum dolor sit amet',
                'language' => 'Lorem ipsum dolor sit amet',
                'planet_id' => 1,
            ],
        ];
        parent::init();
    }
}
