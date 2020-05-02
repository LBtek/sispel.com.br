<?php
class Users extends model {

    private $sql = "";

/*-----------------------------------------------------------------------------------------------------------*/
    private function getUser($email, $senha) {
        $this->sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $this->sql = $this->db->prepare($this->sql);
        $this->sql->bindValue(':email', addslashes($email));
        $this->sql->bindValue(':senha', addslashes($senha));
        $this->sql->execute();
        if($this->sql->rowCount() > 0) {
            $this->sql = $this->sql->fetch();
        } else {
            $this->sql = "";
        }
    }   
/*-----------------------------------------------------------------------------------------------------------*/    
    public function getUserId($email, $senha) {
        $this->getUser($email, $senha);
        if ($this->sql != "" && $this->sql['id']) {
            return $this->sql['id'];
        } else {
            return "";
        }
    }
/*-----------------------------------------------------------------------------------------------------------*/

}