<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CentresFixture
 */
class CentresFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'codi' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'denominacio_completa' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'naturalesa_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'titularitat_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'adreca' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'codi_postal' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'telefon' => ['type' => 'string', 'length' => 12, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'fax' => ['type' => 'string', 'length' => 12, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'municipi_id' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'districte_id' => ['type' => 'string', 'length' => 2, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'localitat_id' => ['type' => 'string', 'length' => 2, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'zona_educativa' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'coordenades_utm_x' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'coordenades_utm_y' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'coordenades_geo_x' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'coordenades_geo_y' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'email_centre' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'municipi_key3' => ['type' => 'index', 'columns' => ['municipi_id'], 'length' => []],
            'districte_key' => ['type' => 'index', 'columns' => ['districte_id'], 'length' => []],
            'localitat_key' => ['type' => 'index', 'columns' => ['localitat_id'], 'length' => []],
            'naturalesa_key' => ['type' => 'index', 'columns' => ['naturalesa_id'], 'length' => []],
            'titularitat_key' => ['type' => 'index', 'columns' => ['titularitat_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'codi' => ['type' => 'unique', 'columns' => ['codi'], 'length' => []],
            'districte_key' => ['type' => 'foreign', 'columns' => ['districte_id'], 'references' => ['districtes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'localitat_key' => ['type' => 'foreign', 'columns' => ['localitat_id'], 'references' => ['localitats', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'municipi_key3' => ['type' => 'foreign', 'columns' => ['municipi_id'], 'references' => ['municipis', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'naturalesa_key' => ['type' => 'foreign', 'columns' => ['naturalesa_id'], 'references' => ['naturaleses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'titularitat_key' => ['type' => 'foreign', 'columns' => ['titularitat_id'], 'references' => ['titularitats', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'codi' => 'Lorem ',
                'denominacio_completa' => 'Lorem ipsum dolor sit amet',
                'naturalesa_id' => 1,
                'titularitat_id' => 1,
                'adreca' => 'Lorem ipsum dolor sit amet',
                'codi_postal' => 'Lor',
                'telefon' => 'Lorem ipsu',
                'fax' => 'Lorem ipsu',
                'municipi_id' => 'Lor',
                'districte_id' => 'Lo',
                'localitat_id' => 'Lo',
                'zona_educativa' => 'Lorem ipsum dolor sit amet',
                'coordenades_utm_x' => 1,
                'coordenades_utm_y' => 1,
                'coordenades_geo_x' => 1,
                'coordenades_geo_y' => 1,
                'email_centre' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
