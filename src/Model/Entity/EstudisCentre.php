<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EstudisCentre Entity
 *
 * @property int $centre_id
 * @property string $estudi_id
 *
 * @property \App\Model\Entity\Centre $centre
 * @property \App\Model\Entity\Estudi $estudi
 */
class EstudisCentre extends Entity
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
        'centre' => true,
        'estudi' => true,
    ];
}
