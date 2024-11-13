<?php

// destroy session
session_destroy();

// redireciona para a home
header('Location: index.php?rota=home');