<?php
namespace modele;
/**
 * Description of PaysManager
 *
 * @author lganne
 */
class PaysManager extends EntiteManager {
    
    protected $table="pays";
    
    
    public function nomPays($lang)
    {
              $results = [];
        $query = sprintf('
                SELECT `%s`
                FROM `%s` order by nom_fr_fr asc ', 
                $lang,
                $this->table
        );
        $stmt = $this->pdo->query($query);
        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) 
           {
            $results[] = $data;
            }
        return $results;
    }    
    
}
