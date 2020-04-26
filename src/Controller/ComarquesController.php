<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Comarques Controller
 *
 * @property \App\Model\Table\ComarquesTable $Comarques
 * @method \App\Model\Entity\Comarca[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
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
     * @param string|null $id Comarca id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comarca = $this->Comarques->get($id, [
            'contain' => ['Delegacions'],
        ]);

        $this->set('comarca', $comarca);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comarca = $this->Comarques->newEmptyEntity();
        if ($this->request->is('post')) {
            $comarca = $this->Comarques->patchEntity($comarca, $this->request->getData());
            if ($this->Comarques->save($comarca)) {
                $this->Flash->success(__('The comarca has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comarca could not be saved. Please, try again.'));
        }
        $delegacions = $this->Comarques->Delegacions->find('list', ['limit' => 200]);
        $this->set(compact('comarca', 'delegacions'));
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
        $comarca = $this->Comarques->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comarca = $this->Comarques->patchEntity($comarca, $this->request->getData());
            if ($this->Comarques->save($comarca)) {
                $this->Flash->success(__('The comarca has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comarca could not be saved. Please, try again.'));
        }
        $delegacions = $this->Comarques->Delegacions->find('list', ['limit' => 200]);
        $this->set(compact('comarca', 'delegacions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comarca id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comarca = $this->Comarques->get($id);
        if ($this->Comarques->delete($comarca)) {
            $this->Flash->success(__('The comarca has been deleted.'));
        } else {
            $this->Flash->error(__('The comarca could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
