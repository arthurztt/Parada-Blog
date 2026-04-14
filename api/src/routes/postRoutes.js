const express = require('express');
const router  = express.Router();
const ctrl    = require('../controllers/postController');
const auth    = require('../middlewares/authMiddleware');

router.get('/', auth, ctrl.index);
router.get('/me', auth, ctrl.myPosts);
router.get('/:id', auth, ctrl.show);
router.post('/', auth, ctrl.create);
router.delete('/:id', auth, ctrl.destroy);

module.exports = router;