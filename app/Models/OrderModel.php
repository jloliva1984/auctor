<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'orderId';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['accountId','subtotal', 'tax','total','created_at'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    

    public function saveOrder($accountId,$subtotal,$tax,$total)
    {   
        $db      = \Config\Database::connect();
        $builder = $db->table('orders');

        //$this->db->transStart(true); // Query will be rolled back
        $data = [
            'accountId' => $accountId,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total'  => $total,
            
            
        ];
        
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

    public function getOrderData($orderId)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        accounts.name as account,
        orders.subtotal,
        orders.tax,
        orders.total,
        products.name product,
        productsorders.amount,
        orders.orderId
        FROM
        accounts
        Inner Join orders ON accounts.accountId = orders.accountId
        Inner Join productsorders ON orders.orderId = productsorders.orderId
        Inner Join products ON products.productId = productsorders.productId
        WHERE
        orders.orderId =  $orderId
        ");
        if($db->affectedRows()>0)
         {
          return $query->getResult();
         }
         else { return 0;}

    //    $sql = $builder->getCompiledSelect();
    //    echo ($sql);
    }

    public function getOrderDataAll()
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        accounts.name,
        orders.orderId,
        orders.tax,
        orders.total,
        orders.subtotal
        FROM
        accounts
        Inner Join orders ON accounts.accountId = orders.accountId
              
        ");
        if($db->affectedRows()>0)
         {
          return $query->getResult();
         }
         else { return 0;}

    //    $sql = $builder->getCompiledSelect();
    //    echo ($sql);
    }
    public function getOrderDetails($orderId)
    {
        $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        orders.accountId,
        productsorders.amount,
        productsorders.productTotalPrice,
        accounts.name AS account,
        products.name AS product,
        products.price,
        orders.subtotal,
        orders.tax,
        orders.total,
        orders.orderId
        FROM
                orders
                Inner Join productsorders ON orders.orderId = productsorders.orderId
                Inner Join accounts ON accounts.accountId = orders.accountId
                Inner Join products ON products.productId = productsorders.productId
        WHERE
                orders.orderId =  '$orderId'
              
        ");
        if($db->affectedRows()>0)
         {
          return $query->getResult();
         }
         else { return 0;}

    }
    public function setOrderTotals($orderId,$subtotal,$total)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('orders');

        $data = ['subtotal' => $subtotal,'total'=>$total];
        $builder->where('orderId', $orderId);
        $builder->update($data);
        if($db->affectedRows()>0) { return 1;} else { return 0;}//1 si modifica , 0 si no		

    }

    public function getTax($orderId)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('tax');
        $builder->where('orderId', $orderId);
       
        $query = $builder->get();
        if($db->affectedRows()>0)
         {
          return $query->getResult();
         }
         else { return 0;}

    }

  }