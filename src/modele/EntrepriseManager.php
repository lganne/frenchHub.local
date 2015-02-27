<?php
namespace modele;

/**
 * Description of EntrepriseManager
 *
 * @author lganne
 */
class EntrepriseManager extends \modele\EntiteManager {
    
    protected $table = 'entreprises';
    
   public function insert($data)
   {
      $sql=sprintf("insert into ".$this->table.
             " (name,siren,siret,adress,pays,contact,fonction,emailContact,tel,description,juridique,date_created,date_modif)"
               . " values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',NOW(),NOW())",
                           $data['societe'],
                            $data['siren'],
                           $data['siret'],
                            $data['adress'],
                            $data['pays'],
                             $data['contact'],
                            $data['fonction'],
                            $data['email'],
                            $data['tel'],
                             $data['description'],
                             $data['forme']
                 );
                  $req=$this->pdo->query($sql);
                  if ($req!=null)
                  {
                      $rep= $this->pdo->lastInsertId();
                  }
                  else
                  {
                      $rep=0;
                  }
                    
                   return $rep;
     
   }
}
