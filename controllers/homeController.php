<?php
class homeController extends controller {

    public function index() {
        if(!isset($_SESSION['id']) || $_SESSION['id'] == '') {
            $this->loadView('login');
        } else {
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
                if ($ponto['hrs_saida_mat'] == "") {
                    $periodo_ponto = 'hrs_saida_mat';
    
                } elseif($ponto['hrs_entrada_vesp'] == "") {
                    $periodo_ponto = 'hrs_entrada_vesp';
    
                } elseif ($ponto['hrs_saida_vesp'] == "") {
                    $periodo_ponto = 'hrs_saida_vesp';
                } else {
                    echo "<script> alert('Não há mais ponto a registrar por hoje.'); </script>";
                    echo "<script> window.location.href = '".BASE_URL."' </script>";
                    exit;
                }
                $p->setPonto($hora, $periodo_ponto, "", $ponto['id']);
                
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
