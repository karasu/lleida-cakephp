<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Centres Controller
 *
 * @property \App\Model\Table\CentresTable $Centres
 * @method \App\Model\Entity\Centre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CentresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Naturaleses', 'Titularitats', 'Municipis', 'Districtes', 'Localitats'],
        ];
        
        $centres = $this->paginate($this->Centres);

        $this->set(compact('centres'));
    }

    /**
     * View method
     *
     * @param string|null $id Centre id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $centre = $this->Centres->get($id, [
            'contain' => ['Naturaleses', 'Titularitats', 'Municipis', 'Districtes', 'Localitats', 'Estudis'],
        ]);

        $this->set('centre', $centre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $centre = $this->Centres->newEmptyEntity();
        if ($this->request->is('post')) {
            $centre = $this->Centres->patchEntity($centre, $this->request->getData());
            if ($this->Centres->save($centre)) {
                $this->Flash->success(__('The centre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The centre could not be saved. Please, try again.'));
        }
        $naturaleses = $this->Centres->Naturaleses->find('list', ['limit' => 200]);
        $titularitats = $this->Centres->Titularitats->find('list', ['limit' => 200]);
        $municipis = $this->Centres->Municipis->find('list', ['limit' => 200]);
        $districtes = $this->Centres->Districtes->find('list', ['limit' => 200]);
        $localitats = $this->Centres->Localitats->find('list', ['limit' => 200]);
        $estudis = $this->Centres->Estudis->find('list', ['limit' => 200]);
        $this->set(compact('centre', 'naturaleses', 'titularitats', 'municipis', 'districtes', 'localitats', 'estudis'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Centre id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $centre = $this->Centres->get($id, [
            'contain' => ['Estudis'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $centre = $this->Centres->patchEntity($centre, $this->request->getData());
            if ($this->Centres->save($centre)) {
                $this->Flash->success(__('The centre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The centre could not be saved. Please, try again.'));
        }
        $naturaleses = $this->Centres->Naturaleses->find('list', ['limit' => 200]);
        $titularitats = $this->Centres->Titularitats->find('list', ['limit' => 200]);
        $municipis = $this->Centres->Municipis->find('list', ['limit' => 200]);
        $districtes = $this->Centres->Districtes->find('list', ['limit' => 200]);
        $localitats = $this->Centres->Localitats->find('list', ['limit' => 200]);
        $estudis = $this->Centres->Estudis->find('list', ['limit' => 200]);
        $this->set(compact('centre', 'naturaleses', 'titularitats', 'municipis', 'districtes', 'localitats', 'estudis'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Centre id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $centre = $this->Centres->get($id);
        if ($this->Centres->delete($centre)) {
            $this->Flash->success(__('The centre has been deleted.'));
        } else {
            $this->Flash->error(__('The centre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Import method
     *
     * @param string|null $id Centre id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function import()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($this->Centres->import($data['csv']))
            {
                $this->Flash->success(__('All Centres have been imported.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Centres data could not be imported. Please, try again'));
        }
    }

    /**
     * Search method
     *
     * @param string|null $id Centre id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function search() {
        // $centre = $this->Centres->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Remove empty array elements
            $data = array_filter($data, fn($value) => !is_null($value) && $value !== '');
            
            foreach ($data as $k=>$v) {
                $data2['Centres.'.$k] = $v;
            }
            
            $query = $this->Centres->find('all')
                ->where($data2)
                ->limit(100);

            $number = $query->count();

            if ($number <= 0) {
                $this->Flash->error(__('Cannot find any centre! Please, try again.'));
            }
            else if ($number == 1) {
                $row = $query->first();
                return $this->redirect(['action' => 'view', $row['id']]);
            }
            else {
                // Show search results
                return $this->setAction('results', $query);
            }
        }
        $naturaleses = $this->Centres->Naturaleses->find('list', ['limit' => 200, 'valueField' => 'nom']);
        $titularitats = $this->Centres->Titularitats->find('list', ['limit' => 200, 'valueField' => 'nom']);
        $municipis = $this->Centres->Municipis->find('list', ['limit' => 200, 'valueField' => 'nom']);
        $districtes = $this->Centres->Districtes->find('list', ['limit' => 200, 'valueField' => 'nom']);
        $localitats = $this->Centres->Localitats->find('list', ['limit' => 200, 'valueField' => 'nom']);
        $estudis = $this->Centres->Estudis->find('list', ['limit' => 200]);
        $this->set(compact('naturaleses', 'titularitats', 'municipis', 'districtes', 'localitats', 'estudis'));
    }

    public function results($query)
    {
        $this->paginate = [
            'contain' => ['Naturaleses', 'Titularitats', 'Municipis', 'Districtes', 'Localitats'],
            'maxLimit' => 25,
        ];

        $this->set('centres', $this->paginate($query));
    }
}
