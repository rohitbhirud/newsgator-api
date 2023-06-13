<?php

$router->get('/api/articles', 'articles/index.php');

$router->post('/api/auth/login', 'auth/login.php', 'login');

$router->post('/api/auth/register', 'auth/register.php', 'register');