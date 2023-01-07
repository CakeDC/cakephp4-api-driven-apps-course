<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PeopleFixture
 */
class PeopleFixture extends TestFixture
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
                'birth_year' => 'Lorem ipsum dolor sit amet',
                'eye_color' => 'Lorem ipsum dolor sit amet',
                'hair_color' => 'Lorem ipsum dolor sit amet',
                'height' => 'Lorem ipsum dolor sit amet',
                'mass' => 'Lorem ipsum dolor sit amet',
                'planet_id' => 1,
                'species_id' => 1,
            ],
        ];
        parent::init();
    }
}
