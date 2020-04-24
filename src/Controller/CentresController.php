<?php
declare(strict_types=1);

namespace App\Controller;

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
}
