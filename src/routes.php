<?php

// Articles
$router->get('/api/articles', 'articles/index.php');
$router->get('/api/articles/categories', 'articles/index.php', 'getCategories');
$router->get('/api/articles/sources', 'articles/index.php', 'getSources');
$router->get('/api/articles/countries', 'articles/index.php', 'getCountries');

// Auth
$router->post('/api/auth/login', 'auth/login.php', 'login')->only('guest');
$router->post('/api/auth/register', 'auth/register.php', 'register')->only('guest');

// Get loggedIn user preferences
$router->get('/api/user/preferences', 'user/preferences.php', 'preferences')->only('auth');

// Store loggedIn user preferences
$router->post('/api/user/preferences', 'user/preferences.php', 'savePreferences')->only('auth');