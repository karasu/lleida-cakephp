<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Naturaleses Controller
 *
 * @property \App\Model\Table\NaturalesesTable $Naturaleses
 * @method \App\Model\Entity\Naturalesa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NaturalesesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $naturaleses = $this->paginate($this->Naturaleses);

        $this->set(compact('naturaleses'));
    }

    /**
     * View method
     *
     * @param string|null $id Naturalesa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $naturalesa = $this->Naturaleses->get($id, [
            'contain' => ['Centres'],
        ]);

        $this->set('naturalesa', $naturalesa);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $naturalesa = $this->Naturaleses->newEmptyEntity();
        if ($this->request->is('post')) {
            $naturalesa = $this->Naturaleses->patchEntity($naturalesa, $this->request->getData());
            if ($this->Naturaleses->save($naturalesa)) {
                $this->Flash->success(__('The naturalesa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The naturalesa could not be saved. Please, try again.'));
        }
        $this->set(compact('naturalesa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Naturalesa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $naturalesa = $this->Naturaleses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $naturalesa = $this->Naturaleses->patchEntity($naturalesa, $this->request->getData());
            if ($this->Naturaleses->save($naturalesa)) {
                $this->Flash->success(__('The naturalesa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The naturalesa could not be saved. Please, try again.'));
        }
        $this->set(compact('naturalesa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Naturalesa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $naturalesa = $this->Naturaleses->get($id);
        if ($this->Naturaleses->delete($naturalesa)) {
            $this->Flash->success(__('The naturalesa has been deleted.'));
        } else {
            $this->Flash->error(__('The naturalesa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function import() {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($this->Naturaleses->import($data['csv']))
            {
                $this->Flash->success(__('All naturaleses have been imported.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Naturaleses could not be imported. Please, try again'));
        }
    }
}
