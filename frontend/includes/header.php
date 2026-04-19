<?php require_once __DIR__ .    '/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'Parada Blog'; ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<nav class="navbar">
    <a class="navbar-brand" href="/frontend/pages/feed.php">🎵 <?= 'PARADA BLOG' ?></a>
    <div class="navbar-links">
        <?php if (isLoggedIn()): ?>
            <a href="/frontend/pages/feed.php"></a>
            <a href="/frontend/pages/profile.php"></a>
            <a href="/frontend/pages/logout.php"></a>
        <?php else: ?>
            <a href="/frontend/pages/login.php"></a>
            <a href="/frontend/pages/register.php"></a>
        <?php endif; ?>
    </div>
</nav>    
<main class="container">

