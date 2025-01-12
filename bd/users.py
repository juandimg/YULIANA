import sqlite3

def save_user(username, password):
    try:
        conn = sqlite3.connect('users.db')
        cursor = conn.cursor()
    
        cursor.execute('INSERT INTO user (username, password) VALUES (?, ?)', (username, password))
        
        conn.commit()
        print("El usuario se ha registrado correctamente")
    except sqlite3.IntegrityError:
        print("Error: El usuario ya existe por favor intente nuevamente")
        
    finally:
        conn.close()