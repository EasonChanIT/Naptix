<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TaskBillableTotals Controller
 *
 * @property \App\Model\Table\TaskBillableTotalsTable $TaskBillableTotals
 * @method \App\Model\Entity\TaskBillableTotal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaskBillableTotalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tasks'],
        ];
        $taskBillableTotals = $this->paginate($this->TaskBillableTotals);

        $this->set(compact('taskBillableTotals'));
    }

    /**
     * View method
     *
     * @param string|null $id Task Billable Total id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taskBillableTotal = $this->TaskBillableTotals->get($id, [
            'contain' => ['Tasks'],
        ]);

        $this->set(compact('taskBillableTotal'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taskBillableTotal = $this->TaskBillableTotals->newEmptyEntity();
        if ($this->request->is('post')) {
            $taskBillableTotal = $this->TaskBillableTotals->patchEntity($taskBillableTotal, $this->request->getData());
            if ($this->TaskBillableTotals->save($taskBillableTotal)) {
                $this->Flash->success(__('The task billable total has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task billable total could not be saved. Please, try again.'));
        }
        $tasks = $this->TaskBillableTotals->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('taskBillableTotal', 'tasks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task Billable Total id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taskBillableTotal = $this->TaskBillableTotals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taskBillableTotal = $this->TaskBillableTotals->patchEntity($taskBillableTotal, $this->request->getData());
            if ($this->TaskBillableTotals->save($taskBillableTotal)) {
                $this->Flash->success(__('The task billable total has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task billable total could not be saved. Please, try again.'));
        }
        $tasks = $this->TaskBillableTotals->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('taskBillableTotal', 'tasks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task Billable Total id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taskBillableTotal = $this->TaskBillableTotals->get($id);
        if ($this->TaskBillableTotals->delete($taskBillableTotal)) {
            $this->Flash->success(__('The task billable total has been deleted.'));
        } else {
            $this->Flash->error(__('The task billable total could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
