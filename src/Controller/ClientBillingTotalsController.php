<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ClientBillingTotals Controller
 *
 * @property \App\Model\Table\ClientBillingTotalsTable $ClientBillingTotals
 * @method \App\Model\Entity\ClientBillingTotal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientBillingTotalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $clientBillingTotals = $this->paginate($this->ClientBillingTotals);

        $this->set(compact('clientBillingTotals'));
    }

    /**
     * View method
     *
     * @param string|null $id Client Billing Total id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientBillingTotal = $this->ClientBillingTotals->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('clientBillingTotal'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientBillingTotal = $this->ClientBillingTotals->newEmptyEntity();
        if ($this->request->is('post')) {
            $clientBillingTotal = $this->ClientBillingTotals->patchEntity($clientBillingTotal, $this->request->getData());
            if ($this->ClientBillingTotals->save($clientBillingTotal)) {
                $this->Flash->success(__('The client billing total has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client billing total could not be saved. Please, try again.'));
        }
        $clients = $this->ClientBillingTotals->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientBillingTotal', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client Billing Total id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientBillingTotal = $this->ClientBillingTotals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientBillingTotal = $this->ClientBillingTotals->patchEntity($clientBillingTotal, $this->request->getData());
            if ($this->ClientBillingTotals->save($clientBillingTotal)) {
                $this->Flash->success(__('The client billing total has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client billing total could not be saved. Please, try again.'));
        }
        $clients = $this->ClientBillingTotals->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientBillingTotal', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client Billing Total id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientBillingTotal = $this->ClientBillingTotals->get($id);
        if ($this->ClientBillingTotals->delete($clientBillingTotal)) {
            $this->Flash->success(__('The client billing total has been deleted.'));
        } else {
            $this->Flash->error(__('The client billing total could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
