<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
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


        $query = $this->Employees->find()
            ->order(['Employees.first_name' => 'ASC']);

       /** search function */

        $keyword = $this->request->getQuery('keyword');
        if(!empty($keyword)){
            $cond = array('OR'=>array("CAST(`first_name` AS CHAR CHARACTER SET utf8) COLLATE utf8_general_ci LIKE '%$keyword%'",
                "CAST(`last_name` AS CHAR CHARACTER SET utf8) COLLATE utf8_general_ci LIKE '%$keyword%'",
                "CAST(`permission_level` AS CHAR CHARACTER SET utf8) COLLATE utf8_general_ci LIKE '%$keyword%'"
            ));
            $employees = $this->paginate($query,['conditions'=>$cond, 'limit' =>10]);
        }
        else{
            $employees = $this->paginate($query,['limit'=>10]);
        }

        foreach($employees as $v){
            $v->tasks = $this->Employees->EmployeeTasks->findByEmployeeId($v->employee_id);
        }

        $this->set(compact('employees'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
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


        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('employee'));



        $employeetasks = $this->Employees->EmployeeTasks->findByEmployeeId($id);
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

        $employee = $this->Employees->newEmptyEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login']);

}

public function login()
{
    $this->viewBuilder()->setLayout('default2');

    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result->isValid()) {
        // redirect to /dashboard after login success
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'EmployeeTasks',
            'action' => 'newdashboard',
        ]);

        return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }
}
// in src/Controller/EmployeesController.php
public function logout()
{
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Employees', 'action' => 'login']);
    }
}


    /**
     * Edit method
     *
     * @param string|null $id Employee id.
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


        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
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
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
