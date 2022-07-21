<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'productId';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['name', 'price','phone'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';

  public function mostDemanded()
  {
    $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        Count(productsorders.productId) AS timesDemanded,
        products.name,
        Sum(productsorders.amount) AS mostDemanded
        FROM
                products
                Inner Join productsorders ON products.productId = productsorders.productId
        GROUP BY
        productsorders.productId,
        products.name
        ORDER BY mostDemanded DESC
              
        ");
        if($db->affectedRows()>0)
         {
          return $query->getResult();
         }
         else { return 0;}
  }
  
  public function deleteProduct($productId)
  {
    
  }
  

  }