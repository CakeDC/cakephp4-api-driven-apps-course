<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Species Entity
 *
 * @property int $id
 * @property string $name
 * @property string $classification
 * @property string $designation
 * @property string $average_height
 * @property string $average_lifespan
 * @property string $language
 * @property int $planet_id
 *
 * @property \App\Model\Entity\Planet $planet
 * @property \App\Model\Entity\Person[] $people
 */
class Species extends Entity
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
        'classification' => true,
        'designation' => true,
        'average_height' => true,
        'average_lifespan' => true,
        'language' => true,
        'planet_id' => true,
        'planet' => true,
        'people' => true,
    ];
}
