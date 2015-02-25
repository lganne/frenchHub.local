<?php
namespace modele;
/**
 * Description of informationManager
 *
 * @author lganne
 */
class informationManager extends EntiteManager{
    
    protected $table="informations";
    
    public function insert($data)
    {
       
      $sql=sprintf("insert into ".$this->table.
             " (name,contact,fonction,emailcontact,tel,date_created)"
               . " values ('%s','%s','%s','%s','%s',NOW())",
                           $data['societe'],
                            $data['contact'],
                            $data['fonction'],
                            $data['email'],
                            $data['tel']
                                     );
                    $req=$this->pdo->query($sql);
                     $rep= ($req!= false) ? true : false;
                 return $rep;
    }
    
}
