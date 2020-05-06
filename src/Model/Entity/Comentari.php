<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comentari Entity
 *
 * @property int $id
 * @property int $centre_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $text
 *
 * @property \App\Model\Entity\Centre $centre
 */
class Comentari extends Entity
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
        'centre_id' => true,
        'created' => true,
        'modified' => true,
        'text' => true,
        'centre' => true,
    ];
}
