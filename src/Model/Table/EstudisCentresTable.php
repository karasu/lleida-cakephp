<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use \SplFileObject;
use Cake\Datasource\Exception\RecordNotFoundException;

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

        $estudis_codis = array(
            'EINF1C', 'EINF2C', 'EPRI', 'ESO', 'BATX', 'AA01', 'CFPM', 'PPAS', 'AA03', 'CFPS', 'EE', 'IFE',
            'PFI', 'PA01', 'CFAM', 'PA02', 'CFAS', 'ESDI', 'ESCM', 'ESCS', 'ADR', 'CRBC', 'IDI', 'DANE',
            'DANP', 'DANS', 'MUSE', 'MUSP', 'MUSS', 'TEGM', 'TEGS', 'ESTR', 'ADULTS');
        $estudis = array();

        while (!$file->eof()) {
            $row = $file->fgetcsv();
            // for each header field 
 			foreach ($header as $k=>$head) {
                $head = mb_convert_encoding($head, "UTF-8", "ISO-8859-1");
                if (isset($row[$k])) {
                    if ($head == 'Codi centre') {
                        $centre_codi = mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1");
                    } else if (in_array($head, $estudis_codis)) {
                        $estudis[] = intval(mb_convert_encoding($row[$k], "UTF-8", "ISO-8859-1"));
                    }
                }
            }

            if (isset($centre_codi) && count($estudis) > 0) {
                try {
                    // TODO:
                    // 1. Carregar la taula centres
                    // 2. Buscar el centre amb codi de centre centre_codi
                    // 3. Carregar la taule estudis
                    // 4. Buscar id de cadascun dels estudis a $estudis
                    // 5. Afegir a aquesta taula EstudisCentres tantes entrades
                    //    com $estudis on es relacioni el id del centre amb el id dels estudis
                    // Què passa si ja existeix?
                    //$comarca = $this->get($id);
                } catch (RecordNotFoundException $e) {
                    //$comarca = $this->newEmptyEntity();
                    //$comarca->id = $id;
                }
          
                /*
                if (!$this->save($estudisCentres)) {
                    // No podem guardar el registre. Error!
                    debug($comarca->getErrors());
                    $file = null;
                    return false;
                }
                */
            }
        }
        $file = null;
        return true;
    }}
