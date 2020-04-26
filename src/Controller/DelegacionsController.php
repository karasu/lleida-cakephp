<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Delegacions Controller
 *
 * @property \App\Model\Table\DelegacionsTable $Delegacions
 * @method \App\Model\Entity\Delegacio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DelegacionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $delegacions = $this->paginate($this->Delegacions);

        $this->set(compact('delegacions'));
    }

    /**
     * View method
     *
     * @param string|null $id Delegacio id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $delegacio = $this->Delegacions->get($id, [
            'contain' => [],
        ]);

        $this->set('delegacio', $delegacio);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $delegacio = $this->Delegacions->newEmptyEntity();
        if ($this->request->is('post')) {
            $delegacio = $this->Delegacions->patchEntity($delegacio, $this->request->getData());
            if ($this->Delegacions->save($delegacio)) {
                $this->Flash->success(__('The delegacio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delegacio could not be saved. Please, try again.'));
        }
        $this->set(compact('delegacio'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Delegacio id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $delegacio = $this->Delegacions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $delegacio = $this->Delegacions->patchEntity($delegacio, $this->request->getData());
            if ($this->Delegacions->save($delegacio)) {
                $this->Flash->success(__('The delegacio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delegacio could not be saved. Please, try again.'));
        }
        $this->set(compact('delegacio'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Delegacio id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $delegacio = $this->Delegacions->get($id);
        if ($this->Delegacions->delete($delegacio)) {
            $this->Flash->success(__('The delegacio has been deleted.'));
        } else {
            $this->Flash->error(__('The delegacio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function import() {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($this->Delegacions->import($data['csv']))
            {
                $this->Flash->success(__('All Delegacions have been imported.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Delegacions data could not be imported. Please, try again'));
        }
    }
}
