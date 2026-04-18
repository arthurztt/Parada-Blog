<?php
require_once __DIR__ . '/../includes/header.php';
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = apiRequest('/users/register', 'POST', [   
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'bio' => $_POST['bio'],
    ], false);

    if($result['status'] === 201){
        header('Location: /pages/login.php'); exit;
    } else {
        $error = $result['data']['error'] ?? 'Erro ao cadastrar';
    }
}
?>

<div class="auth-container">
    <div class="card">
        <h2>🎵 Criar conta no Parada Blog</h2>
        <?php if($error): ?> <div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required maxlength="50">
            <label>Senha</label>
            <input type="password" name="password" required>
            <label>Bio (Opcional)</label>
            <textarea name="bio" rows="2" placeholder="Conte um pouco sobre você..."></textarea>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
        <p>Já tem conta? <a href="/pages/login.php">Entrar</a></p>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>