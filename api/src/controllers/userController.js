const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const User = require('../models/userModel');
const { use } = require('react');

const UserController = {
    async register(req, res){
        try {
            const { username, password, bio } = req.body;
            if(!username || !password || !bio) return res.status(400).json({ error: 'Inserir o username, a senha e a bio é obrigatório.' });
            if(await User.findByUsername(username)) return res.status(409).json({ error: 'Username já em uso.'});
            const password_hash = await bcrypt.hash(password, 10);
            const user = await User.create({ username, password_hash, bio });
            return res.status(201).json(user);
        } catch (err) {
            console.log(err);
            return res.status(500).json({ error: 'Erro ao criar o usuário'});
        }
    },

    async login(req, res) {
        try {
            const { username, password } = req.body;
            const user = await User.findByUsername(username);
            if(!user || !(await bcrypt.compare(password, user.password_hash)))
                return res.status(401).json({error: 'Credenciais inválidas'});
            const token = jwt.sign({id: user.id}, process.env.JWT_SECRET, {expiresIn: '7d'});
            return res.json( {token, user: {id: user.id, username: user.username, bio: user.bio} });
        } catch (err) {
            return res.status(500).json({ error: 'Erro ao fazer login.'} );
        }
    },

    async getProfile(req, res){
        try{
            const user = await User.findById(req.params.id);
            if(!user) return res.status(404).json({ error: 'Usuário não encontrado' });
            return res.json(user); 
        } catch {
            return res.status(500).json({ error: 'Erro ao buscar perfil' });
        }
    },
};

module.exports = UserController;