<?php

// Articles
$router->get('/api/articles', 'articles/index.php');
$router->get('/api/articles/categories', 'articles/index.php', 'getCategories');
$router->get('/api/articles/sources', 'articles/index.php', 'getSources');
$router->get('/api/articles/countries', 'articles/index.php', 'getCountries');


// Auth
$router->post('/api/auth/login', 'auth/login.php', 'login');
$router->post('/api/auth/register', 'auth/register.php', 'register');