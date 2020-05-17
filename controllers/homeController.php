<?php
class homeController extends controller {

    public function index() {
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '') {
            $this->loadView('login');
        } else {
            require 'config.php'; 

            if(isset($_FILES['photo'])) {
                $img = $_FILES['photo'];
                if(isset($_SESSION['imgPerfil']) && $_SESSION['imgPerfil'] != "") {
                    unlink('assets/images/'.$_SESSION['imgPerfil']);  
                }
                $tmpname = time().".jpg";
                move_uploaded_file($img['tmp_name'], 'assets/images/'.$tmpname);
                $u = new Users();
                $u->setImg($tmpname, $_SESSION['id']);
                $_SESSION['imgPerfil'] = $tmpname;
            }

            $this->loadTemplate('home');
        }
    }

    public function register($ptreg) {  
        require 'config.php';

        if($ptreg != '' && $_SESSION['id'] != '') {    
            $data = date("Y-m-d", strtotime($ptreg));
            $hora = date("H:i:s", strtotime($ptreg));
            $p = new Ponto();
    
            $sql = $p->getPonto($_SESSION['id'], $data);
    
            if($sql->rowCount() > 0) {
                $ponto = $sql->fetch();

                if($ponto['hrs_saida_mat'] == "") {
                    $periodo_ponto = 'hrs_saida_mat';
                } 
                else if($ponto['hrs_entrada_vesp'] == "") {
                    $periodo_ponto = 'hrs_entrada_vesp';
                } 
                else if($ponto['hrs_saida_vesp'] == "") {
                    $periodo_ponto = 'hrs_saida_vesp';
                } else {
                    echo "<script> alert('Não há mais ponto a registrar por hoje.'); </script>";
                    echo "<script> window.location.href = '".BASE_URL."' </script>";
                    exit;
                }
                
                $p->setPonto($hora, $periodo_ponto, "", $ponto['id']);

                $sql = $p->getPonto($_SESSION['id'], $data);
                $ponto = $sql->fetch();

                $th = $ponto['thrs'];

                if($ponto['hrs_saida_vesp'] != "") {
                    $th += strtotime($ponto['hrs_saida_vesp']) - strtotime($ponto['hrs_entrada_vesp']);
                    $p->setPonto("", "", "", $ponto['id'], "", $th);
                } 
                else if($ponto['hrs_saida_mat'] != "" && $ponto['hrs_entrada_vesp'] == "") {
                    $th = strtotime($ponto['hrs_saida_mat']) - strtotime($ponto['hrs_entrada_mat']);
                    $p->setPonto("", "", "", $ponto['id'], "", $th);
                }

            } else {
                $p->setPonto($hora, "", $data, "", $_SESSION['id']);
            }
        } 
        else {
            echo "<script> alert('Erro ao registrar!'); </script>";
        }
        echo "<script> window.location.href = '".BASE_URL."' </script>";
    }
}
