<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountsModel extends Model
{
    protected $table      = 'accounts';
    protected $primaryKey = 'accountId';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['name', 'phoneNumber','street','city','state','postalCode'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
    public function accountsWithoutOrder()
    {
      $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        accounts.name,
        accounts.phoneNumber,
        accounts.street,
        accounts.city,
        accounts.state
        FROM
        accounts
        left Join orders ON accounts.accountId = orders.accountId
        WHERE
        orders.accountId IS NULL 
              
        ");
        if($db->affectedRows()>0)
         {
          return $query->getResult();
         }
         else { return 0;}
      
    }
    public function getTotalAccounts()
    {
      $db      = \Config\Database::connect();
        $query = $db->query("SELECT
        Count(accounts.accountId) as totalAccounts
        FROM
        accounts
        
              
        ");
        if($db->affectedRows()>0)
         {
          return $query->getResult();
         }
         else { return 0;}
      
    }

  }