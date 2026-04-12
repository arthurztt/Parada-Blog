const db = require('../config/db');

const commentModel = {
    findByPost: (post_id) => 
        db.query(
            `SELECT c.*, u.username FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.post_id = $1
            ORDER BY c.created_at ASC`, 
[post_id]).then(r => r.rows),
            
        create: ({ post_id, user_id, body}) =>
        
}