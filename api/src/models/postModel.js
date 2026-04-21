const db = require('../config/db');

const PostModel = {
  findAll: () =>
    db.query(`
      SELECT p.*, u.username, COUNT(c.id)::int AS comment_count
      FROM posts p
      JOIN users u ON p.user_id = u.id
      LEFT JOIN comments c ON c.post_id = p.id
      GROUP BY p.id, u.username
      ORDER BY p.created_at DESC
    `).then(r => r.rows),

  findById: (id) =>
    db.query(`
      SELECT p.*, u.username
      FROM posts p
      JOIN users u ON p.user_id = u.id
      WHERE p.id = $1
    `, [id]).then(r => r.rows[0]),

  findByUser: (user_id) =>
    db.query(`
      SELECT p.*, COUNT(c.id)::int AS comment_count
      FROM posts p
      LEFT JOIN comments c ON c.post_id = p.id
      WHERE p.user_id = $1
      GROUP BY p.id
      ORDER BY p.created_at DESC
    `, [user_id]).then(r => r.rows),

  create: ({ user_id, spotify_url, song_name, artists, duration_ms, comment }) =>
    db.query(`
      INSERT INTO posts (user_id, spotify_url, song_name, artists, duration_ms, comment)
      VALUES ($1, $2, $3, $4, $5, $6) RETURNING *
    `, [user_id, spotify_url, song_name, artists, duration_ms, comment]).then(r => r.rows[0]),

  delete: (id, user_id) =>
    db.query(
      'DELETE FROM posts WHERE id = $1 AND user_id = $2 RETURNING id',
      [id, user_id]
    ).then(r => r.rows[0]),
};

module.exports = PostModel;