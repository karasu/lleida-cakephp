<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * EstudisCentres Controller
 *
 * @property \App\Model\Table\EstudisCentresTable $EstudisCentres
 * @method \App\Model\Entity\EstudisCentre[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EstudisCentresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Centres', 'Estudis'],
        ];
        $estudisCentres = $this->paginate($this->EstudisCentres);

        $this->set(compact('estudisCentres'));
    }

    /**
     * View method
     *
     * @param string|null $id Estudis Centre id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $estudisCentre = $this->EstudisCentres->get($id, [
            'contain' => ['Centres', 'Estudis'],
        ]);

        $this->set('estudisCentre', $estudisCentre);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $estudisCentre = $this->EstudisCentres->newEmptyEntity();
        if ($this->request->is('post')) {
            $estudisCentre = $this->EstudisCentres->patchEntity($estudisCentre, $this->request->getData());
            if ($this->EstudisCentres->save($estudisCentre)) {
                $this->Flash->success(__('The estudis centre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The estudis centre could not be saved. Please, try again.'));
        }
        $centres = $this->EstudisCentres->Centres->find('list', ['limit' => 200]);
        $estudis = $this->EstudisCentres->Estudis->find('list', ['limit' => 200]);
        $this->set(compact('estudisCentre', 'centres', 'estudis'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Estudis Centre id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $estudisCentre = $this->EstudisCentres->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estudisCentre = $this->EstudisCentres->patchEntity($estudisCentre, $this->request->getData());
            if ($this->EstudisCentres->save($estudisCentre)) {
                $this->Flash->success(__('The estudis centre has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The estudis centre could not be saved. Please, try again.'));
        }
        $centres = $this->EstudisCentres->Centres->find('list', ['limit' => 200]);
        $estudis = $this->EstudisCentres->Estudis->find('list', ['limit' => 200]);
        $this->set(compact('estudisCentre', 'centres', 'estudis'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Estudis Centre id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estudisCentre = $this->EstudisCentres->get($id);
        if ($this->EstudisCentres->delete($estudisCentre)) {
            $this->Flash->success(__('The estudis centre has been deleted.'));
        } else {
            $this->Flash->error(__('The estudis centre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function import() {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($this->EstudisCentres->import($data['csv']))
            {
                $this->Flash->success(__('All EstudisCentres have been imported.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('EstudisCentres data could not be imported. Please, try again'));
        }
    }
}
