<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Titularitats Controller
 *
 * @property \App\Model\Table\TitularitatsTable $Titularitats
 * @method \App\Model\Entity\Titularitat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TitularitatsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $titularitats = $this->paginate($this->Titularitats);

        $this->set(compact('titularitats'));
    }

    /**
     * View method
     *
     * @param string|null $id Titularitat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $titularitat = $this->Titularitats->get($id, [
            'contain' => ['Centres'],
        ]);

        $this->set('titularitat', $titularitat);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $titularitat = $this->Titularitats->newEmptyEntity();
        if ($this->request->is('post')) {
            $titularitat = $this->Titularitats->patchEntity($titularitat, $this->request->getData());
            if ($this->Titularitats->save($titularitat)) {
                $this->Flash->success(__('The titularitat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The titularitat could not be saved. Please, try again.'));
        }
        $this->set(compact('titularitat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Titularitat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $titularitat = $this->Titularitats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $titularitat = $this->Titularitats->patchEntity($titularitat, $this->request->getData());
            if ($this->Titularitats->save($titularitat)) {
                $this->Flash->success(__('The titularitat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The titularitat could not be saved. Please, try again.'));
        }
        $this->set(compact('titularitat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Titularitat id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $titularitat = $this->Titularitats->get($id);
        if ($this->Titularitats->delete($titularitat)) {
            $this->Flash->success(__('The titularitat has been deleted.'));
        } else {
            $this->Flash->error(__('The titularitat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function import() {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($this->Titularitats->import($data['csv']))
            {
                $this->Flash->success(__('All titularitats have been imported.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Titularitats could not be imported. Please, try again'));
        }
    }

}
