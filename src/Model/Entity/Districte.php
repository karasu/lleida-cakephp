<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Districte Entity
 *
 * @property string $id
 * @property string $municipi_id
 * @property string $nom
 *
 * @property \App\Model\Entity\Municipi $municipi
 * @property \App\Model\Entity\Centre[] $centres
 */
class Districte extends Entity
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
        'municipi_id' => true,
        'nom' => true,
        'municipi' => true,
        'centres' => true,
    ];
}
