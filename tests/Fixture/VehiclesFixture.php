<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VehiclesFixture
 */
class VehiclesFixture extends TestFixture
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
                'manufacturer' => 'Lorem ipsum dolor sit amet',
                'model' => 'Lorem ipsum dolor sit amet',
                'vehicle_class' => 'Lorem ipsum dolor sit amet',
                'passengers' => 'Lorem ipsum dolor sit amet',
                'crew' => 'Lorem ipsum dolor sit amet',
                'cargo_capacity' => 'Lorem ipsum dolor sit amet',
                'owner_id' => 1,
            ],
        ];
        parent::init();
    }
}
