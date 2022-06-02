<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // ADMIN ACCESS ONLY - ELSE REDIRECTED TO HOMEPAGE
        
        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;

        if ($permissionLevel != 'admin'){

            $redirect = $this->request->getQuery('redirect', [

                'controller' => 'EmployeeTasks',
                'action' => 'newdashboard',
            ]);
             
             $this->Flash->error(__('You do not have permisson to enter this page. Redirecting you to your dashboard.'));
             return $this->redirect($redirect);     
            
            }
       

        //ADMIN ACCESS ENDS

        $query = $this->Tasks->find()
            ->order(['Tasks.task_name' => 'ASC']);

        //search function
            
        $keyword = $this->request->getQuery('keyword');
        if(!empty($keyword)){
            $cond = array('OR'=>array("CAST(`task_name` AS CHAR CHARACTER SET utf8) COLLATE utf8_general_ci LIKE '%$keyword%'"
            ));
            $tasks = $this->paginate($query,['conditions'=>$cond, 'limit' =>10]);
        }
        else{
            $tasks = $this->paginate($query,['limit'=>10]);
        }

        
        $this->set(compact('tasks'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // ADMIN ACCESS ONLY - ELSE REDIRECTED TO HOMEPAGE
        
        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;

        if ($permissionLevel != 'admin'){

            $redirect = $this->request->getQuery('redirect', [

                'controller' => 'EmployeeTasks',
                'action' => 'newdashboard',
            ]);
             
             $this->Flash->error(__('You do not have permisson to enter this page. Redirecting you to your dashboard.'));
             return $this->redirect($redirect);     
            
            }
       

        //ADMIN ACCESS ENDS

        $task = $this->Tasks->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('task'));



    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // ADMIN ACCESS ONLY - ELSE REDIRECTED TO HOMEPAGE
        
        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;

        if ($permissionLevel != 'admin'){

            $redirect = $this->request->getQuery('redirect', [

                'controller' => 'EmployeeTasks',
                'action' => 'newdashboard',
            ]);
             
             $this->Flash->error(__('You do not have permisson to enter this page. Redirecting you to your dashboard.'));
             return $this->redirect($redirect);     
            
            }
       

        //ADMIN ACCESS ENDS

        $task = $this->Tasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $this->set(compact('task'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // ADMIN ACCESS ONLY - ELSE REDIRECTED TO HOMEPAGE
        
        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;

        if ($permissionLevel != 'admin'){

            $redirect = $this->request->getQuery('redirect', [

                'controller' => 'EmployeeTasks',
                'action' => 'newdashboard',
            ]);
             
             $this->Flash->error(__('You do not have permisson to enter this page. Redirecting you to your dashboard.'));
             return $this->redirect($redirect);     
            
            }
       

        //ADMIN ACCESS ENDS

        $task = $this->Tasks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $this->set(compact('task'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // ADMIN ACCESS ONLY - ELSE REDIRECTED TO HOMEPAGE
        
        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;

        if ($permissionLevel != 'admin'){

            $redirect = $this->request->getQuery('redirect', [

                'controller' => 'EmployeeTasks',
                'action' => 'newdashboard',
            ]);
             
             $this->Flash->error(__('You do not have permisson to enter this page. Redirecting you to your dashboard.'));
             return $this->redirect($redirect);     
            
            }
       

        //ADMIN ACCESS ENDS

        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
