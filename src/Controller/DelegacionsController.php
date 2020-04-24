<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Delegacions Controller
 *
 * @property \App\Model\Table\DelegacionsTable $Delegacions
 * @method \App\Model\Entity\Delegacion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
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
     * @param string|null $id Delegacion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $delegacion = $this->Delegacions->get($id, [
            'contain' => [],
        ]);

        $this->set('delegacion', $delegacion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $delegacion = $this->Delegacions->newEmptyEntity();
        if ($this->request->is('post')) {
            $delegacion = $this->Delegacions->patchEntity($delegacion, $this->request->getData());
            if ($this->Delegacions->save($delegacion)) {
                $this->Flash->success(__('The delegacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delegacion could not be saved. Please, try again.'));
        }
        $this->set(compact('delegacion'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Delegacion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $delegacion = $this->Delegacions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $delegacion = $this->Delegacions->patchEntity($delegacion, $this->request->getData());
            if ($this->Delegacions->save($delegacion)) {
                $this->Flash->success(__('The delegacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delegacion could not be saved. Please, try again.'));
        }
        $this->set(compact('delegacion'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Delegacion id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $delegacion = $this->Delegacions->get($id);
        if ($this->Delegacions->delete($delegacion)) {
            $this->Flash->success(__('The delegacion has been deleted.'));
        } else {
            $this->Flash->error(__('The delegacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
