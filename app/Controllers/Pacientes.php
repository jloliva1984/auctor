<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Pacientes extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function pacientesManagement()
	{
        
	    $crud = new GroceryCrud();
        
        $crud->setTable('pacientes');
		$crud->setSubject('Pacientes');
		  
        

		$output = $crud->render();
		$data['title']='Pacientes';
		 
		$output->data = $data;

		return $this->_exampleOutput($output);
	}

	public function getProducts()
	{
		$request = service('request');
		if ($this->request->isAJAX())
        { 
		   $productId=$request->getPost('productId');
		   $products = new ProductsModel();
		   $product = $products->find($productId);
		   echo json_encode(array("status" => 'ok',"price"=>$product->price));
		}   
		else
		{
			//show error message
		}
		
		
	}



    private function _exampleOutput($output = null) {
        return view('pacientesView', (array)$output);
    }
}
