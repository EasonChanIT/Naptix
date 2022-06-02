<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
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

        
        $query = $this->Clients->find()
            ->order(['Clients.company_name' => 'ASC']);

        //search function 

        $keyword = $this->request->getQuery('keyword');
        if(!empty($keyword)){
            $cond = array('OR'=>array("CAST(`company_name` AS CHAR CHARACTER SET utf8) COLLATE utf8_general_ci LIKE '%$keyword%'"
            ));
            $clients = $this->paginate($query,['conditions'=>$cond, 'limit' =>10]);
        }
        else{
            $clients = $this->paginate($query,['limit'=>10]);
        }

        foreach($clients as $v){
            $v->tasks = $this->Clients->EmployeeTasks->findByClientId($v->client_id);
        }

        $this->set(compact('clients'));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
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

        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);

        $clientid = $this->Clients->get($id);



        $this->set(compact('client'));


        /** retrieve rows from employeetasks that have the client id  */

        $query = $this->Clients->EmployeeTasks->findByClientId($id);

        $employeetasks = $query
            ->order(['EmployeeTasks.date' => 'DESC']);


        $this->set(compact('employeetasks'));



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

        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                /** CHANGING THE FLASH MESSAGE*/
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
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

        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
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
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
