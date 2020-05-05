<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use \SplFileObject;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;

/**
 * EstudisCentres Model
 *
 * @property \App\Model\Table\CentresTable&\Cake\ORM\Association\BelongsTo $Centres
 * @property \App\Model\Table\EstudisTable&\Cake\ORM\Association\BelongsTo $Estudis
 *
 * @method \App\Model\Entity\EstudisCentre newEmptyEntity()
 * @method \App\Model\Entity\EstudisCentre newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre get($primaryKey, $options = [])
 * @method \App\Model\Entity\EstudisCentre findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EstudisCentre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EstudisCentre|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EstudisCentre saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EstudisCentresTable extends Table
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

        $this->setTable('estudis_centres');
        $this->setDisplayField('centre_id');
        $this->setPrimaryKey(['centre_id', 'estudi_id']);

        $this->belongsTo('Centres', [
            'foreignKey' => 'centre_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Estudis', [
            'foreignKey' => 'estudi_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['centre_id'], 'Centres'));
        $rules->add($rules->existsIn(['estudi_id'], 'Estudis'));

        return $rules;
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

        $estudis_codis_all = array(
            'EINF1C', 'EINF2C', 'EPRI', 'ESO', 'BATX', 'AA01', 'CFPM', 'PPAS', 'AA03', 'CFPS', 'EE', 'IFE',
            'PFI', 'PA01', 'CFAM', 'PA02', 'CFAS', 'ESDI', 'ESCM', 'ESCS', 'ADR', 'CRBC', 'IDI', 'DANE',
            'DANP', 'DANS', 'MUSE', 'MUSP', 'MUSS', 'TEGM', 'TEGS', 'ESTR', 'ADULTS');

        $centres_table = TableRegistry::getTableLocator()->get('Centres');
        $estudis_table = TableRegistry::getTableLocator()->get('Estudis');

        while (!$file->eof()) {
            $estudis_codis = array();
            $row = $file->fgetcsv();
            // for each header field 
 			foreach ($header as $k=>$head) {
                if (isset($row[$k])) {
                    $head = mb_convert_encoding($head, "UTF-8", "ISO-8859-1");
                    if ($head == 'Codi centre') {
                        $centre_codi = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                    } else if (in_array($head, $estudis_codis_all)) {
                        $estudis_codis[] = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                    }
                }
            }

            if (isset($centre_codi) && count($estudis_codis) > 0) {
                try {
                    // Buscar el centre amb codi de centre centre_codi
                    $centresQuery = $centres_table->find('all')
                        ->where(['codi' => $centre_codi]);

                    foreach ($centresQuery as $centre) {
                        $centre_id = $centre->id;
                    }
                    $centresQuery = null;

                    if (!empty($centre_id)) {
                        // Buscar id de cadascun dels estudis a $estudis
                        foreach ($estudis_codis as $estudis_codi) {
                            if (!empty($estudis_codi)) {
                                $estudisQuery = $estudis_table->find('all')
                                    ->where(['codi' => $estudis_codi]);
                                debug($estudisQuery);
                                foreach ($estudisQuery as $estudi) {
                                    // Afegir a aquesta taula EstudisCentres tantes entrades
                                    // com $estudis_codis on es relacioni el id del centre amb el id dels estudis

                                    $estudisCentre = $this->newEmptyEntity();
                                    $estudisCentre->centre_id = $centre_id;
                                    $estudisCentre->estudi_id = $estudi->id;

                                    if (!$this->save($estudisCentre)) {
                                        return false;
                                    }
                                }
                                $estudisQuery = null;
                            }
                        }
                    }
                    
                } catch (RecordNotFoundException $e) {
                    debug($e);
                    $file = null;
                    return false;
                }
            }
        }
        $file = null;
        return true;
    }
}
