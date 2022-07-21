<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Empresas extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function empresasManagement()
	{
        
	    $crud = new GroceryCrud();
        
        $crud->setTable('empresas');
		$crud->setSubject('Empresas');
		
        

		$output = $crud->render();
		$data['title']='Empresas';


		 
		$output->data = $data;

		return $this->_exampleOutput($output);
	}

	

    private function _exampleOutput($output = null) {
        return view('clinicasView', (array)$output);
    }
}
