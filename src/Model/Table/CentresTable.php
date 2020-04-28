<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use \SplFileObject;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\Exception\InvalidPrimaryKeyException;

/**
 * Centres Model
 *
 * @property \App\Model\Table\NaturalesesTable&\Cake\ORM\Association\BelongsTo $Naturaleses
 * @property \App\Model\Table\TitularitatsTable&\Cake\ORM\Association\BelongsTo $Titularitats
 * @property \App\Model\Table\MunicipisTable&\Cake\ORM\Association\BelongsTo $Municipis
 * @property \App\Model\Table\DistrictesTable&\Cake\ORM\Association\BelongsTo $Districtes
 * @property \App\Model\Table\LocalitatsTable&\Cake\ORM\Association\BelongsTo $Localitats
 * @property \App\Model\Table\EstudisTable&\Cake\ORM\Association\BelongsToMany $Estudis
 *
 * @method \App\Model\Entity\Centre newEmptyEntity()
 * @method \App\Model\Entity\Centre newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Centre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Centre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Centre findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Centre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Centre[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Centre|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Centre saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Centre[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Centre[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Centre[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Centre[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CentresTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('centres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Naturaleses', [
            'foreignKey' => 'naturalesa_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Titularitats', [
            'foreignKey' => 'titularitat_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Municipis', [
            'foreignKey' => 'municipi_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Districtes', [
            'foreignKey' => 'districte_id',
        ]);
        $this->belongsTo('Localitats', [
            'foreignKey' => 'localitat_id',
        ]);
        $this->belongsToMany('Estudis', [
            'foreignKey' => 'centre_id',
            'targetForeignKey' => 'estudi_id',
            'joinTable' => 'estudis_centres',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('codi')
            ->maxLength('codi', 8)
            ->requirePresence('codi', 'create')
            ->notEmptyString('codi')
            ->add('codi', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('denominacio_completa')
            ->maxLength('denominacio_completa', 255)
            ->requirePresence('denominacio_completa', 'create')
            ->notEmptyString('denominacio_completa');

        $validator
            ->scalar('adreca')
            ->maxLength('adreca', 255)
            ->requirePresence('adreca', 'create')
            ->notEmptyString('adreca');

        $validator
            ->scalar('codi_postal')
            ->maxLength('codi_postal', 5)
            ->requirePresence('codi_postal', 'create')
            ->notEmptyString('codi_postal');

        $validator
            ->scalar('telefon')
            ->maxLength('telefon', 12)
            ->requirePresence('telefon', 'create')
            ->notEmptyString('telefon');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 12)
            ->requirePresence('fax', 'create')
            ->notEmptyString('fax');

        $validator
            ->scalar('zona_educativa')
            ->maxLength('zona_educativa', 255)
            ->allowEmptyString('zona_educativa');

        $validator
            ->numeric('coordenades_utm_x')
            ->requirePresence('coordenades_utm_x', 'create')
            ->notEmptyString('coordenades_utm_x');

        $validator
            ->numeric('coordenades_utm_y')
            ->requirePresence('coordenades_utm_y', 'create')
            ->notEmptyString('coordenades_utm_y');

        $validator
            ->numeric('coordenades_geo_x')
            ->requirePresence('coordenades_geo_x', 'create')
            ->notEmptyString('coordenades_geo_x');

        $validator
            ->numeric('coordenades_geo_y')
            ->requirePresence('coordenades_geo_y', 'create')
            ->notEmptyString('coordenades_geo_y');

        $validator
            ->scalar('email_centre')
            ->maxLength('email_centre', 255)
            ->requirePresence('email_centre', 'create')
            ->notEmptyString('email_centre');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['codi']));
        $rules->add($rules->existsIn(['naturalesa_id'], 'Naturaleses'));
        $rules->add($rules->existsIn(['titularitat_id'], 'Titularitats'));
        $rules->add($rules->existsIn(['municipi_id'], 'Municipis'));
        $rules->add($rules->existsIn(['districte_id'], 'Districtes'));
        $rules->add($rules->existsIn(['localitat_id'], 'Localitats'));

        return $rules;
    }

    private function str_convert($mystr) : string
    {
        return mb_convert_encoding($mystr, "UTF-8", "ISO-8859-1");
    }
    
    public function import($uploadedFile) : bool
    {
        // Check that the upload was ok and the uploaded file is a csv one
        if ($uploadedFile->getError() != 0 || $uploadedFile->getClientMediaType() != 'text/csv')
        {
            return false;
        }

        // move file
        $filename = '/tmp/lleida-import.csv';
        $uploadedFile->moveTo($filename);

        // open file
        $file = new SplFileObject($filename);
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        $file->setCsvControl(';');

        $header = $file->fgetcsv();

        // Codi centre	Denominació completa	Codi naturalesa	Nom naturalesa	Codi titularitat	Nom titularitat	Adreça	Codi postal
        // Telèfon	FAX	Codi delegació	Nom delegació	Codi comarca	Nom comarca	Codi municipi	Nom municipi	Codi districte municipal
        // Nom DM	Codi localitat	Nom localitat	Zona educativa	Coordenades UTM X	Coordenades UTM Y	Coordenades GEO X	Coordenades GEO Y
        // E-mail centre	EINF1C	EINF2C	EPRI	ESO	BATX	AA01	CFPM	PPAS	AA03	CFPS	EE	IFE	PFI	PA01	CFAM	PA02	CFAS
        // ESDI	ESCM	ESCS	ADR	CRBC	IDI	DANE	DANP	DANS	MUSE	MUSP	MUSS	TEGM	TEGS	ESTR	ADULTS

        $dat = array();
        while (!$file->eof()) {
            $row = $file->fgetcsv();
            // for each header field
 			foreach ($header as $k=>$head) {
                $head = mb_convert_encoding($head, "UTF-8", "ISO-8859-1");
                if (isset($row[$k])) {
                    $value = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                    if ($head == 'Codi centre') {
                        // csv should use quotes for this one
                        $dat['codi'] = $value;
                    } else if ($head == 'Denominació completa') {
                        $dat['denominacio_completa'] = $value;
                    } else if ($head == 'Codi naturalesa') {
                        $dat['naturalesa_id'] = intval($value);
                    } else if ($head == 'Codi titularitat') {
                        $dat['titularitat_id'] = intval($value);
                    } else if ($head == 'Adreça') {
                        $dat['adreca'] = $value;
                    } else if ($head == 'Codi postal') {
                        // csv should use quotes for this one
                        $dat['codi_postal'] = $value;
                    } else if ($head == 'Telèfon') {
                        $dat['telefon'] = $value;
                    } else if ($head == 'FAX') {
                        $dat['fax'] = $value;
                    } else if ($head == 'Codi municipi') {
                        // csv should use quotes for this one
                        $dat['municipi_id'] = $value;
                    } else if ($head == 'Codi districte') {
                        $dat['districte_id'] = $value;
                    } else if ($head == 'Codi localitat') {
                        // Si la localitat és 1 vol dir que és directament el municipi (Generalitat)
                        if (intval($value) != 1) {
                            $dat['localitat_id'] = $value;
                        }
                    } else if ($head == 'Zona educativa') {
                        $dat['zona_educativa'] = $value;
                    } else if ($head == 'Coordenades UTM X') {
                        $var = (double)filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $dat['coordenades_utm_x'] = $var;
                    } else if ($head == 'Coordenades UTM Y') {
                        $var = (double)filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $dat['coordenades_utm_y'] = $var;
                    } else if ($head == 'Coordenades GEO X') {
                        $var = (double)filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $dat['coordenades_geo_x'] = $var;
                    } else if ($head == 'Coordenades GEO Y') {
                        $var = (double)filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $dat['coordenades_geo_y'] = $var;
                    } else if ($head == 'E-mail centre') {
                        $dat['email_centre'] = $this->str_convert($value);
                    }
                }
            }                

            if (isset($dat['codi'])) {
                try {
                    // Busca el centre de codi $dat['codi']
                    $query = $this->find('all')
                        ->where(['codi =' => $dat['codi']])
                        ->limit(1);
                    // Executem la consulta i passem el resultat a un array
                    $olddata = $query->toArray();
                    // debug($dat['codi']);
                    // debug($olddata);
                    if (!empty($olddata)) {
                        // Obté el centre amb el id que correspon al $dat['codi']
                        $centre = $this->get($olddata[0]['id']);
                        // debug($centre);
                    }
                    else {
                        $centre = $this->newEmptyEntity();
                    }
                } catch (RecordNotFoundException $e) {
                    $centre = $this->newEmptyEntity();
                } catch (InvalidPrimaryKeyException $e) {
                    $centre = $this->newEmptyEntity();
                }

                $centre->set($dat);

                if (!$this->save($centre)) {
                    // No podem guardar el registre. Error!
                    debug($centre->getErrors());
                    $file = null;
                    return false;
                }
            }
            
            $dat = array();
        }
        $file = null;
        return true;
    } 
}
