<?php
class logofController {
    public function index() {
        $_SESSION['id'] = '';
        unset($_SESSION['id']);
        echo "<script> window.location.href = '".BASE_URL."' </script>";
    }
}