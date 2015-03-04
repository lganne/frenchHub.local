<?php
namespace modele;
/**
 * Description of EmployeeManager
 *
 * @author lganne
 */
class EmployeeManager extends EntiteManager
{
      protected $table = 'employee';
    
   public function insert($data)
   {
        $sql=sprintf("insert into ".$this->table.
             " (entreprises_id,name,firstname,fonction,email) "
                . "values('%d','%s','%s','%s','%s')",
                 $data['ident'],
                  $data['Nom'],
                  $data['Prenom'],
                   $data['fonction'],
                 $data['email']);
        
        $req=$this->pdo->query($sql);
         if ($req!=null)
                  {
                      $reponse= $this->pdo->lastInsertId();
                  }
                  else
                  {
                      $reponse=false;
                  }
                    
                   return $reponse;
   }
    
}
