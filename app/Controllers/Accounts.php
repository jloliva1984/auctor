<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;

class Accounts extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function accountManagement()
	{
        
	    $crud = new GroceryCrud();
        
        $crud->setTable('accounts');
		$crud->setSubject('Accounts');
		  
        

		$output = $crud->render();
		$data['title']='Accounts';
		 
		$output->data = $data;

		return $this->_exampleOutput($output);
	}



    private function _exampleOutput($output = null) {
        return view('accountView', (array)$output);
    }
}
