<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comarca Entity
 *
 * @property int $id
 * @property int $delegacio_id
 * @property string $nom
 *
 * @property \App\Model\Entity\Delegacio $delegacio
 */
class Comarca extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'delegacio_id' => true,
        'nom' => true,
        'delegacio' => true,
    ];
}
