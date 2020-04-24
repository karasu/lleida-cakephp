<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Naturaleses Controller
 *
 * @property \App\Model\Table\NaturalesesTable $Naturaleses
 * @method \App\Model\Entity\Naturalese[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
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
     * @param string|null $id Naturalese id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $naturalese = $this->Naturaleses->get($id, [
            'contain' => [],
        ]);

        $this->set('naturalese', $naturalese);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $naturalese = $this->Naturaleses->newEmptyEntity();
        if ($this->request->is('post')) {
            $naturalese = $this->Naturaleses->patchEntity($naturalese, $this->request->getData());
            if ($this->Naturaleses->save($naturalese)) {
                $this->Flash->success(__('The naturalese has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The naturalese could not be saved. Please, try again.'));
        }
        $this->set(compact('naturalese'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Naturalese id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $naturalese = $this->Naturaleses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $naturalese = $this->Naturaleses->patchEntity($naturalese, $this->request->getData());
            if ($this->Naturaleses->save($naturalese)) {
                $this->Flash->success(__('The naturalese has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The naturalese could not be saved. Please, try again.'));
        }
        $this->set(compact('naturalese'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Naturalese id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $naturalese = $this->Naturaleses->get($id);
        if ($this->Naturaleses->delete($naturalese)) {
            $this->Flash->success(__('The naturalese has been deleted.'));
        } else {
            $this->Flash->error(__('The naturalese could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
