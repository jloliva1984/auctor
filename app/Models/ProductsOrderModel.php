<?php 
namespace App\Models;

use CodeIgniter\Model;


class ProductsOrderModel extends Model 
{
    protected $table      = 'productsorders';
    protected $primaryKey = 'productsOrdersId';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['productId','orderId','accountId','amount'];
    
    public function saveProductsOrder($accountId,$orderId,$productId,$amount,$productTotalPrice)
    {   
        $db      = \Config\Database::connect();
        $builder = $db->table('productsorders');

        //$this->db->transStart(true); // Query will be rolled back
        $data = ['productId' => $productId,'orderId' => $orderId,'accountId' => $accountId,'amount'  => $amount,'productTotalPrice'=>$productTotalPrice];
        
        $builder->insert($data);
       // $this->db->transComplete();
        if($db->affectedRows()>0)
            {
               return $db->insertID();	
            }
            else
            {
                return 0;
            }
    }

    
    

}
?>