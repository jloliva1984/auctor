<?php namespace App\Controllers;
use App\Libraries\GroceryCrud;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Clinicas extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function clinicasManagement()
	{
        
	    $crud = new GroceryCrud();
        
        $crud->setTable('clinicas');
		$crud->setSubject('Clínicas');
		$crud->setRelation('empresaId','empresas','nombre');
		$crud->displayAs('empresaId','Empresa'); 

		$crud->columns(['empresaId','nombre','Pacientes']); 
		
		$crud->callbackColumn('Pacientes', array($this, '_pacientes'));

		$output = $crud->render();
		$data['title']='Clinicas';


		 
		$output->data = $data;

		return $this->_exampleOutput($output);
	}

	public function _pacientes($value, $row)
    {
		//var_dump($row);exit;
        $id_proyecto=1;
        // $id_proyecto=$row->id_proyecto;
         $icono = base_url() . '/assets/images/descarga.png';
         
          return
          '
           <a href="' . base_url() . '/Pacientes/pacientesManagement/' . $id_proyecto . '" style="align-content: center">
           <i class="fas fa-hospital-user fa-2x"></i>
           </a>' ;
    }
	

    private function _exampleOutput($output = null) {
        return view('clinicasView', (array)$output);
    }
}
