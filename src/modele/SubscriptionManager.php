<?php
namespace modele;
/**
 * Description of subscriptionManager
 *
 * @author lganne
 */
class SubscriptionManager  extends EntiteManager
{
     protected $table = 'Subscription';
     
     
     public function insert($donne)
     {
         $sql=sprintf("insert into ".$this->table.
             " (entreprises_id,formule1,formule2,formule3,formule4,date_created)"
                . " values ('%d','%s','%s','%s','%s',NOW())",
                           $donne['ent'],
                           $donne['formule1'],
                            $donne['formule2'],
                            $donne['formule3'],
                            $donne['formule4']);
         
          $req=$this->pdo->query($sql);
          return $req;
     }
     
}
