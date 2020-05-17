<?php
class Users extends model {

    private $sql = "";

/*-----------------------------------------------------------------------------------------------------------*/
    public function getUser($email, $senha) {
        $this->sql = "SELECT email, id, img FROM usuarios WHERE email = :email AND senha = :senha";
        $this->sql = $this->db->prepare($this->sql);
        $this->sql->bindValue(':email', addslashes($email));
        $this->sql->bindValue(':senha', addslashes($senha));
        $this->sql->execute();

        if($this->sql->rowCount() > 0) {
            $this->sql = $this->sql->fetch();
            return $this->sql;
        } else {
            return "";
        }
    }   
/*-----------------------------------------------------------------------------------------------------------*/
    public function setImg($img, $id) {
        $this->sql = "UPDATE usuarios SET img = :img WHERE id = :id";
        $this->sql = $this->db->prepare($this->sql);
        $this->sql->bindValue(':img', addslashes($img));
        $this->sql->bindValue(':id', addslashes($id));
        $this->sql->execute();
    }
}