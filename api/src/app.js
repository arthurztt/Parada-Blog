const express = require('express');
const cors = require('cors');

const userRoutes = require('./routes/userRoutes');
const postRoutes = require('./routes/postRoutes');
const commentRoutes  = require('./routes/commentRoutes');

const app = express();

app.use(cors());
app.use(express.json());

app.use('api/users', userRoutes);
app.use('api/posts', postRoutes);
app.use('api/comments', commentRoutes);

app.use('api/health', (req, res) => {
    res.json({ status: 'OK', message: '🎵 Parada Blog API funcionando!'});
});

module.exports = app;

