<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Planet Entity
 *
 * @property int $id
 * @property string $name
 * @property string $climate
 * @property string $diameter
 * @property string $orbital_period
 * @property string $gravity
 * @property string $terrain
 * @property string $population
 *
 * @property \App\Model\Entity\Person[] $people
 * @property \App\Model\Entity\Species[] $species
 */
class Planet extends Entity
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
        'climate' => true,
        'diameter' => true,
        'orbital_period' => true,
        'gravity' => true,
        'terrain' => true,
        'population' => true,
        'people' => true,
        'species' => true,
    ];
}
