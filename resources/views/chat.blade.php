<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoHuerto</title>
    <link rel="icon" href="images/logoEcoHuerto.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset de estilos básicos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            background-image: url('./images/5-consejos-para-hacer-un-huerto-en-la-terraza-de-casa.jpg'),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            background-size: cover; /* Asegura que la imagen cubra todo el fondo */
            background-position: center; /* Centra la imagen */
            /* Configura el orden de superposición de los fondos */
            background-blend-mode: overlay;
            color: #fff;
        }

        .navbar {
            background-color: rgba(43, 205, 73, 0.9);
            color: #fff;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-container .imagen {
            flex: 1;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex: 2;
            justify-content: center;
        }

        .nav-item {
            margin-left: 20px;
            position: relative;
        }

        .nav-link {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #ff6347;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .bar {
            width: 25px;
            height: 3px;
            background-color: #fff;
            margin: 4px 0;
            transition: 0.3s;
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            height: 80vh;
            width: 80%;
            max-width: 750px;
            margin: 0 auto;
            padding: 70px 20px 20px; /* Espacio para la barra de navegación */
        }

        .chat-window {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 10px;
            overflow-y: auto;
            color: #000;
        }

        .chat-input-container {
            display: flex;
            margin-top: 10px;
        }

        #chat-input {
            flex: 1;
            padding: 10px;
            border-radius: 10px;
            border: none;
            margin-right: 10px;
        }

        #send-btn {
            padding: 10px 20px;
            background-color: #2bcd49ec;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        #send-btn:hover {
            background-color: #ff6347;
        }

        .chat-message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            background-color: #f1f1f1;
        }

        .chat-message.sent {
            background-color: #d1ffd6;
            align-self: flex-end;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0 10px;
        }

        .chat-message.received {
            background-color: #d6d6d6;
            align-self: flex-start;
        }

        .message-text {
            max-width: 70%;
            word-wrap: break-word;
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-menu {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: rgba(51, 51, 51, 0.9);
                padding: 10px 0;
                z-index: 999; /* Asegura que el menú esté encima del contenido */
            }

            .nav-item {
                margin: 10px 20px;
                position: static;
            }

            .nav-menu.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }

            .chat-container {
                padding: 70px 10px 10px;
                width: 95%;
                min-width: unset; /* Elimina el ancho mínimo para móviles */
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="imagen"><img src="images/logoEcoHuerto.png" width="60" alt=""></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"> Mi Huerto </a><i class="fa fa-home" aria-hidden="true"></i></li>
                <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link">Comprar </a><i class="fa fa-shopping-bag" aria-hidden="true"></i></li>
                <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link">Blog </a><i class="fa fa-tag" aria-hidden="true"></i></li>
                <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link">Perfil </i></a><i class="fa fa-user-circle" aria-hidden="true"></i></li>
              </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>
<br>
<br>
<br>  
<br>
    <main class="chat-container">
        <div class="chat-window" id="chat-window">
            <h1> Chatea con nosotros!</h1>
            <!-- Los mensajes se agregarán aquí dinámicamente -->
        </div>
        <div class="chat-input-container">
            <input type="text" id="chat-input" placeholder="Escribe tu mensaje...">
            <button id="send-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div>
    </main>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');

        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        const chatWindow = document.getElementById('chat-window');
        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-btn');

        sendBtn.addEventListener('click', () => {
            const message = chatInput.value.trim();
            if (message) {
                appendMessage('sent', message);
                chatInput.value = '';
                // Aquí puedes añadir la funcionalidad para enviar el mensaje al servidor
                setTimeout(() => {
                    appendMessage('received', 'Respuesta automática');
                }, 1000); // Simula una respuesta automática después de 1 segundo
            }
        });

        function appendMessage(type, text) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('chat-message', type);
            messageElement.textContent = text;
            chatWindow.appendChild(messageElement);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    </script>
</body>
</html>
