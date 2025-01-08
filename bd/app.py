from flask import Flask, render_template, request, redirect,url_for, flash
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.secret_key = "Secret_key"
app.config['SQLALMECHY_DATABASE_URI']= 'sqlite://users.db'
app.config['SQLALMECHY_TRACK_MODIFICATIONS']= False
db = SQLAlchemy(app)

class user(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable= False)
    password = db.Column(db.String(80), nullable=False)
    
    
    @app.route('/', methods=['GET', 'POST'])
    def login():
        if request.method == 'POST':
            username = request.form['username']
            password = request.form['password']
            
            user = user.query.filter_by(username=username, password=password).first()
            if user:
                return redirect(url_for('../plataforma/inicio.html'))
            else:
                flash("Su usuario o contraseña son incorrectos, ingresa niuevamente...")
        
        return render_template('inicio.html')
    
    @app.route('../plataforma/inicio.html')
    def dashboard():
        return ' Bienvenid@ a tus cursos '
    
    
    
    
    
    