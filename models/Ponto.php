<?php
class Ponto extends model {
    private $sql;
    private $state;

/*-----------------------------------------------------------------------------------------------------------*/
    public function getPonto($idUser, $date = "") {
        $this->state = false;
        $this->sql = "SELECT * FROM ponto WHERE id_usuario = :id";

        if($date != "") {
            $this->sql = $this->sql." AND date = :data";
            $this->sql = $this->db->prepare($this->sql);
            $this->sql->bindValue(':data', addslashes($date));
            $this->state = true;
        } else {
            $this->sql = $this->db->prepare($this->sql);
            $this->state = true;
        }

        if ($this->state) {
            $this->sql->bindValue(':id', addslashes($idUser));
            $this->sql->execute();
            return $this->sql;
        }
    }
/*-----------------------------------------------------------------------------------------------------------*/
    public function setPonto($hours, $periodo = "", $date = "", $idPonto = "", $idUser = "") {
        $this->state = false;
        
        if ($idUser != "" && $date != "" && $hours != "") {
            $this->sql = "INSERT INTO ponto (date, hrs_entrada_mat, id_usuario) VALUES (:data,:ponto,:usuario)";
            $this->sql = $this->db->prepare($this->sql);
            $this->sql->bindValue(':data', addslashes($date));
            $this->sql->bindValue(':usuario', addslashes($idUser));
            $this->state = true;

        } elseif ($idPonto != "" && $periodo != "" && $hours != "") {
            $this->sql = "UPDATE ponto SET ".addslashes($periodo)." = :ponto WHERE id = :idPonto";
            $this->sql = $this->db->prepare($this->sql);
            $this->sql->bindValue(':idPonto', addslashes($idPonto));
            $this->state = true;
        }

        if($this->state) {
            $this->sql->bindValue(':ponto', addslashes($hours));
            $this->sql->execute();
        }
    }
}