<?php

//INICIO DA SESION
session_start();

//CARREGAMENTO ROTAS PERMITIDAS
$rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

//DEFININDO AS ROTAS
$rota = $_GET['rota'] ?? 'home';

//VERIFICANDO SE USUARIO ESTÁ LOGADO
if (!isset($_SESSION['usuario']) && $rota !=='login_submit'){
    $rota = "login";
}

//SE USUARIO ESTÁ LOGADO E TENTA ENTRAR NO LOGIN
if (isset($_SESSION['usuario']) && $rota === 'login'){
    $rota = 'home';
}

//SE A ROTA NÃO EXISTE
if (!in_array($rota, $rotas_permitidas)){
    $rota = '404';
}

//preparação da pagina
$script = null;
switch($rota){
    case '404':
        $script = '404.php';
        break;
    case 'login':
        $script = 'login.php';
        break;

    case 'logout':
        $script = 'logout.php';
        break;
    case 'login_submit':
        $script = 'login_submit.php';
        break;
    case 'home':
        $script = 'home.php';
        break;
    case 'page1':
        $script = 'page1.php';
        break;
    case 'page2':
        $script = 'page2.php';
        break;
    case 'page3':
        $script = 'page3.php';
        break;
    
}

//CARREGAMENTO DO SCRIPT DA PAGINA
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/database.php";

//TEST
// $db = new database();
// $usuarios = $db->query('SELECT * FROM usuarios');
// echo '<pre>';
// print_r($usuarios);
// echo '</pre>';
// die();

//APRESENTAÇÃO DA PAGINA
require_once __DIR__ . "/../inc/header.php";
require_once __DIR__ . "/../scripts/$script";
require_once __DIR__ . "/../inc/footer.php";