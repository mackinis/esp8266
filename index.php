<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RCH BYTEC SRL - Remote Access Control App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        /* Encabezado */
        .header {
            text-align: center;
            background-color: #000;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            margin: 20px 0;
        }

        .header h1 {
            font-size: clamp(28px, 5vw, 36px);
            color: white;
            font-weight: bold;
            margin: 0;
        }

        .header h2 {
            font-size: clamp(18px, 3vw, 24px);
            color: white;
            font-weight: normal;
            margin-top: 0.5rem;
        }

        .header p {
            font-size: clamp(12px, 2vw, 14px);
            color: white;
            margin-top: 0.75rem;
        }

        /* Estilo para los inputs */
        .form-container {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .form-container input {
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            width: 100%; /* Los inputs deben ocupar todo el ancho */
            box-sizing: border-box;
            text-align: center; /* Centramos el texto dentro de los input */
        }

        /* Botón con tamaño ajustado al contenido */
        .form-container button {
            padding: 7px 12px; /* Reducimos el padding vertical y horizontal */
            background-color: #007bff;
            color: white;
            font-size: 14px; /* Reducimos el tamaño de fuente */
            border: none;
            border-radius: 5px; /* Reducimos un poco el radio del borde */
            cursor: pointer;
            transition: background-color 0.3s;
            width: fit-content; /* Ancho ajustado al contenido */
            margin: 10px auto 0; /* Centramos el botón */
            min-width: 80px; /* Reducimos el ancho mínimo */
            display: inline-flex; /* Para mejor alineación */
            align-items: center;
            justify-content: center;
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        }

        /* Para móviles muy pequeños */
        @media (max-width: 400px) {
            .form-container button {
                font-size: 12px;
                padding: 3px 8px;
            }
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        /* Área de respuesta */
        .message {
            margin-top: 2rem;
            font-size: 1.1rem;
            text-align: center;
            color: #333;
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
        }

        /* Responsividad */
        @media (max-width: 600px) {
            .header {
                padding: 1rem;
            }

            .form-container {
                width: 90%;
            }

            .form-container input,
            .form-container button {
                font-size: 14px;
            }
        }

        @media (max-width: 400px) {
            .header h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <h1>RCH BYTEC SRL</h1>
            <h2>Remote Access Control App</h2>
            <p>(ver. 1.25)</p>
        </div>

        <!-- Formulario para ingresar los datos -->
        <div class="form-container">
            <input type="text" id="usuario" placeholder="Usuario" required />
            <input type="password" id="contrasena" placeholder="Contraseña" required />
            <input type="text" id="deviceSerial" placeholder="Token" required />
            <input type="text" id="comando" placeholder="Comando (ej: abrir, activar, etc.)" required />
            <button onclick="enviarComando()">Enviar</button> <!-- Solo dice 'Enviar' -->
        </div>

        <!-- Área donde se muestra la respuesta -->
        <div class="message" id="responseMessage"></div>
    </div>

    <script>
        // Función para enviar el comando al servidor PHP
        function enviarComando() {
            const usuario = document.getElementById('usuario').value;
            const contrasena = document.getElementById('contrasena').value;
            const deviceSerial = document.getElementById('deviceSerial').value;
            const comando = document.getElementById('comando').value;

            // Verificar que todos los campos estén llenos
            if (!usuario || !contrasena || !deviceSerial || !comando) {
                alert('Por favor, complete todos los campos.');
                return;
            }

            // URL del servidor PHP que procesará la solicitud
            const url = `comando.php?usuario=${usuario}&contrasena=${contrasena}&deviceSerial=${deviceSerial}&comando=${comando}`;

            // Hacer la solicitud HTTP usando Fetch API
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Mostrar la respuesta del servidor
                    document.getElementById('responseMessage').textContent = data;

                    // Limpiar los campos del formulario y el mensaje después de 5 segundos
                    setTimeout(() => {
                        document.getElementById('responseMessage').textContent = '';
                        document.getElementById('usuario').value = '';
                        document.getElementById('contrasena').value = '';
                        document.getElementById('deviceSerial').value = '';
                        document.getElementById('comando').value = '';
                    }, 5000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('responseMessage').textContent = 'Hubo un error al enviar el comando.';

                    // Limpiar también en caso de error
                    setTimeout(() => {
                        document.getElementById('responseMessage').textContent = '';
                        document.getElementById('usuario').value = '';
                        document.getElementById('contrasena').value = '';
                        document.getElementById('deviceSerial').value = '';
                        document.getElementById('comando').value = '';
                    }, 5000);
                });
        }
    </script>
</body>
</html>