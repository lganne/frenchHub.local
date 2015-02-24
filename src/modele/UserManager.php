<?php

namespace modele;


class UserManager extends \modele\EntiteManager
{

    protected $table = 'users';

public function save($tabDonne)
{
    
     $sql=sprintf("insert into ".$this->table.
             " (username,password,email,salt,token,date_created,date_modif,role) values ('%s','%s','%s','%s','%s',NOW(),NOW(),'%s')",
                           $tabDonne['username'],
                            $tabDonne['password'],
                            $tabDonne['email'],
                            $tabDonne['salt'],
                            $tabDonne['token'],
                            $tabDonne['role']);

                   return  $req=$this->pdo->query($sql);
}

    public function query($password)
    {
        $results = [];
        $query = sprintf("SELECT * FROM `users` WHERE password='%s'", $password);

        $stmt = $this->pdo->query($query);
        while ($data = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $results[] = $data;
        }
        return $results;
    }

    public function verifLog ($pass,$login)
    {
        $rep=false;
        $sql="select * from users where username = :login";
        $query=$this->pdo->prepare($sql);
        $query->execute(array('login'=>$login));
        $data=$query->fetch(\PDO::FETCH_OBJ);
        
        $motPasse=$data->salt.$pass.$data->salt;
        $verifPass=\service\DiverService::codepassword($motPasse);
        If ($verifPass==$data->password)
        {
            $rep=true;
        }
        $donnee=array("id"=>$data->id,"login"=>$data->username,"token"=>$data->token,"role"=>$data->role);
        return array('reponse'=>$rep,'donnee'=>$donnee);
    }
    
     public function update($data)
    {
          $sql = "update {$this->table} set username=:username,email=:mail,role=:role,date_modif=NOW()"
        . "where id= :id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(':username'=>$data["login"],
            ':mail'=>$data["mail"],
            ':role'=>$data["role"],
            ':id'=>$data['id']));

              
        
    }
}
