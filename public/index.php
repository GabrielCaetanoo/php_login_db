<?php 

//INICIO DA SESION
session_start();

//CARREGAMENTO ROTAS PERMITIDAS
$rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

//DEFININDO AS ROTAS
$rota = $_GET['rota'] ?? 'home';

//VERIFICANDO SE USUARIO ESTÁ LOGADO
if(!isset($_SESSION['usuario'])){
    $rota = "login";
}

//SE USUARIO ESTÁ LOGADO E TENTA ENTRAR NO LOGIN
if(isset($_SESSION['usuario']) && $rota === 'login'){
    $rota = 'home';
}

//SE A ROTA NÃO EXISTE
if(!in_array($rota, $rotas_permitidas)){
    $rota = '404';
}

//preparação da pagina
$scrit = null;
switch($rota){
    case '404':
        $scrit = '404.php';
        break;
    case 'login':
        $scrit = 'login.php';
        break;
    case 'home':
        $scrit = 'home.php';
        break;
}

//APRESENTAÇÃO DA PAGINA
require_once __DIR__ . "/../inc/header.php";
require_once __DIR__ . "/../scripts/$script";
require_once __DIR__ . "/../inc/footer.php";