const db = require('../config/db');

const PostModel = {
    findAll: () =>
        db.query(`
            SELECT p.*, u.username, COUNT(c.id) AS comment_count
            FROM posts p
            JOIN users u ON p.user_id = u.id
            LEFT JOIN comments c ON c.post_id = p.id
            GROUP BY p.id, u.username
            ORDER BY p.created_at DESC
            `).then(r => r.rows[0]),

    findById: (id) =>
        db.query(`
            SELECT p.*, u.username FROM posts p
            JOIN users u ON p.user_id = u.id
            WHERE p.id = $1
            `, [id]).then(r = r.rows[0]),

    findByUser: (user_id) =>
        db.query(`
            SELECT p.*, COUNT(c.id) AS comment_count
            FROM posts p
            LEFT JOIN cooments c ON c.post_id = p.id`)

}