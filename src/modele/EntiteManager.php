<?php
namespace modele;
/**
 * Description of entiteManager
 *
 * @author lganne
 */
abstract class EntiteManager {
    
    protected $pdo = null;
    protected $table;

    public function __construct()
    {
        $this->pdo = \service\Connect::getDB();
    }

    /**
     * all() retourne l'ensemble des enregistrements de la table 
     * 
     * @return \User
     */
    public function all()
    {
        $results = [];

        $query = sprintf('
                SELECT *
                FROM `%s` ', $this->table
        );

        $stmt = $this->pdo->query($query);

        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $results[] = $data;
            
        }
        return $results;
    }

    /**
     * find retourne un enregistrement
     * 
     * @return \User
     */
    public function find($id)
    {
        $results = [];

        $query = sprintf("
                SELECT *
                FROM `{$this->table}` 
                WHERE id=%d", $id
        );
        // gestion des erreurs PDOException
        $stmt = $this->pdo->query($query);
        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $results[] = $data;
        }
        return $results;
    }
    
    public function delete($id)
    {
       $query=sprintf(" delete from {$this->table} where id=%d ",$id) ;
        try{  
              $stmt=$this->pdo->query($query);
            }
             catch(Exception $e)
             {   
                 return "erreur delete"; 
                 
             }
    }

  
    
}

    

