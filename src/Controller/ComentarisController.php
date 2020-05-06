<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Comentaris Controller
 *
 * @property \App\Model\Table\ComentarisTable $Comentaris
 * @method \App\Model\Entity\Comentari[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComentarisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Centres'],
        ];
        $comentaris = $this->paginate($this->Comentaris);

        $this->set(compact('comentaris'));
    }

    /**
     * View method
     *
     * @param string|null $id Comentari id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comentari = $this->Comentaris->get($id, [
            'contain' => ['Centres'],
        ]);

        $this->set('comentari', $comentari);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comentari = $this->Comentaris->newEmptyEntity();
        if ($this->request->is('post')) {
            $comentari = $this->Comentaris->patchEntity($comentari, $this->request->getData());
            if ($this->Comentaris->save($comentari)) {
                $this->Flash->success(__('The comentari has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comentari could not be saved. Please, try again.'));
        }
        // $centres = $this->Comentaris->Centres->find('list', ['limit' => 200]);
        $centres = $this->Comentaris->Centres->find('list', [
            'valueField' => 'denominacio_completa',
            'order' => ['Centres.denominacio_completa' => 'ASC']
        ]);
        $this->set(compact('comentari', 'centres'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comentari id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comentari = $this->Comentaris->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comentari = $this->Comentaris->patchEntity($comentari, $this->request->getData());
            if ($this->Comentaris->save($comentari)) {
                $this->Flash->success(__('The comentari has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comentari could not be saved. Please, try again.'));
        }
        $centres = $this->Comentaris->Centres->find('list', ['limit' => 200]);
        $this->set(compact('comentari', 'centres'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comentari id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comentari = $this->Comentaris->get($id);
        if ($this->Comentaris->delete($comentari)) {
            $this->Flash->success(__('The comentari has been deleted.'));
        } else {
            $this->Flash->error(__('The comentari could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
