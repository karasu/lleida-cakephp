<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Municipis Controller
 *
 * @property \App\Model\Table\MunicipisTable $Municipis
 * @method \App\Model\Entity\Municipi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MunicipisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Comarques'],
        ];
        $municipis = $this->paginate($this->Municipis);

        $this->set(compact('municipis'));
    }

    /**
     * View method
     *
     * @param string|null $id Municipi id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $municipi = $this->Municipis->get($id, [
            'contain' => ['Comarques', 'Centres', 'Districtes', 'Localitats'],
        ]);

        $this->set('municipi', $municipi);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $municipi = $this->Municipis->newEmptyEntity();
        if ($this->request->is('post')) {
            $municipi = $this->Municipis->patchEntity($municipi, $this->request->getData());
            if ($this->Municipis->save($municipi)) {
                $this->Flash->success(__('The municipi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The municipi could not be saved. Please, try again.'));
        }
        $comarques = $this->Municipis->Comarques->find('list', ['limit' => 200]);
        $this->set(compact('municipi', 'comarques'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Municipi id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $municipi = $this->Municipis->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $municipi = $this->Municipis->patchEntity($municipi, $this->request->getData());
            if ($this->Municipis->save($municipi)) {
                $this->Flash->success(__('The municipi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The municipi could not be saved. Please, try again.'));
        }
        $comarques = $this->Municipis->Comarques->find('list', ['limit' => 200]);
        $this->set(compact('municipi', 'comarques'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Municipi id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $municipi = $this->Municipis->get($id);
        if ($this->Municipis->delete($municipi)) {
            $this->Flash->success(__('The municipi has been deleted.'));
        } else {
            $this->Flash->error(__('The municipi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
