<?php
class loginController extends controller {
    
    public function index() {
        if(isset($_SESSION['id']) && $_SESSION['id'] != '') {
            $this->loadTemplate('home');
        } else {
            $this->loadView('login');
        }
    }

    public function logar() {
        require 'config.php';
        
        if(isset($_POST['email']) && trim($_POST['email']) != "" && isset($_POST['senha']) && trim($_POST['senha']) != "") {
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            $u = new Users();
            $id = $u->getUserId($email, $senha);
            
            if($id != '' && is_numeric($id)) {
                $_SESSION['id'] = $id;
                echo "<script>window.location.href='".BASE_URL."';</script>";
            } else {
                $dados['msg'] = "Acesso Negado!<br>E-mail e/ou Senha Inválidos.";
                $this->loadView('login', $dados);
            }
        } else {
            echo "<script>window.location.href='".BASE_URL."';</script>";
        }    
    }
}