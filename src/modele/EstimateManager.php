<?php
namespace modele;
/**
 * Description of EstimateManager
 *
 * @author lganne
 */
class EstimateManager extends EntiteManager
{
    protected $table="requestestimate";
    
    public function insert($data)
    {
         $sql=sprintf("insert into ".$this->table.
             " (name,siren,adress,cp,ville,pays,civilite,contactNom,contactPrenom,fonction,emailContact,tel,activity,"
                 . "NbreSalarier,optionTheme,commentaire,date_created,date_modif)"
               . " values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',NOW(),NOW())",
                           $data['societe'],
                            $data['siren'],
                            $data['adress'],
                            $data['cp'],
                            $data['ville'],
                            $data['pays'],
                            $data['civilite'],
                             $data['contactNom'],
                             $data['contactPrenom'],
                            $data['fonction'],
                            $data['email'],
                            $data['tel'],
                             $data['activite'],
                             $data['salarier'],
                             $data['option'],
                             $data['commentaire']
                 );
         
           $req=$this->pdo->query($sql);
           return $req;
    }
}
