<?php namespace App\Controllers;
use Illuminate\Cookie\CookieJar;
use App\Models\AccountsModel;
use App\Models\ProductsModel;
use App\Models\OrderModel;
use App\Models\ProductsOrderModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class Orders extends BaseController
{
	public function __construct()
	{
		helper(['url','form','form_validation']);
		
	}
	public function index()
	{
		$accounts = new AccountsModel();
        $products = new ProductsModel();
        $orders=new OrderModel();
        
       	
		$data = ['accounts' => $accounts->findAll(),'products'=>$products->findAll(),'orders'=>$orders->getOrderDataAll()];
		return view('ordersView',$data);
    }
    public function dashboard()
    {
       
       
        $mostDemanded = new ProductsModel();
        $accounts = new AccountsModel();
        $orders=new OrderModel();
       
        $data = ['mostDemanded' => $mostDemanded->mostDemanded(),'accountWithoutOrders'=> $accounts->accountsWithoutOrder(),'totalAccounts'=> $accounts->getTotalAccounts(),
        'orders'=>$orders->getOrderDataAll()];
        return view('dashboardView',$data); 
    }

	public function saveOrder()
    { 
        
         $request = service('request');//para poder usar $request->getPost
         
         helper('text');
        if ($this->request->isAJAX())//funcion de codeigniter -servicio CodeIgniter\HTTP\RequestInterface;
        { 
           $accountId=$request->getPost('account');
           $productosId=$request->getPost('products');
           $prices=$request->getPost('price');
           $amounts=$request->getPost('amount');
           if(isset($accountId) && $accountId!=NULL && isset($productosId) && $productosId!=NULL && isset($prices) && $prices!=NULL && isset($amounts) && $amounts!=NULL)
           {
            $validation =  \Config\Services::validation();
		    $validation->setRules(['account' => 'required|integer|greater_than[0]','products' => 'required|integer|greater_than[0]','price' => 'required','amount' => 'required']);   
            $html[0]=''; 
            // $htmlfilatotales='';
             $subTotal=0;  
            
            //saving order
            $order=new OrderModel();

            $db      = \Config\Database::connect();//using transactions
            $db->transBegin();

            $insertedOrderId=$order->saveOrder($accountId,0,7,0);
            
            for($count=0;$count<count($productosId);$count++)
            {
                $productsOrder=new ProductsOrderModel();
                $productsOrderInsertedId=$productsOrder->saveProductsOrder($accountId,$insertedOrderId,$productosId[$count],$amounts[$count],$amounts[$count]*$prices[$count]);
            
                    
                    if($productsOrderInsertedId !=0)//searching inserted data to concat html variable for sending it to the view
                    { 
                    $orderData=$order->getOrderData($insertedOrderId);

                    $html[0].='<tr><td>'.$orderData[0]->account.'</td><td>#'.$orderData[0]->orderId.'</td><td>'.$orderData[0]->subtotal.'</td><td class="valor">'.$orderData[0]->tax.'</td><td>'.$orderData[0]->total.'</td><td><button type="button" name="remove_descarga" class="btn btn-danger  btn-sm" value="'.$orderData[0]->orderId.'" remove_descarga" id="'.$orderData[0]->orderId.'" onclick="eliminar_descarga('.$orderData[0]->orderId.')"><i class="fa fa-minus-circle"></i></td></tr>';
                    }
                
                    $subTotal+=$amounts[$count]*$prices[$count];
                    

            }
            $total=$subTotal*($order->getTax($insertedOrderId)[0]->tax)/100+$subTotal;
            $result=$order->setOrderTotals($insertedOrderId,$subTotal,$total);

            if ($db->transStatus() === FALSE)
            {
               $db->transRollback();
               //show error msg
            }
            else
            {
                $db->transCommit();
            }  
        //end using transactions

           }
           $html=strip_slashes($html[0]);
           $html[0] = str_replace ('"\"',' ', $html[0]);
           echo ($html)  ; 

        } 
    }

    public function getOrderDetails()
    {
       
        $request = service('request');
        $orderId=$request->getPost('orderId');
        $order=new OrderModel();
        $orderDetails=$order->getOrderDetails($orderId);
        $html='';
        $html.='<div class="card">
        <div class="card-header text-right">Order # '.$orderDetails[0]->orderId .'| Account - '.$orderDetails[0]->account.'</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" align="center">
                    <table id="orderDetailsTable" align="center" class="table table-bordered table-hover table-striped table-sm table-responsive" width="100%">
                        <thead class="thead-dark">';
                     
                            $html.='<tr>
                                <th width="">Product</th>
                                <th width="">Price</th>
                                <th>Amount</th>
                                <th>Total Price</th>
                             </tr></thead>';
                          

                          
                        $html.='<tbody id="">';
                        foreach($orderDetails as $orderDetail):
                            $html.='<tr>
                            <th width=""><p class="small">'.$orderDetail->product.'</p></th>
                            <th width=""><p class="small">'.$orderDetail->price.'</p></th>
                            <th><p class="small">'.$orderDetail->amount.'</p></th>
                            <th><p class="small">'.$orderDetail->productTotalPrice.'</p></th>
                            </tr>';

                           endforeach;
                           $html.='</tbody>
                       
                            <tfoot>
                            <tr>
                                <td colspan="3" align="right"><strong>Subtotal</strong></td>
                                <td colspan="">
                                    <input type="text" class="form-control form-control-sm text-right" name="monto_subtotal00" id="monto_subtotal00" readonly="" value="$ '.$orderDetail->subtotal.'">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" align="right"><strong>Tax</strong></td>
                                <td colspan="">
                                    <input type="text" class="form-control form-control-sm text-right" name="monto_subtotal12" id="monto_subtotal12" readonly="" value="'.$orderDetail->tax.'%">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" align="right"><strong>Total</strong></td>
                                <td colspan="">
                                    <input type="text" class="form-control form-control-sm text-right" name="monto_iva" id="monto_iva" readonly="" value="$ '.$orderDetail->total.'">
                                </td>
                            </tr>

                            </tfoot>
                           
                        
                    </table>
                   
                </div>
            </div>
           
        </div>
    </div>';

       echo json_encode($html);
     
    }

	//--------------------------------------------------------------------

}
