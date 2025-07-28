const express = require('express');
const session = require('express-session');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.static('public'));

app.use(session({
    secret: 'your-secret-key',
    resave: false,
    saveUninitialized: true,
    cookie: { maxAge: 1* 60 *1000 } // Set to true if using HTTPS

}));

function protegeRuta(req, res, next) {
    if (req.session.user) {
        next();
    } else {
        res.redirect('./plataforma/inicio.html'); // Redirige a la página de inicio de sesión
    }
}

app.get('/plataforma/inicio.html', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'plataforma', 'inicio.html'));
});


