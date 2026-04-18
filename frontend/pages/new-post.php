<?php
require_once __DIR__ . '/../includes/header.php';
if(!isLoggedIn()) { header('Location: /pages/login.php'); exit;}
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = apiRequest('/posts', 'POST', [
        'spotify_url' => $_POST['spotify_url'],
        'song_name' => $_POST['song_name'],
        'artists' => $_POST['artists'],
        'duration_ms' => (int) $_POST['duration_ms'],
        'comment' => $_POST['comment'],
        
    ]);

    if ($result['status'] === 201){
        header('Location: /pages/feed.php'); exit;
    } else {
        $error = $result['data']['error'] ?? 'Erro ao criar o post';
    }
}
?>
<div class="auth-container">
    <div class="card">
        <h2>🎵 Compartilhar Música</h2>
        <?php if ($error): ?> <div class="alert alert-error"><?= htmlspecialchars($error) ?></div> <?php endif; ?>
        <form method="POST">
            <label>Link do Spotify</label>
            <input type="url" name="spotify_url" placeholder="https://open.spotify.com/track/..." required>
            <label>Nome da Música</label>
            <input type="text" name="song_name" required >
            <label>Artista(s)</label>
            <input type="text" name="artists" placeholder="Ex: Lô Borges, Milton Nascimento">
            <label>Duração em ms <small>Opcional</small></label>
            <input type="number" name="duration_ms" placeholder="228000" >
            <label>Comentário</label>
            <textarea name="comment" rows="3" required placeholder="O que você acha dessa música?"></textarea>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php' ?>