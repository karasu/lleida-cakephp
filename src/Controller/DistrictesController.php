<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Districtes Controller
 *
 * @property \App\Model\Table\DistrictesTable $Districtes
 * @method \App\Model\Entity\Districte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DistrictesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Municipis'],
        ];
        $districtes = $this->paginate($this->Districtes);

        $this->set(compact('districtes'));
    }

    /**
     * View method
     *
     * @param string|null $id Districte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $districte = $this->Districtes->get($id, [
            'contain' => ['Municipis', 'Centres'],
        ]);

        $this->set('districte', $districte);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $districte = $this->Districtes->newEmptyEntity();
        if ($this->request->is('post')) {
            $districte = $this->Districtes->patchEntity($districte, $this->request->getData());
            if ($this->Districtes->save($districte)) {
                $this->Flash->success(__('The districte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The districte could not be saved. Please, try again.'));
        }
        $municipis = $this->Districtes->Municipis->find('list', ['limit' => 200]);
        $this->set(compact('districte', 'municipis'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Districte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $districte = $this->Districtes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $districte = $this->Districtes->patchEntity($districte, $this->request->getData());
            if ($this->Districtes->save($districte)) {
                $this->Flash->success(__('The districte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The districte could not be saved. Please, try again.'));
        }
        $municipis = $this->Districtes->Municipis->find('list', ['limit' => 200]);
        $this->set(compact('districte', 'municipis'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Districte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $districte = $this->Districtes->get($id);
        if ($this->Districtes->delete($districte)) {
            $this->Flash->success(__('The districte has been deleted.'));
        } else {
            $this->Flash->error(__('The districte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
