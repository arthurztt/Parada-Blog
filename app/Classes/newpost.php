<?php
class Post {
    public function __construct(
        public string $username,
        public string $musicTitle,
        public string $spotifyLink
    ) {
        $this->username = $username;
        $this->musicTitle = $musicTitle;
        $this->spotifyLink = $spotifyLink;
    }
    public function render(): string {
        return "
        <div class=\"post\">
            <h2>Usuário: {$this->username}</h2>
            <p>Música: \"{$this->musicTitle}\"</p>
            <a href=\"{$this->spotifyLink}\" class=\"spotify-link\">Ouvir no Spotify</a>
        </div>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie um Post</title>
    <link rel="stylesheet" href="/css/newpost.css">
</head>
<body>
    <form action="newpost.php" method="get">
        <div class="post-box">
        <h2 class="form-title">Crie um novo Post!</h2>
        <div class="basic-info">
            <label class="username" for="username">Usuário</label>
            <input type="text" id="username" name="username" class="form-input" required>

            <label class="musicTitle" for="musicTitle">Título da Música </label>
            <input type="text" id="musicTitle" name="musicTitle" class="form-input" required>
        </div>
        <div class="comment">
            <textarea name="comment" id="comment" cols="80" rows="4" placeholder="Deixe seu comentário aqui..."></textarea>
        </div>
        <label class="spotifyLink" for="spotifyLink">Link da Música</label>
        <input type="url" id="spotifyLink" name="spotifyLink" class="form-input" required>

        <input class="submit-button" type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>