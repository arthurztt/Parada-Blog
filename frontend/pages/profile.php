<?php
require_once __DIR__ . '/../includes/header.php';
if(!isLoggedIn()) { header('Location: /pages/login.php'); exit; }

$user = getCurrentUser();
$posts = apiRequest('/posts/me')['data'] ?? [];   
?>

<div class="feed-layout">
    <div class="feed-main">
        <h2 style="margin-bottom:16px">Minhas Músicas Compartilhadas</h2>
        <?php if(empty($posts)): ?>
            <p class="empty-state">Você ainda não compartilhou nenhuma música. <a href="/pages/new-post.php">Compartilhe agora!</a></p>
        <?php else: ?>
            <?php foreach($posts as $post): ?>
                <div class="card post-card">
                    <div class="post-header">
                        <strong><?= htmlspecialchars($post['song_name']) ?></strong>
                        <?php if(!empty($post['artists'])) : ?> · <?= htmlspecialchars($post['artists']) ?><?php endif; ?>
                    </div>
                    <div class="post-body"><p><?= htmlspecialchars($post['comment']) ?></p></div>
                    <div class="post-footer">
                        <span><?= date('d\m\Y H:i', strtotime($post['created_at'])) ?></span>
                        <span>💬 <?= $post['comment_count'] ?? 0 ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <aside class="feed-sidebar">
        <div class="card profile-card">
            <div class="avatar">👤</div>
            <strong><?= htmlspecialchars($user['username']) ?></strong>
            <p><?= htmlspecialchars($user['bio'] ?? 'Sem bio.') ?></p>
            <p><strong><?= count($posts) ?></strong> Posts</p>
        </div>
    </aside>
</div>

<?php require_once __DIR__ . '/../includes/footer.php' ?>