<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * EmployeeTasks Controller
 *
 * @property \App\Model\Table\EmployeeTasksTable $EmployeeTasks
 * @method \App\Model\Entity\EmployeeTask[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeeTasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */



    public function index()
    {
        $this->loadComponent('Paginator');
            
        
            $begin = $this->request->getQuery('begin');
            $end = $this->request->getQuery('end');

            /** employee ids as employee names */

            $item = $this->EmployeeTasks->Employees->find()->all();

            foreach ($item as $v) {
                $employees[$v['employee_id']] = $v['first_name'];
            }

            /** client ids as client names */

            $item = $this->EmployeeTasks->Clients->find()->all();

            foreach ($item as $v) {
                $clients[$v['client_id']] = $v['company_name'];
        }

        /** task ids as task names */

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();

        foreach ($employee_tasks as $employee_task) {
            $tasks[$employee_task['task_id']] = $employee_task['task_name'];
        }

        /** tasks rendered filter */
        $selected_employee = $this->request->getQuery('employee_id');

        $selected_client = $this->request->getQuery('client_id');

        $selected_task = $this->request->getQuery('task_id');

        $invoice_check = $this->request->getQuery('invoice_status');

        $approval_check = $this->request->getQuery('approval_status');

        $query = $this->EmployeeTasks->find()
            ->contain(['Employees', 'Tasks', 'Clients'])
            ->order(['EmployeeTasks.date' => 'DESC']);


        if (!empty($begin)) {
            $query->where(['EmployeeTasks.date >=' => $begin]);
        }
        if (!empty($end)) {
            $query->where(['EmployeeTasks.date <=' => $end]);
        }
        if (!empty($begin) && !empty($end) && $begin > $end){
            $this->Flash->error(__('The end date should be late than begin date.'));
        }

        if (!empty($selected_employee)) {
            $query->where(['EmployeeTasks.employee_id' => $selected_employee]);
        }

        if (!empty($selected_client)) {
            $query->where(['EmployeeTasks.client_id' => $selected_client]);
        }

        if (!empty($selected_task)) {
            $query->where(['EmployeeTasks.task_id' => $selected_task]);
        }

        if (!empty($invoice_check)) {
            $query->where(['EmployeeTasks.invoice_status' => $invoice_check]);
        }

        if (!empty($approval_check)) {
            $query->where(['EmployeeTasks.approval_status' => $approval_check]);
        }

        

        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;
        $employee_id = $this->request->getAttribute('authentication')->getIdentity()->employee_id;

        /** to only display tasks of the employee if not an admin*/
        if ($permissionLevel != 'admin') {
            $query->where(['EmployeeTasks.employee_id =' => $employee_id]);
        }

        
        $this->set('employeeTasks',$this->paginate($query,['limit'=>10]));




        $query_count = $query->count(); //get tasks rendered count
        $query_sum = $query->sumOf('subtotal'); //get tasks rendered subtotal total
        $query_time = $query->sumOf('billable_time'); //get tasks rendered billable time total

 
        $this->set(compact('end'));
        $this->set(compact('begin'));
        $this->set(compact('employees'));
        $this->set(compact('clients'));
        $this->set(compact('tasks'));
        $this->set(compact('selected_employee'));
        $this->set(compact('selected_client'));
        $this->set(compact('selected_task'));
        $this->set(compact('invoice_check'));
        $this->set(compact('approval_check'));


        $this->set('query_count', $query_count);
        $this->set('query_sum', $query_sum);
        $this->set('query_time', $query_time);



    }



    public function newdashboard()
   {
     $this->loadComponent('Paginator');
 
    
     $employee_id = $this->request->getAttribute('authentication')->getIdentity()->employee_id;
     $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;
 
   
    
 
     /** employee ids as employee names */
 
       $item = $this->EmployeeTasks->Employees->find()->all();
 
       foreach ($item as $v) {
           $employees[$v['employee_id']] = $v['first_name'];
       }
 
       /** client ids as client names */
 
       $item = $this->EmployeeTasks->Clients->find()->all();
 
       foreach ($item as $v) {
           $clients[$v['client_id']] = $v['company_name'];
       }
 
       /** task ids as task names */
 
       $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();
 
       foreach ($employee_tasks as $employee_task) {
           $tasks[$employee_task['task_id']] = $employee_task['task_name'];
       }
   
       /** display tasks rendered  */
      
       $queryRecent = $this->EmployeeTasks->find()
           ->order(['EmployeeTasks.date' => 'DESC'])
           ->contain(['Employees', 'Tasks', 'Clients']);
 
       /** if not admin, then display tasks rendered logged in user has done  */
 
       if ($permissionLevel != 'admin') {
           $queryRecent->where(['EmployeeTasks.employee_id' => $employee_id]);
           $recentTasks = $this->paginate($queryRecent,['limit'=>5]);
       }
 
        /** if admin, then display all tasks rendered which have not been invoiced */
 
       if ($permissionLevel == 'admin') {
           $queryRecent->where(['EmployeeTasks.invoice_status' => false]);
           $recentTasks = $this->paginate($queryRecent,['limit'=>5]);
       }
 
    /** employee ids as employee names */
 
if($permissionLevel!='admin'){
   $item = $this->EmployeeTasks->Employees->find()->where(['employee_id'=>$employee_id])->all();
}else{
   $item = $this->EmployeeTasks->Employees->find()->all();
}
foreach ($item as $v) {
   $employees[$v['employee_id']] = $v['first_name'];
  
}
  
 
 
 
/** get number of unapproved tasks by employee as well as hours*/
 
 
       $queryTasks = $this->EmployeeTasks->find()
       ->contain(['Employees']);
 
       $queryTasks->where(['EmployeeTasks.approval_status' => 0]);
      
       foreach($queryTasks as $queryTask){
           $nameArray[] =$employees[$queryTask['employee_id']];
           $nameArray = array_unique($nameArray);
       }
       $nameArraySize = count($nameArray);
       $counter = 0;
       $unApprovedTasks = array();
       while($counter < $nameArraySize){       
           $queryId = array_search($nameArray[$counter], $employees);
           $queryTasks = $this->EmployeeTasks->find()
           ->contain(['Employees']);
           $queryTasks->where(['EmployeeTasks.approval_status' => 0]);
           $tempTasks = $queryTasks->where(['EmployeeTasks.employee_id' => $queryId]);
           $queryTaskCount = $tempTasks->count();
 
           foreach ($tempTasks as $timeBillable) {
              
               $queryHoursArray [] = $timeBillable['billable_time'];
               $queryHoursCount = array_sum($queryHoursArray);
 
           }
 
          
 
           $unapprovedArray[$employees[$queryId]] = $queryTaskCount;
           $unApprovedTasks[] = array_values((array)$unapprovedArray);
 
           $hoursUnapprovedArray [] = round($queryHoursCount/60, 1);
 
 
           $counter = $counter + 1;
           $queryTasks = null;
           $queryHoursArray = null;
       }
 
       /** get time approved for month, qtr and year */
 
       $queryMonths = $this->EmployeeTasks->find()
       ->contain(['Employees']);
 
       $currentMonthInt = date('m');
       $currentMonthStr = date('M');
       $currentMonthDisplay = strval($currentMonthStr); 
       $currentYearStr = date('Y');
 
       $monthSales = null;
       $yearSales = null;
       $q1Sales = null;
       $q2Sales = null;
       $q3Sales = null;
       $q4Sales = null;
       $monthTimeOutput = null;
       $yearTimeOutput = null;
       $q1TimeOutput = null;
       $q2TimeOutput = null;
       $q3TimeOutput = null;
       $q4TimeOutput = null;

  
 
       $queryMonths->where(['EmployeeTasks.approval_status' => 1]);
 
       $monthresultArray = [];
       foreach($queryMonths as $queryMonth){
           $resultMonth = $queryMonth['date'];
           $strMonth = $resultMonth->format('m');
           $strYear = $resultMonth->format('Y');
           if ($strMonth == $currentMonthInt And $strYear == $currentYearStr){
 
               $monthresultArray[] = $queryMonth['billable_time'];
               $monthTimeOutput = array_sum($monthresultArray);
               $monthTimeOutput = round($monthTimeOutput/60, 1);
 
               $monthSalesArray[] = $queryMonth['subtotal'];
               $monthSales =  array_sum($monthSalesArray);
              
           }
 
           if ($strYear == $currentYearStr){
 
               $yearresultArray[] = $queryMonth['billable_time'];
               $yearTimeOutput = array_sum($yearresultArray);
               $yearTimeOutput = round($yearTimeOutput/60, 1);
 
               $yearSalesArray[] = $queryMonth['subtotal'];
               $yearSales =  array_sum($yearSalesArray);
           }
 
 
          
           if ($strMonth >= '07' And $strMonth <= '09' And $strYear == $currentYearStr){
 
               $q1resultArray[] = $queryMonth['billable_time'];
               $q1TimeOutput = array_sum($q1resultArray);
               $q1TimeOutput = round($q1TimeOutput/60, 1);
 
               $q1SalesArray[] = $queryMonth['subtotal'];
               $q1Sales =  array_sum($q1SalesArray);
           }
 
           if ($strMonth >= '10' And $strMonth <= '12' And $strYear == $currentYearStr){
 
               $q2resultArray[] = $queryMonth['billable_time'];
               $q2TimeOutput = array_sum($q2resultArray);
               $q2TimeOutput = round($q2TimeOutput/60, 1);
 
               $q2SalesArray[] = $queryMonth['subtotal'];
               $q2Sales =  array_sum($q2SalesArray);
           }
 
           if ($strMonth >= '01' And $strMonth <= '03' And $strYear == $currentYearStr){
 
               $q3resultArray[] = $queryMonth['billable_time'];
               $q3TimeOutput = array_sum($q3resultArray);
               $q3TimeOutput = round($q3TimeOutput/60, 1);
 
               $q3SalesArray[] = $queryMonth['subtotal'];
               $q3Sales =  array_sum($q3SalesArray);
           }
 
           if ($strMonth >= '04' And $strMonth <= '06' And $strYear == $currentYearStr){
 
               $q4resultArray[] = $queryMonth['billable_time'];
               $q4TimeOutput = array_sum($q4resultArray);
               $q4TimeOutput = round($q4TimeOutput/60, 1);
 
               $q4SalesArray[] = $queryMonth['subtotal'];
               $q4Sales =  array_sum($q4SalesArray);
           }
         
       }
      
 
 
 
 
 
 
 
 
 
        /** get time approved but not invoiced as well as accumlative hours*/
 
        $queryTimeNotInvoiced = $this->EmployeeTasks->find()
        ->contain(['Employees']);
      
        $queryTimeNotInvoiced->where(['EmployeeTasks.approval_status' => 1]);
        $queryTimeNotInvoiced->where(['EmployeeTasks.invoice_status' => 0]);
 
        foreach($queryTimeNotInvoiced as $timeNotInvoicedResult){
            $taskApprovedNotInvoiced[] = $timeNotInvoicedResult['billable_time'];
            $taskApprovedNotInvoicedOutput = array_sum($taskApprovedNotInvoiced);
        }
 
        $approvedNotInvoicedTaskCount = $queryTimeNotInvoiced->count();
      
        $timeApprovedNotInvoicedDisplayOutput [] =  $approvedNotInvoicedTaskCount;
        $timeApprovedNotInvoicedDisplayOutput [] = round($taskApprovedNotInvoicedOutput/60 , 1);
 
        /** time approved by top 10 clients */
 
        $queryTimeApprovedTopClients = $this->EmployeeTasks->find()
        ->contain(['Clients']);
 
        $queryTimeApprovedTopClients->where(['EmployeeTasks.approval_status' => 1]);
 
        foreach($queryTimeApprovedTopClients as $clientInfo){
            $clientArray[] = $clients[$clientInfo['client_id']];
            $clientArray = array_unique($clientArray);
        }
 
       $clientArraySize = count($clientArray);
       $counter = 0;
  
 
       while($counter < $clientArraySize){
           $queryId = array_search($clientArray[$counter], $clients);
           $queryTimeApprovedTopClients = $this->EmployeeTasks->find()
           ->contain(['Clients']);
 
           $queryTimeApprovedTopClients->where(['EmployeeTasks.approval_status' => 1]);
          
           $tempBillableTasks = $queryTimeApprovedTopClients->where(['EmployeeTasks.client_id' => $queryId]);
           foreach($tempBillableTasks as $validTask){
               $billableCalculator[] = $validTask['billable_time'];
           }
           $totalbillableTime = array_sum($billableCalculator);
        
 
           $topClientOutputTemp[$queryId]= round($totalbillableTime/60, 1);
           arsort($topClientOutputTemp);
           $topClientOutput[] = array_values((array)$topClientOutputTemp);
          
           $billableCalculator = null;
           $queryTimeApprovedTopClients = null;
           $counter = $counter + 1;
 
       }  
      
       $clientOrderArray = array_keys($topClientOutputTemp);
       $counter = 0;
       while($counter < $clientArraySize){
           $queryId = $clientOrderArray[$counter];
           $topClientLabelArray [] = $clients[$queryId];
 
           $counter = $counter + 1;
       }
 
       $this->set(compact('employees'));
       $this->set(compact('clients'));
       $this->set(compact('tasks'));
       $this->set(compact('recentTasks'));
 
//** variables for Tasks not approved ans hours unapproved per employee
 
       $this->set(compact('unapprovedArray'));
       $this->set(compact('nameArray'));
       $this->set(compact('nameArraySize'));
       $this->set(compact('queryId'));
       $this->set(compact('counter'));
       $this->set(compact('queryTasks'));
       $this->set(compact('queryTaskCount'));
       $this->set(compact('unApprovedTasks'));
       $this->set(compact('hoursUnapprovedArray'));
 
       $this->set(compact('monthSales'));
       $this->set(compact('yearSales'));
       $this->set(compact('q1Sales'));
       $this->set(compact('q2Sales'));
       $this->set(compact('q3Sales'));
       $this->set(compact('q4Sales'));
 
       $this->set(compact('currentMonthDisplay'));
     
     
 
/**variables for time approved by month/qtr/year */
 
       $this->set(compact('currentMonthStr'));
       $this->set(compact('currentMonthInt'));
       $this->set(compact('currentYearStr'));
       $this->set(compact('queryMonths'));
       $this->set(compact('resultMonth'));
       $this->set(compact('strMonth'));
       $this->set(compact('strYear'));
       $this->set(compact('monthresultArray'));
       $this->set(compact('monthTimeOutput'));
       $this->set(compact('yearTimeOutput'));
       $this->set(compact('q1TimeOutput'));
       $this->set(compact('q2TimeOutput'));
       $this->set(compact('q3TimeOutput'));
       $this->set(compact('q4TimeOutput'));
    
 
 
      
/** variables for time approved but not invoiced */
 
      $this->set(compact('taskApprovedNotInvoicedOutput'));
      $this->set(compact('approvedNotInvoicedTaskCount'));
      $this->set(compact('timeApprovedNotInvoicedDisplayOutput'));
 
/** variables for time approved top 10 clients */
 
      $this->set(compact('clientArray'));
      $this->set(compact('topClientOutput'));
      $this->set(compact('clientOrderArray'));
      $this->set(compact('topClientLabelArray'));
      
 
       $begin = $this->request->getData('begin');
       $end = $this->request->getData('end');
 
       $selected_employee = $this->request->getData('employee_id');
 
       $selected_client = $this->request->getData('client_id');
 
       $selected_task = $this->request->getData('task_id');
 
       $invoice_check = $this->request->getData('invoice_status');
 
       $approval_check = $this->request->getData('approval_status');
 
       $query = $this->EmployeeTasks->find()
           ->contain(['Employees', 'Tasks', 'Clients'])
           ->order(['EmployeeTasks.date' => 'DESC']);
 
 
       if (!empty($begin)) {
           $query->where(['EmployeeTasks.date >=' => $begin]);
       }
       if (!empty($end)) {
           $query->where(['EmployeeTasks.date <=' => $end]);
       }
       if (!empty($begin) && !empty($end) && $begin > $end){
           $this->Flash->error(__('The end date should be late than begin date.'));
       }
 
       if (!empty($selected_employee)) {
           $query->where(['EmployeeTasks.employee_id' => $selected_employee]);
       }
 
       if (!empty($selected_client)) {
           $query->where(['EmployeeTasks.client_id' => $selected_client]);
       }
 
       if (!empty($selected_task)) {
           $query->where(['EmployeeTasks.task_id' => $selected_task]);
       }
 
       if (!empty($invoice_check)) {
           $query->where(['EmployeeTasks.invoice_status' => $invoice_check]);
       }
 
       if (!empty($approval_check)) {
           $query->where(['EmployeeTasks.approval_status' => $approval_check]);
       }
 
      
       if ($permissionLevel != 'admin') {
           $query->where(['EmployeeTasks.employee_id =' => $employee_id]);
       }
 
       $query_count = $query->count(); //get tasks rendered count
       $query_sum = $query->sumOf('subtotal'); //get tasks rendered subtotal total
       $query_time = $query->sumOf('billable_time'); //get tasks rendered billable time total
 
      
       $this->set(compact('end'));
       $this->set(compact('begin'));
 
       $this->set(compact('query'));
      
 
 
       $this->set(compact('selected_employee'));
       $this->set(compact('selected_client'));
       $this->set(compact('selected_task'));
       $this->set(compact('invoice_check'));
       $this->set(compact('approval_check'));
 
       $this->set('query_count', $query_count);
       $this->set('query_sum', $query_sum);
       $this->set('query_time', $query_time);
 
 
      
 
   }


    /**
     * View method
     *
     * @param string|null $id Employee Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employeeTask = $this->EmployeeTasks->get($id, [
            'contain' => ['Employees', 'Tasks', 'Clients'],
        ]);

        $this->set(compact('employeeTask'));

    }

    public function view2($id = null)
    {
        $employeeTask = $this->EmployeeTasks->get($id, [
            'contain' => ['Employees', 'Tasks', 'Clients'],
        ]);

        $this->set(compact('employeeTask'));


    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($client_id = null)
    {
        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;
        $employee_id = $this->request->getAttribute('authentication')->getIdentity()->employee_id;

        $employeeTask = $this->EmployeeTasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $employeeTask = $this->EmployeeTasks->patchEntity($employeeTask, $this->request->getData());
            if ($this->EmployeeTasks->save($employeeTask)) {
                $this->Flash->success(__('The employee task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee task could not be saved. Please, try again.'));
        }



        /** employee ids as employee names */

        if($permissionLevel!='admin'){
            $item = $this->EmployeeTasks->Employees->find()->where(['employee_id'=>$employee_id])->all();
        }else{
            $item = $this->EmployeeTasks->Employees->find()->all();
        }
        foreach ($item as $v) {
            $employees[$v['employee_id']] = $v['first_name'];
        }



        /** task ids as task names */

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();

        foreach ($employee_tasks as $employee_task) {
            $tasks[$employee_task['task_id']] = $employee_task['task_name'];

           

        }

        /** task price from the task id*/

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();
        foreach ($employee_tasks as $employee_task) {
            $tasks_price[$employee_task['task_id']] = $employee_task['task_rate'];


        }

        /** client ids as client names */

        if($client_id !=null){
            $item = $this->EmployeeTasks->Clients->find()->where(['client_id'=>$client_id])->all();
        }else{
         $item = $this->EmployeeTasks->Clients->find()->all();
        }
        foreach ($item as $v) {
            $clients[$v['client_id']] = $v['company_name'];
        }


        $this->set(compact('employeeTask', 'employees', 'tasks', 'clients', 'tasks_price',"employee_id"));


    }

    public function add2($client_id = null)
    {
        $permissionLevel = $this->request->getAttribute('authentication')->getIdentity()->permission_level;
        $employee_id = $this->request->getAttribute('authentication')->getIdentity()->employee_id;

        $employeeTask = $this->EmployeeTasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $employeeTask = $this->EmployeeTasks->patchEntity($employeeTask, $this->request->getData());
            if ($this->EmployeeTasks->save($employeeTask)) {
                $this->Flash->success(__('The employee task has been saved.'));

                return $this->redirect(['controller' => 'Clients','action' => 'index']);
            }
            $this->Flash->error(__('The employee task could not be saved. Please, try again.'));
        }



        /** employee ids as employee names */

        if($permissionLevel!='admin'){
            $item = $this->EmployeeTasks->Employees->find()->where(['employee_id'=>$employee_id])->all();
        }else{
            $item = $this->EmployeeTasks->Employees->find()->all();
        }
        foreach ($item as $v) {
            $employees[$v['employee_id']] = $v['first_name'];
        }



        /** task ids as task names */

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();

        foreach ($employee_tasks as $employee_task) {
            $tasks[$employee_task['task_id']] = $employee_task['task_name'];

       

        }

        /** task price from the task id*/

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();
        foreach ($employee_tasks as $employee_task) {
            $tasks_price[$employee_task['task_id']] = $employee_task['task_rate'];

       

        }

        /** client ids as client names */

        if($client_id !=null){
            $item = $this->EmployeeTasks->Clients->find()->where(['client_id'=>$client_id])->all();
        }else{
         $item = $this->EmployeeTasks->Clients->find()->all();
        }
        foreach ($item as $v) {
            $clients[$v['client_id']] = $v['company_name'];
        }


        $this->set(compact('employeeTask', 'employees', 'tasks', 'clients', 'tasks_price'));


    }

    /**
     * Edit method
     *
     * @param string|null $id Employee Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employeeTask = $this->EmployeeTasks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeTask = $this->EmployeeTasks->patchEntity($employeeTask, $this->request->getData());
            if ($this->EmployeeTasks->save($employeeTask)) {
                $this->Flash->success(__('The employee task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee task could not be saved. Please, try again.'));
        }


        /** employee ids as employee names */


        $item = $this->EmployeeTasks->Employees->find()->all();
        foreach ($item as $v) {
            $employees[$v['employee_id']] = $v['first_name'];
        }

        /** task ids as task names */

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();

        foreach ($employee_tasks as $employee_task) {
            $tasks[$employee_task['task_id']] = $employee_task['task_name'];

        }

        /** task price from the task id*/

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();
        foreach ($employee_tasks as $employee_task) {
            $tasks_price[$employee_task['task_id']] = $employee_task['task_rate'];

        }


    

        /** client ids as client names */

        $item = $this->EmployeeTasks->Clients->find()->all();
        foreach ($item as $v) {
            $clients[$v['client_id']] = $v['company_name'];
        }


        $this->set(compact('employeeTask', 'employees', 'tasks', 'clients', 'tasks_price'));

    }

    public function edit2($id = null)
    {
        $employeeTask = $this->EmployeeTasks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeTask = $this->EmployeeTasks->patchEntity($employeeTask, $this->request->getData());
            if ($this->EmployeeTasks->save($employeeTask)) {
                $this->Flash->success(__('The employee task has been saved.'));

                return $this->redirect(['controller' => 'Clients','action' => 'index']);
            }
            $this->Flash->error(__('The employee task could not be saved. Please, try again.'));
        }


        /** employee ids as employee names */


        $item = $this->EmployeeTasks->Employees->find()->all();
        foreach ($item as $v) {
            $employees[$v['employee_id']] = $v['first_name'];
        }

        /** task ids as task names */

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();

        foreach ($employee_tasks as $employee_task) {
            $tasks[$employee_task['task_id']] = $employee_task['task_name'];

        }

        /** task price from the task id*/

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();
        foreach ($employee_tasks as $employee_task) {
            $tasks_price[$employee_task['task_id']] = $employee_task['task_rate'];

        }


   

        /** client ids as client names */

        $item = $this->EmployeeTasks->Clients->find()->all();
        foreach ($item as $v) {
            $clients[$v['client_id']] = $v['company_name'];
        }


        $this->set(compact('employeeTask', 'employees', 'tasks', 'clients', 'tasks_price'));

    }

    public function edit3($id = null)
    {
        $employeeTask = $this->EmployeeTasks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeTask = $this->EmployeeTasks->patchEntity($employeeTask, $this->request->getData());
            if ($this->EmployeeTasks->save($employeeTask)) {
                $this->Flash->success(__('The employee task has been saved.'));

                return $this->redirect(['controller' => 'EmployeeTasks','action' => 'newdashboard']);
            }
            $this->Flash->error(__('The employee task could not be saved. Please, try again.'));
        }


        /** employee ids as employee names */


        $item = $this->EmployeeTasks->Employees->find()->all();
        foreach ($item as $v) {
            $employees[$v['employee_id']] = $v['first_name'];
        }

        /** task ids as task names */

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();

        foreach ($employee_tasks as $employee_task) {
            $tasks[$employee_task['task_id']] = $employee_task['task_name'];

        }

        /** task price from the task id*/

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();
        foreach ($employee_tasks as $employee_task) {
            $tasks_price[$employee_task['task_id']] = $employee_task['task_rate'];

        }



        /** client ids as client names */

        $item = $this->EmployeeTasks->Clients->find()->all();
        foreach ($item as $v) {
            $clients[$v['client_id']] = $v['company_name'];
        }


        $this->set(compact('employeeTask', 'employees', 'tasks', 'clients', 'tasks_price'));

    }
    public function update($id = null)
    {
        $this->request->allowMethod(['post']);
        $employeeTask = $this->EmployeeTasks->get($id, [
            'contain' => [],
        ]);
        $employeeTask->invoice_status = 1;
        if ($this->EmployeeTasks->save($employeeTask)) {
            $this->Flash->success(__('The invoice has been saved.'));
        } else {
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }


    /**
     * Delete method
     *
     * @param string|null $id Employee Task id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employeeTask = $this->EmployeeTasks->get($id);
        if ($this->EmployeeTasks->delete($employeeTask)) {
            $this->Flash->success(__('The employee task has been deleted.'));
        } else {
            $this->Flash->error(__('The employee task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete2($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employeeTask = $this->EmployeeTasks->get($id);
        if ($this->EmployeeTasks->delete($employeeTask)) {
            $this->Flash->success(__('The employee task has been deleted.'));
        } else {
            $this->Flash->error(__('The employee task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Clients','action' => 'index']);
    }

    public function delete3($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employeeTask = $this->EmployeeTasks->get($id);
        if ($this->EmployeeTasks->delete($employeeTask)) {
            $this->Flash->success(__('The employee task has been deleted.'));
        } else {
            $this->Flash->error(__('The employee task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'EmployeeTasks','action' => 'newdashboard']);
    }

    public function pdf($id = null)
    {
            /** employee ids as employee names */

            $item = $this->EmployeeTasks->Employees->find()->all();

            foreach ($item as $v) {
                $employees[$v['employee_id']] = $v['first_name'];
            }

            /** client ids as client names */

            $item = $this->EmployeeTasks->Clients->find()->all();

            foreach ($item as $v) {
                $clients[$v['client_id']] = $v['company_name'];
        }

        /** task ids as task names */

        $employee_tasks = $this->EmployeeTasks->Tasks->find()->all();

        foreach ($employee_tasks as $employee_task) {
            $tasks[$employee_task['task_id']] = $employee_task['task_name'];
        }

        /** tasks rendered filter */
        $begin = $this->request->getQuery('begin');
        $end = $this->request->getQuery('end');
        $selected_employee = $this->request->getQuery('employee_id');

        $selected_client = $this->request->getQuery('client_id');

        $selected_task = $this->request->getQuery('task_id');

        $invoice_check = $this->request->getQuery('invoice_status');

        $approval_check = $this->request->getQuery('approval_status');

        $query = $this->EmployeeTasks->find()
            ->contain(['Employees', 'Tasks', 'Clients'])
            ->order(['EmployeeTasks.date' => 'DESC']);


        if (!empty($begin)) {
            $query->where(['EmployeeTasks.date >=' => $begin]);
        }
        if (!empty($end)) {
            $query->where(['EmployeeTasks.date <=' => $end]);
        }
        if (!empty($begin) && !empty($end) && $begin > $end){
            $this->Flash->error(__('The end date should be late than begin date.'));
        }

        if (!empty($selected_employee)) {
            $query->where(['EmployeeTasks.employee_id' => $selected_employee]);
        }

        if (!empty($selected_client)) {
            $query->where(['EmployeeTasks.client_id' => $selected_client]);
        }

        if (!empty($selected_task)) {
            $query->where(['EmployeeTasks.task_id' => $selected_task]);
        }

        if (!empty($invoice_check)) {
            $query->where(['EmployeeTasks.invoice_status' => $invoice_check]);
        }

        if (!empty($approval_check)) {
            $query->where(['EmployeeTasks.approval_status' => $approval_check]);
        }
            $this->viewBuilder()->enableAutoLayout(false);
            $this->viewBuilder()->setClassName('CakePdf.Pdf');
            $this->viewBuilder()->setOption(
                'pdfConfig',
                [
                    'orientation' => 'portrait',
                    'filename' => 'TaskList'. $selected_client
                ]
            );
        $this->set('query',$query);
        }
}

