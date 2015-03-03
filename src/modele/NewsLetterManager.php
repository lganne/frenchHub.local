<?php
namespace modele;
/**
 * Description of NewsLetterManager
 *
 * @author lganne
 */
class NewsLetterManager extends EntiteManager
{
     protected $table = 'newsletter';
     
     
     public function insert($donne)
     {
         $sql=sprintf("insert into ".$this->table.
             " (entreprises_id,logement,immigration,competitivite,fiscalite,integration,marque)"
                . " values ('%d','%d','%sd','%d','%d','%d','%d')",
                           $donne['ent'],
                           $donne['news1'],
                           $donne['news2'],
                            $donne['news3'],
                            $donne['news4'],
                            $donne['news5'],
                         $donne['news6']);
             
          $req=$this->pdo->query($sql);
          return $req;
     }
}
