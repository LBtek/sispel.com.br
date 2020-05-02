<?php
$config['dbname'] = 'u581887291_sispelt';
$config['host'] = '81.16.29.5';
$config['dbuser'] = 'u581887291_luanrafael';
$config['dbpass'] = '3579105LMG';

global $db;
try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}
