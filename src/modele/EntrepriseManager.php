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
             " (name,siren,adress,cp,ville,pays,civilite,contactNom,contactPrenom,fonction,emailContact,tel,activity,NbreSalarier,date_created,date_modif)"
               . " values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',NOW(),NOW())",
                           $data['societe'],
                            $data['siren'],
                            $data['adress'],
                            $data['cp'],
                            $data['ville'],
                            $data['pays'],
                            $data['civilite'],
                             $data['nom'],
                             $data['prenom'],
                            $data['fonction'],
                            $data['email'],
                            $data['tel'],
                             $data['activite'],
                             $data['salarier']
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
