from flask import Flask, request, render_template, flash, redirect, url_for
import sqlite3

app = Flask(__name__)
app.secret_key = "secret_key"

def save_user(username, password):
    try:
        conn = sqlite3.connect('users.db')
        cursor = conn.cursor()
        cursor.execute('INSERT INTO users (username, password) VALUES (?, ?)', (username, password))
        conn.commit()
    except sqlite3.IntegrityError:
        return False
    finally:
        conn.close()
    return True

@app.route('//basedatos/registro.html', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        if save_user(username, password):
            flash("Usuario registrado con éxito")
            return redirect(url_for('login'))
        else:
            flash("El nombre de usuario ya existe")

    return render_template('//basedatos/registro.html')

@app.route('/')
def login():
    return "<h1>Página de inicio</h1>"

if __name__ == '__main__':
    app.run(debug=True)

        
        
        
        

 
    
    
    
    
    
    