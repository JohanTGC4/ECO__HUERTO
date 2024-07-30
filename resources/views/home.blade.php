<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoHuerto</title>
  <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
 <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
  <nav class="navbar">
    <div class="navbar-container">
      <a href="#" class="imagen"><img src="{{ asset('images/logoEcoHuerto2-removebg-preview.png') }}" style="border-radius: 50%; width: 60px;" alt=""></a>
      <ul class="nav-menu">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><span>Mi Huerto</span><i class="fa fa-home" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link"><span>Comprar</span><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Publicaciones</span><i class="fa fa-tag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('usuario.teachable') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </nav>
  <br>
  <br>
   <!-- Contenedor de la tabla -->
   <div class="table-container">
    <table class="custom-table">
      <tr>
        
        <td><a href="{{ route('home') }}">Por hacer <i class="fa fa-history" aria-hidden="true"></i></a></td>
        <td><a href="{{ route('misplantas.index') }}">Mis plantas <i class="fa fa-leaf" aria-hidden="true"></i></a></td>
      </tr>
    </table>
  </div>
   <!-- Sección de tarjetas -->
   <div class="card-container">
    <div class="card">
      <img src="{{ asset('images/zanahoria.jpg') }}" width="30" alt="Imagen 1" class="card-img">
      <div class="card-content">
        <h3>Domingo,junio 16</h3>
        <p>Regar la planta de zanahoria</p>
      </div>
    </div>
    <div class="card">
      <img src="{{ asset('images/tomateplanta.jpg') }}" alt="Imagen 2" class="card-img">
      <div class="card-content">
        <h3>Lunes,junio 17</h3>
        <p>Regar planta de tomate</p>
      </div> 
    </div>
  </div>
  <script src="scripts.js"></script>
  </div>

  <div class="chatbot">
    <div class="chatbot-header">
        Ecohuerto
        <span class="close-btn">&times;</span>
    </div>
    <div class="chatbot-body">
        <div class="chatbot-messages"></div>
    </div>
    <div class="chatbot-footer">
        <input type="text" id="userInput" placeholder="Escribe un mensaje...">
        <button id="sendBtn">Enviar</button>
    </div>
</div>
<button class="open-btn"></button>

</body>
</html>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const chatbot = document.querySelector(".chatbot");
    const openBtn = document.querySelector(".open-btn");
    const closeBtn = document.querySelector(".close-btn");
    const sendBtn = document.getElementById("sendBtn");
    const userInput = document.getElementById("userInput");
    const chatbotMessages = document.querySelector(".chatbot-messages");

    let menuOptionsContainer;

    openBtn.addEventListener("click", () => {
        chatbot.style.display = "flex";
        openBtn.style.display = "none";
        if (!menuOptionsContainer) {
            showMenuOptions();
        }
    });

    closeBtn.addEventListener("click", () => {
        chatbot.style.display = "none";
        openBtn.style.display = "block";
    });

    sendBtn.addEventListener("click", () => {
        const message = userInput.value.trim();
        if (message) {
            addMessage("user", message);
            userInput.value = '';
            setTimeout(() => {
                const response = getBotResponse(message);
                addMessage("bot", response);
                // Keep the menu options visible after sending a message
                if (response === "Lo siento, no entiendo tu pregunta.") {
                    showMenuOptions();
                }
            }, 500);
        }
    });

    function showMenuOptions() {
        if (menuOptionsContainer) return; // If menu options container is already created, do nothing

        menuOptionsContainer = document.createElement("div");
        menuOptionsContainer.className = "menu-options-container";
        chatbotMessages.appendChild(menuOptionsContainer);

        const options = [
            "¿Dónde reviso la información del riego de mi planta?",
            "¿Por qué no me deja agregar más plantas?",
            "¿Hay devolución en alguna compra?",
            "¿Aceptan cualquier tarjeta?",
            "¿Cómo los contacto?"
        ];

        options.forEach(optionText => {
            const menuOption = document.createElement("div");
            menuOption.className = "menu-option-message";
            menuOption.textContent = optionText;
            menuOptionsContainer.appendChild(menuOption);
            menuOption.addEventListener('click', () => {
                userInput.value = optionText;
                sendBtn.click();
            });
        });

        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function addMessage(sender, text) {
        const messageElem = document.createElement("div");
        messageElem.className = "message-container";

        const avatarElem = document.createElement("img");
        avatarElem.className = "avatar";
        avatarElem.src = sender === "user" ? "../images/avatarusuario.png" : "../images/logoEcoHuerto.png";

        const textElem = document.createElement("div");
        textElem.className = sender === "user" ? "user-message" : "bot-message";
        textElem.textContent = text;

        messageElem.appendChild(avatarElem);
        messageElem.appendChild(textElem);
        chatbotMessages.appendChild(messageElem);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function getBotResponse(message) {
        const responses = {
            "¿Dónde reviso la información del riego de mi planta?": "En la parte de 'Mis Plantas', en el botón de ver más información se encuentra el riego que lleva su planta.",
            "¿Por qué no me deja agregar más plantas?": "Solo se pueden agregar 15 plantas por usuario.",
            "¿Hay devolución en alguna compra?": "Por el momento no contamos con ninguna devolución.",
            "¿Aceptan cualquier tarjeta?": "Solo PayPal, por el momento.",
            "¿Cómo los contacto?": "Por correo electrónico: ecohuerto10@gmail.com"
        };
        return responses[message] || "Lo siento, no entiendo tu pregunta.";
    }
});

</script>