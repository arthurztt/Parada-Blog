<?php
require_once __DIR__ . '/../includes/header.php';

if (!isLoggedIn()) {
    echo "<script>window.location.href='/pages/login.php';</script>";
    exit;
}

$response = apiRequest('/posts');
$posts = $response['data'] ?? [];

if (!empty($posts) && isset($posts['id'])) {
    $posts = [$posts]; 
}
?>

<div class="feed-layout">
  <div class="feed-main">
    <div class="card share-card">
      <h3>Que tal compartilhar uma música?</h3>
      <p>Use o link do Spotify para compartilhar suas músicas favoritas com a comunidade!</p>
      <a href="/pages/new-post.php" class="btn btn-primary">Compartilhar Nova Música +</a>
    </div>

    <?php if (empty($posts)): ?>
      <p class="empty-state">Nenhuma música compartilhada ainda. Seja o primeiro! 🎶</p>
    <?php else: ?>
      <?php foreach ($posts as $post): ?>
        <div class="card post-card">
          <div class="post-header">
            <span class="song-info">
              <strong><?= htmlspecialchars($post['song_name'] ?? '') ?></strong>
              <?php if (!empty($post['artists'])): ?> · <?= htmlspecialchars($post['artists']) ?><?php endif; ?>
            </span>
            <?php if (!empty($post['duration_ms'])): ?>
              <span class="duration">⏱ <?= gmdate("i:s", $post['duration_ms'] / 1000) ?></span>
            <?php endif; ?>
          </div>
          <div class="post-body">
            <p><?= htmlspecialchars($post['comment'] ?? '') ?></p>
          </div>
          <div class="post-footer">
            <span><?= htmlspecialchars($post['username'] ?? '') ?></span>
            <span><?= !empty($post['created_at']) ? date('d/m/Y H:i', strtotime(str_replace('T', ' ', $post['created_at']))) : '' ?></span>
          </div>
          <div class="post-actions">
            <a href="/pages/post.php?id=<?= $post['id'] ?>">💬 <?= $post['comment_count'] ?? 0 ?> comentário(s)</a>
            <?php if (!empty($post['spotify_url'])): ?>
              <a href="<?= htmlspecialchars($post['spotify_url']) ?>" target="_blank">🔗 Abrir no Spotify</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <aside class="feed-sidebar">
    <?php $user = getCurrentUser(); ?>
    <div class="card profile-card">
      <h4>Meu Perfil</h4>
      <div class="avatar">👤</div>
      <strong><?= htmlspecialchars($user['username'] ?? '') ?></strong>
      <p><?= htmlspecialchars($user['bio'] ?? 'Sem bio ainda.') ?></p>
      <a href="/pages/profile.php">Ver Perfil Musical →</a>
    </div>
  </aside>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>