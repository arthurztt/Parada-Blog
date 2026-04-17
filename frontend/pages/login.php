<?php 
require_once __DIR__ . '/../includes/header.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = apiRequest('/users/login', 'POST', [  
        'username' => $_POST['username'],
        'password' => $_POST['password'],
    ], false);

    if($result['status'] === '200') {
        $_SESSION['token'] = $result['data']['token'];
        $_SESSION['user'] = $result['data']['user'];
        header('Location: /pages/feed.php'); exit;
    } else {
        $error = $result['data']['error'] ?? 'Erro ao fazer login';
    }
}
?>
<div class="auth-container">
    <div class="card">
    <h2>🎵 Entrar no Parada Blog</h2>
    <?php if($error): ?> <div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Senha</label>
        <input type="password" name="password" required>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p>Não tem conta? <a href="/pages/register.php">Cadastre-se!</a> </p>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php   ' ?>