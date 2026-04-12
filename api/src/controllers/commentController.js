const Comment = require('../models/commentModel');

const CommentController = {
    async index(req, res){
        try { return res.json(await Comment.findByPost(req.params.postId)); }
        catch { return res.status(500).json({ error : 'Erro ao buscar comentários' }); }
    },

    async create(req, res) {
        try {
            const { body } = req.body;
            if (!body) return res.status(400).json({ error: 'O corpo do comentário é obrigatório.' });
            const comment = await Comment.create({ post_id: req.params.postId, user_id: req.userId, body }); 
            return res.status(201).json(comment);
        } catch {
            return res.status(500).json({ error: 'Erro ao criar o comentário.' });
        }
    },

    async delete(req, res) {
        try {
            const deleted = await Comment.delete(req.params.id, req.user_Id);
            if(!deleted) return res.status(403).json({ error: 'Comentário não encontrado ou sem permissão.' });
            return res.json({ message: 'Comentário removido com sucesso!' });
        } catch {
            return res.status(500).json({ error: 'Erro ao remover o comentário.' });
        }
    },
};

module.exports = CommentController;