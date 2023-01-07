<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vehicle Entity
 *
 * @property int $id
 * @property string $name
 * @property string $manufacturer
 * @property string $model
 * @property string $vehicle_class
 * @property string $passengers
 * @property string $crew
 * @property string $cargo_capacity
 * @property int $owner_id
 *
 * @property \App\Model\Entity\Person $person
 */
class Vehicle extends Entity
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
        'manufacturer' => true,
        'model' => true,
        'vehicle_class' => true,
        'passengers' => true,
        'crew' => true,
        'cargo_capacity' => true,
        'owner_id' => true,
        'person' => true,
    ];
}
