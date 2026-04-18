const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/commentController');
const auth = require('../middlewares/authMiddleware');

router.get('/post/:postId', auth, ctrl.index);
router.post('/post/:postId', auth, ctrl.create);
router.delete('/:id', auth, ctrl.delete);

module.exports = router;