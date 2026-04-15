const Post = require('../models/postModel');

const PostController = {
    async index(req, res) {
        try{ return res.json(await Post.findAll()); }
        catch { return res.status(500).json({ error: 'Erro ao buscar por posts' }); }
    },

    async show(req, res) {
        try {
            const post = await Post.findById(req.params.id);
            if (!post) return res.status(404).json({ error: 'Post não encontrado' });
            return res.json(post);
        } catch {
            return res.status(500).json({ error: 'Erro ao encontrar o post '});
        }
    },

    async myPosts(req, res) {
        try { return res.json(await Post.finByUser(req.params.userId)); }
        catch { return res.status(500).json({ error: 'Erro ao buscar seus posts' }); }
    },

    async create(req, res) {
        try {
            const { spotify_url, song_name, artists, duration_ms, comment } = req.body;
            if(!spotify_url || !song_name || !comment)
                return res.status(400).json({ error: 'O Link do Spotify, o Nome da Música e o seu comentário são obrigatórios.' });
            const post = await Post.create({ user_id: req.userId, spotify_url, song_name, artists, duration_ms, comment });
            return res.status(201).json(post);
        } catch { 
            return res.status(500).json({ error: 'Erro ao criar o post' });
        }
    },

    async destroy(req, res){
        try {
            const deleted = await Post.delete(req.params.id, req.userId);
            if(!deleted) return res.status(403).json({ error: 'Post não encontrado ou sem permissão' });
            return res.json({ message: 'Post removido!'});
        } catch {
            return res.status(500).json({ error: 'Erro ao remover o post' });
        }
    },
};

module.exports = PostController;