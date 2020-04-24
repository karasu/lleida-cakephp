<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Estudis Controller
 *
 * @property \App\Model\Table\EstudisTable $Estudis
 * @method \App\Model\Entity\Estudi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EstudisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $estudis = $this->paginate($this->Estudis);

        $this->set(compact('estudis'));
    }

    /**
     * View method
     *
     * @param string|null $id Estudi id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $estudi = $this->Estudis->get($id, [
            'contain' => ['Centres'],
        ]);

        $this->set('estudi', $estudi);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $estudi = $this->Estudis->newEmptyEntity();
        if ($this->request->is('post')) {
            $estudi = $this->Estudis->patchEntity($estudi, $this->request->getData());
            if ($this->Estudis->save($estudi)) {
                $this->Flash->success(__('The estudi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The estudi could not be saved. Please, try again.'));
        }
        $centres = $this->Estudis->Centres->find('list', ['limit' => 200]);
        $this->set(compact('estudi', 'centres'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Estudi id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $estudi = $this->Estudis->get($id, [
            'contain' => ['Centres'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estudi = $this->Estudis->patchEntity($estudi, $this->request->getData());
            if ($this->Estudis->save($estudi)) {
                $this->Flash->success(__('The estudi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The estudi could not be saved. Please, try again.'));
        }
        $centres = $this->Estudis->Centres->find('list', ['limit' => 200]);
        $this->set(compact('estudi', 'centres'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Estudi id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estudi = $this->Estudis->get($id);
        if ($this->Estudis->delete($estudi)) {
            $this->Flash->success(__('The estudi has been deleted.'));
        } else {
            $this->Flash->error(__('The estudi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
