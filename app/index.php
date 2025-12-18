<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
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
            <h1>As <i>paradas&#9835;</i> que os outros estão Compartilhando !</h1>
            <hr>
            </div>
            <div class="posts">
                <!-- Exemplo de Post -->
                <div class="post createpost">
                    <h2>Que tal compartilhar uma música?</h2>
                    <p>Use o link do Spotify para compartilhar suas músicas favoritas com a comunidade!</p>
                    <form action="/app/newpost.php" method="get">
                    <button class="newpost">
                            <input type="submit" value="Compartilhar Nova Música"> 
                            <span>+</span>
                    </button>
                    </form>
                </div>
                <div class="post">
                    <h2>Usuário: jazzfanatic</h2>
                    <p>Música: "So What" - Miles Davis</p>
                    <a href="https://open.spotify.com/track/5nTtCOCds6I0PHMNtqelas?si=example" class="spotify-link">Ouvir no Spotify</a>
                </div>
                <!-- Fim do Exemplo de Post -->                
            </div>
        </section>
        <section class="profilesidebar">
            <div class="profile">
                <hr>
                <h2>Meu Perfil</h2>
                <img src="/img/Marilyn-Monroe.webp"profileimg" alt="Imagem de Perfil">
                <p class="username">arthurztt</p>
                <p class="profile-description">Perfil para compartilhar músicas que escuto no momento !</p>
                <p class="posts">0 Posts</p>
            </div>
            <div class="external-links">
                <a href="https://open.spotify.com/user/31z6kcwwmaeloimnht6uf67phqsm?si=57dfc6b5e579478b" class="external-app-account"><img class="external-link-img" src="/img/box-arrow-up-right.svg">Perfil Musical</a>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2024 Parada Blog &#9835; - Todos os direitos reservados.</p>
    </footer>
</body>
</html>