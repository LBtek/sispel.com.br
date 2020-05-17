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
            $user = $u->getUser($email, $senha);
            
            if(isset($user['id']) && $user['id'] != '') {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                if(isset($user['img']) && $user['img'] != '') {
                    $_SESSION['imgPerfil'] = $user['img'];
                } 
                
                echo "<script>window.location.href='".BASE_URL."';</script>";
            } else {
                $dados['msg'] = "Acesso Negado!<br>E-mail e/ou Senha Inválidos.";
                $this->loadView('login', $dados);
            }
        } else {
            $dados['msg'] = "Acesso Negado!<br>E-mail e/ou Senha Inválidos.";
            $this->loadView('login', $dados);
        }    
    }
}