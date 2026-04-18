<?php
require_once __DIR__ . '/../includes/header.php';
if(!isLoggedIn()) { header('Location: /pages/login.php'); exit; }

$id = (int)($_GET['id'] ?? 0);
if(!$id) { header('Location: /pages/feed.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    apiRequest('/comments/posts', 'POST', ['body' => $_POST['body']]);
    header('Location: /pages/post.php?id=' . $id); exit;
}

$post = apiRequest('/posts/' . $id)['data'] ?? null;
$comments = apiRequest('/comments/posts/' . $id)['data'] ?? [];
?>

<?php if(!$post): ?>
    <p class="empty-state">Post não encontrado.</p>
<?php else: ?>

<div class="card post-card">
    <div class="post-header">
        <span class="song-info">
            <strong><?= htmlspecialchars($post['song_name']) ?></strong>
            <?php if (!empty($post['artists'])): ?> . <?= htmlspecialchars($post['artists']) ?><?php endif; ?>
        </span>
    </div>
    <div class="post-body"><p><?= htmlspecialchars($post['comment']) ?></p></div>
    <div class="post-footer">
        <span><?= htmlspecialchars($post['username']) ?></span>
        <span><?= date('d\m\Y H:i', strtotime($post['created_at'])) ?></span>
    </div>
</div>

<h3 style="margin:20px 0 10px">Comentários <?= count($comments) ?></h3>

<?php foreach ($comments as $c): ?>
<div class="card comment-card">
    <p><?= htmlspecialchars($c['body']) ?></p>
    <small><strong><?= htmlspecialchars($c['username']) ?></strong> · <?= date('d\m\Y H:i', strtotime($c['created_at'])) ?> </small>
</div>
<?php endforeach; ?>

<div class="card">
    <form method="POST">
        <label>Deixar um comentário</label>
        <textarea name="body" rows="2" required placeholder="O que achou disso?"></textarea>
        <button type="submit" class="btn btn-primary" style="margin-top:10px">Comentar</button>
    </form>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>