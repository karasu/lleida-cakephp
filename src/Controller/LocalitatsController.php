<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Localitats Controller
 *
 * @property \App\Model\Table\LocalitatsTable $Localitats
 * @method \App\Model\Entity\Localitat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LocalitatsController extends AppController
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
        $localitats = $this->paginate($this->Localitats);

        $this->set(compact('localitats'));
    }

    /**
     * View method
     *
     * @param string|null $id Localitat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $localitat = $this->Localitats->get($id, [
            'contain' => ['Municipis', 'Centres'],
        ]);

        $this->set('localitat', $localitat);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $localitat = $this->Localitats->newEmptyEntity();
        if ($this->request->is('post')) {
            $localitat = $this->Localitats->patchEntity($localitat, $this->request->getData());
            if ($this->Localitats->save($localitat)) {
                $this->Flash->success(__('The localitat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The localitat could not be saved. Please, try again.'));
        }
        $municipis = $this->Localitats->Municipis->find('list', ['limit' => 200]);
        $this->set(compact('localitat', 'municipis'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Localitat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $localitat = $this->Localitats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $localitat = $this->Localitats->patchEntity($localitat, $this->request->getData());
            if ($this->Localitats->save($localitat)) {
                $this->Flash->success(__('The localitat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The localitat could not be saved. Please, try again.'));
        }
        $municipis = $this->Localitats->Municipis->find('list', ['limit' => 200]);
        $this->set(compact('localitat', 'municipis'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Localitat id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $localitat = $this->Localitats->get($id);
        if ($this->Localitats->delete($localitat)) {
            $this->Flash->success(__('The localitat has been deleted.'));
        } else {
            $this->Flash->error(__('The localitat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
