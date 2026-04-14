const db = require('../config/db');

const CommentModel = {
    findByPost: (post_id) => 
        db.query(
            `SELECT c.*, u.username FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.post_id = $1
            ORDER BY c.created_at ASC`, 
[post_id]).then(r => r.rows),
            
        create: ({ post_id, user_id, body}) =>
            db.query('INSERT INTO comments (post_id, user_id, body) VALUES ($1, $2, $3) RETURNING *',
                [post_id, user_id, body]
            ).then(r => r.rows[0]),

        delete: (id, user_id) => 
            db.query('DELETE FROM comments WHERE id = $1 AND user_id = $2 RETURNING id', [id, user_id]).then(r => r.rows[0])
};

module.exports = CommentModel;