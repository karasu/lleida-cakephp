<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Municipi Entity
 *
 * @property string $id
 * @property int $comarca_id
 * @property string $nom
 *
 * @property \App\Model\Entity\Comarca $comarca
 * @property \App\Model\Entity\Centre[] $centres
 * @property \App\Model\Entity\Districte[] $districtes
 * @property \App\Model\Entity\Localitat[] $localitats
 */
class Municipi extends Entity
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
        'comarca_id' => true,
        'nom' => true,
        'comarca' => true,
        'centres' => true,
        'districtes' => true,
        'localitats' => true,
    ];
}
