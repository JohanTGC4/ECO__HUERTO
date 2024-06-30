<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>
    <div class="chatbot">
        <div class="chatbot-header">
            Chatbot
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
    <button class="open-btn">Chat</button>
    <script src="script.js"></script>
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