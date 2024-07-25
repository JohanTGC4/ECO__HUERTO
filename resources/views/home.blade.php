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
        <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Blog</span><i class="fa fa-tag" aria-hidden="true"></i></a></li>
        <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
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
        <td><a href="{{ route('misplantas') }}">Mis plantas <i class="fa fa-leaf" aria-hidden="true"></i></a></td>
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
<button class="open-btn"> </button>
</body>
</html>




<script>
      const hamburger = document.querySelector('.hamburger');
  const navMenu = document.querySelector('.nav-menu');

  hamburger.addEventListener('click', () => {
    navMenu.classList.toggle('active');
  });

  /**chat bor**/
  document.addEventListener("DOMContentLoaded", function () {
      const chatbot = document.querySelector(".chatbot");
      const openBtn = document.querySelector(".open-btn");
      const closeBtn = document.querySelector(".close-btn");
      const sendBtn = document.getElementById("sendBtn");
      const userInput = document.getElementById("userInput");
      const chatbotMessages = document.querySelector(".chatbot-messages");

      openBtn.addEventListener("click", () => {
          chatbot.style.display = "flex";
          openBtn.style.display = "none";
          showMenuOptions();
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
                  addMessage("bot", getBotResponse(message));
                  showMenuOptions();
              }, 500);
          }
      });

      function showMenuOptions() {
          const menuOptions = document.createElement("div");
          menuOptions.className = "bot-message";
          menuOptions.innerHTML = `
              <button class="menu-option" data-value="¿Quienes somos?">¿Quienes somos?</button>
              <button class="menu-option" data-value="¿Como se hace el cultivo?">¿Como se hace el cultivo?</button>
              <button class="menu-option" data-value="¿Como puedo agregar planta?">¿Como puedo agregar planta?</button>
          `;
          chatbotMessages.appendChild(menuOptions);
          chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

          const options = menuOptions.querySelectorAll('.menu-option');
          options.forEach(option => {
              option.addEventListener('click', () => {
                  userInput.value = option.getAttribute('data-value');
              });
          });
      }

      function addMessage(sender, text) {
          const messageElem = document.createElement("div");
          messageElem.className = sender === "user" ? "user-message" : "bot-message";
          messageElem.textContent = text;
          chatbotMessages.appendChild(messageElem);
          chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
      }

      function getBotResponse(message) {
          const responses = {
              "¿Quienes somos?": "Somos una empresa dedicada a la agricultura sostenible.",
              "¿Como se hace el cultivo?": "El cultivo se realiza mediante técnicas orgánicas para asegurar la mejor calidad.",
              "¿Como puedo agregar planta?": "Para agregar una planta, visita nuestra sección de agregar plantas en el sitio web."
          };
          return responses[message] || "Lo siento, no entiendo tu pregunta.";
      }
  });
</script>