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
       $insert=false;
    
       $sql=sprintf("insert into ".$this->table.
             " (name,siren,siret,adress,contact,fonction,emailContact,tel,description,juridique,date_created,date_modif)"
               . " values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',NOW(),NOW())",
                           $data['societe'],
                            $data['siren'],
                           $data['siret'],
                            $data['adress'],
                             $data['contact'],
                            $data['fonction'],
                            $data['email'],
                            $data['tel'],
                             $data['description'],
                             $data['forme']
                 );

                   return  $req=$this->pdo->query($sql);
       return $insert;
   }
}
