const express = require('express');
const router  = express.Router();
const ctrl    = require('../controllers/userController');
const auth    = require('../middlewares/authMiddleware');

router.post('/register', ctrl.register);
router.post('/login', ctrl.login);
router.get('/:id', auth, ctrl.getProfile);

module.exports = router;