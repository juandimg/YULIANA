import sqlite3

conn = sqlite3.connect('users.db')
cursor = conn.cursor()

cursor.execute('''
CREATE TABLE user(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL unique,
    password TEXT NOT NULL              
               
            )
            ''')
