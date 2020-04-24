<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Estudi Entity
 *
 * @property int $id
 * @property string|null $codi
 * @property string|null $nom
 *
 * @property \App\Model\Entity\Centre[] $centres
 */
class Estudi extends Entity
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
        'codi' => true,
        'nom' => true,
        'centres' => true,
    ];
}
