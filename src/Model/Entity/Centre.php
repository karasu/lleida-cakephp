<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Centre Entity
 *
 * @property int $id
 * @property string $codi
 * @property string $denominacio_completa
 * @property int $naturalesa_id
 * @property int $titularitat_id
 * @property string $adreca
 * @property string $codi_postal
 * @property string $telefon
 * @property string $fax
 * @property string $municipi_id
 * @property string|null $districte_id
 * @property string|null $localitat_id
 * @property string|null $zona_educativa
 * @property float $coordenades_utm_x
 * @property float $coordenades_utm_y
 * @property float $coordenades_geo_x
 * @property float $coordenades_geo_y
 * @property string $email_centre
 *
 * @property \App\Model\Entity\Naturalese $naturalese
 * @property \App\Model\Entity\Titularitat $titularitat
 * @property \App\Model\Entity\Municipi $municipi
 * @property \App\Model\Entity\Districte $districte
 * @property \App\Model\Entity\Localitat $localitat
 * @property \App\Model\Entity\Estudi[] $estudis
 */
class Centre extends Entity
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
        'denominacio_completa' => true,
        'naturalesa_id' => true,
        'titularitat_id' => true,
        'adreca' => true,
        'codi_postal' => true,
        'telefon' => true,
        'fax' => true,
        'municipi_id' => true,
        'districte_id' => true,
        'localitat_id' => true,
        'zona_educativa' => true,
        'coordenades_utm_x' => true,
        'coordenades_utm_y' => true,
        'coordenades_geo_x' => true,
        'coordenades_geo_y' => true,
        'email_centre' => true,
        'naturalese' => true,
        'titularitat' => true,
        'municipi' => true,
        'districte' => true,
        'localitat' => true,
        'estudis' => true,
    ];
}
