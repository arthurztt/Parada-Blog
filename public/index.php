<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Feed Principal</title>
</head>
<body>
    <header>
        <nav>
            <a href="/app/configs.html">Configurações</a>
        </nav>
    </header>
    <main>
        <section class="mainfeed">
            <div class="title">
            <h1>As <span class="italic">paradas&#9835;</span> que os outros estão Compartilhando !</h1>
            </div>
            <div class="posts">
                <div class="post createpost">
                    <h2>Que tal compartilhar uma música?</h2>
                    <p>Use o link do Spotify para compartilhar suas músicas favoritas com a comunidade!</p>
                    <form action="/src/newpost.php" method="get">
                    <button class="newpost">
                            <input type="submit" value="Compartilhar Nova Música"> 
                            <span>+</span>
                    </button>
                    </form>
                </div>
                <div class="post">
                    <div class="musicinfo">
                        <h3 class="music-title">Trem de Doido</h3>
                        <p>▸</p>
                        <h3 class="artist">Lô Borges, Milton Nascimento</h3>
                        <img src="/public/img/icons/stopwatch.svg" class="item-aside">
                        <p class="music-duration extra-info"> 3min 48s</p>
                    </div>
                    <div class="infobox">
                        <p class="description">Boa música, solo de guitarra insano.</p>
                    </div>
                    <div class="user-info">
                        <p class="post-creator">arthurztt</p>
                        <?php 
                            $now = new DateTime('America/Fortaleza');
                            echo $now->format('d/m/Y H:i');
                        ?>
                    </div>
            </div>
        </section>
        <section class="profilesidebar">
            <div class="profile">
                <hr>
                <h2>Meu Perfil</h2>
                <img src="/public/img/person-circle.svg" class="profileimg" alt="Imagem de Perfil">
                <p class="username">arthurztt</p>
                <p class="profile-description">Perfil para compartilhar músicas que escuto no momento !</p>
                <p class="posts">0 Posts</p>
            </div>
            <div class="external-links">
                <a href="https://open.spotify.com/user/31z6kcwwmaeloimnht6uf67phqsm?si=57dfc6b5e579478b" class="external-app-account"><img class="external-link-img" src="/public/img/icons/box-arrow-up-right.svg">Perfil Musical</a>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2024 Parada Blog &#9835; - Todos os direitos reservados.</p>
    </footer>
</body>
</html>