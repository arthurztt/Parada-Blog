<?php
require_once __DIR__ . '/../includes/header.php';
if (!isLoggedIn()) {
    echo "<script>window.location.href='/pages/login.php';</script>";
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    echo "<script>window.location.href='/pages/feed.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    apiRequest('/comments/post/' . $id, 'POST', ['body' => $_POST['body']]);
    echo "<script>window.location.href='/pages/post.php?id=" . $id . "';</script>";
    exit;
}

$postResponse = apiRequest('/posts/' . $id);
$post         = $postResponse['data'] ?? null;

$commentsResponse = apiRequest('/comments/post/' . $id);
$comments         = $commentsResponse['data'] ?? [];

// Se comentários vier como objeto único, transforma em array
if (!empty($comments) && isset($comments['id'])) {
    $comments = [$comments];
}
?>

<?php if (!$post): ?>
  <p class="empty-state">Post não encontrado.</p>
<?php else: ?>
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
    <?php if (!empty($post['spotify_url'])): ?>
      <div class="post-actions">
        <a href="<?= htmlspecialchars($post['spotify_url']) ?>" target="_blank">🔗 Abrir no Spotify</a>
      </div>
    <?php endif; ?>
  </div>

  <h3 style="margin: 20px 0 10px">Comentários <?= count($comments) ?></h3>

  <?php if (empty($comments)): ?>
    <p class="empty-state" style="padding: 20px 0">Nenhum comentário ainda. Seja o primeiro!</p>
  <?php else: ?>
    <?php foreach ($comments as $c): ?>
      <div class="card comment-card">
        <p><?= htmlspecialchars($c['body'] ?? '') ?></p>
        <small>
          <strong><?= htmlspecialchars($c['username'] ?? '') ?></strong>
          <?php if (!empty($c['created_at'])): ?>
            · <?= date('d/m/Y H:i', strtotime(str_replace('T', ' ', $c['created_at']))) ?>
          <?php endif; ?>
        </small>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <div class="card" style="margin-top: 16px">
    <form method="POST">
      <label>Deixar um comentário</label>
      <textarea name="body" rows="2" required placeholder="O que você achou?"></textarea>
      <button type="submit" class="btn btn-primary" style="margin-top: 10px">Comentar</button>
    </form>
  </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>