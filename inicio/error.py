from flask import Flask, flash, render_template, redirect, url_for

app = Flask(__name__)
app.secret_key = 'secret_key'  # Necesario para manejar sesiones y mensajes flash

@app.route('/')
def home():
    flash("Este es un mensaje de error.")  # Envía un mensaje flash
    return render_template('../inicio/inicio.html')  # Renderiza la plantilla HTML