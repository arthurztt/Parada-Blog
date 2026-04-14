const db = require('../config/db');

const UserModel = {
    findAll: () =>
        db.query('SELECT id, username, bio, created_at FROM users ORDER BY created_at DESC').then(r => r.rows),

    findById: (id) =>
        db.query('SELECT id, username, bio, created_at FROM users WHERE id = $1', [id]).then(r => r.rows[0]),

    findByUsername: (username) =>
        db.query('SELECT * FROM users WHERE username = $1', [username]).then(r => r.rows[0]),

    create: ({ username, password_hash, bio }) =>
        db.query(
            'INSERT INTO users (username, password_hash, bio) VALUES ($1, $2, $3) RETURNING id, username, bio, created_at', [username, password_hash, bio]
        ).then(r => r.rows[0]),
};

module.exports = UserModel;