<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Person Entity
 *
 * @property int $id
 * @property string $name
 * @property string $birth_year
 * @property string $eye_color
 * @property string $hair_color
 * @property string $height
 * @property string $mass
 * @property int $planet_id
 * @property int $species_id
 *
 * @property \App\Model\Entity\Planet $planet
 */
class Person extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'birth_year' => true,
        'eye_color' => true,
        'hair_color' => true,
        'height' => true,
        'mass' => true,
        'planet_id' => true,
        'species_id' => true,
        'planet' => true,
    ];
}
