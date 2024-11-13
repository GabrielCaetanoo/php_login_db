<?php

// VERIFICA SE TEVE UM POST
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: /index.php?rota=login');
    exit;
}

// BUSCAR DADOS DO POST

$usuario = $_POST['text_usuaruio'] ?? null;
$senha = $_POST['text_senha'] ?? null;

// VALIDAÇÃO DOS DADOS
if(empty($usuario) || empty($senha)){
    header('Location: index.php?rota=login');
    exit;
}

// BUSCA DADOS DO USUARIO NO BANCO DE DADOS
$db = new database();
$params = [
    ':usuario' => $usuario
];
$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
$result =$db->query($sql, $params);

// VERIFICA SE ACONTECEU UM ERROR
if($result['status'] === 'error'){
    header('Location: index.php?rota=404');
    exit;
}

// VERIFICA SE O USUARIO EXISTE
if(count($result['data']) === 0){

    //ERRO NA SESSAO
    $_SESSION['error'] = 'Usuário ou senha inválidos!';

    header('Location: index.php?rota=login');
    exit;
}

// VERIFICA SE O SENHA EXISTE
if(!password_verify($senha, $result['data'][0] -> senha)){

    //ERRO NA SESSAO
    $_SESSION['error'] = 'Usuário ou senha inválidos!';
    
    header('Location: index.php?rota=login');
    exit;
}

// CRIA A SESSAO
$_SESSION['usuario'] = $result['data'][0];

// REDIRECIONA PARA A PAGINA HOME
header('Location: index.php?rota=home');