<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Comarques Controller
 *
 * @property \App\Model\Table\ComarquesTable $Comarques
 * @method \App\Model\Entity\Comarque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComarquesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Delegacions'],
        ];
        $comarques = $this->paginate($this->Comarques);

        $this->set(compact('comarques'));
    }

    /**
     * View method
     *
     * @param string|null $id Comarque id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comarque = $this->Comarques->get($id, [
            'contain' => ['Delegacions'],
        ]);

        $this->set('comarque', $comarque);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comarque = $this->Comarques->newEmptyEntity();
        if ($this->request->is('post')) {
            $comarque = $this->Comarques->patchEntity($comarque, $this->request->getData());
            if ($this->Comarques->save($comarque)) {
                $this->Flash->success(__('The comarque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comarque could not be saved. Please, try again.'));
        }
        $delegacions = $this->Comarques->Delegacions->find('list', ['limit' => 200]);
        $this->set(compact('comarque', 'delegacions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comarque id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comarque = $this->Comarques->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comarque = $this->Comarques->patchEntity($comarque, $this->request->getData());
            if ($this->Comarques->save($comarque)) {
                $this->Flash->success(__('The comarque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comarque could not be saved. Please, try again.'));
        }
        $delegacions = $this->Comarques->Delegacions->find('list', ['limit' => 200]);
        $this->set(compact('comarque', 'delegacions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comarque id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comarque = $this->Comarques->get($id);
        if ($this->Comarques->delete($comarque)) {
            $this->Flash->success(__('The comarque has been deleted.'));
        } else {
            $this->Flash->error(__('The comarque could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
