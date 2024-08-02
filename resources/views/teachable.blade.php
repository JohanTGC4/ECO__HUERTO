<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salud</title>
    <link rel="icon" href="{{ asset('images/logoEcoHuerto.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/teachable.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="imagen"><img src="{{ asset('images/logoEcoHuerto2-removebg-preview.png') }}" style="border-radius: 50%; width: 60px;" alt=""></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('misplantas.index') }}" class="nav-link"><span>Mi plantas</span>  <i class="fa fa-leaf" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('comprar') }}" class="nav-link"><span>Comprar</span><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link"><span>Publicaciones</span><i class="fa fa-tag" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('teachable') }}" class="nav-link"><span>Salud</span><i class="fa fa-heartbeat" aria-hidden="true"></i></a></li>
                <li class="nav-item"><a href="{{ route('perfilcli') }}" class="nav-link"><span>Perfil</span><i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </nav>
    <br>
    <br>
    <br>

    <div class="titulo-teach"> Un Curita Para Tu Planta </div>
    <button id="start-button" class="butt-init" type="button" onclick="init()">Comenzar</button>
    <br>
    <br>
    <button id="toggle-camera-button" class="butt-init" type="button" style="display: none;" onclick="toggleCamera()">Cambiar Cámara</button>
    <div class="loader" id="loader">
        <span class="item"></span>
        <span class="item"></span>
        <span class="item"></span>
        <span class="item"></span>
    </div>
    <div id="webcam-container"></div>
    <div id="label-container"></div>
    <div id="result-container" style="padding: 10px; box-sizing: border-box;"></div>

    <!-- ::::::::: CARD ::::::::::::::::::::::: -->
    <div id="info-card" class="card">
        <div class="bg"></div>
        <div class="blob"></div>
        <div class="info-content">
            <h2>Aprende a cuidar tu planta</h2>
            <p>Si tu planta presenta algún problema, esta herramienta te permitirá identificar la causa y la solución.
                Simplemente coloca tu planta frente a la cámara, y automáticamente te mostraremos cuál podría ser el problema y 
                qué medidas tomar para remediarlo.</p>
        </div>
    </div>

    <script type="text/javascript">
        const URL = "./my_model/";

        let model, webcam, labelContainer, maxPredictions;
        let usingBackCamera = true;

        async function init() {
            try {
                console.log("Iniciando...");
                document.getElementById("loader").style.display = "flex";
                document.getElementById("info-card").style.display = "none";

                const modelURL = URL + "model.json";
                const metadataURL = URL + "metadata.json";

                console.log("Cargando modelo desde", modelURL);
                model = await tmImage.load(modelURL, metadataURL);
                maxPredictions = model.getTotalClasses();

                await setupWebcam();
            } catch (error) {
                console.error("Error durante la inicialización:", error);
                document.getElementById("loader").style.display = "none";
                document.getElementById("info-card").style.display = "block";
            }
        }

        async function setupWebcam() {
            if (webcam) {
                webcam.stop();
                webcam.webcam.srcObject.getTracks().forEach(track => track.stop());
            }

            const flip = true;
            const width = 600;
            const height = 400;

            const constraints = {
                video: {
                    facingMode: usingBackCamera ? { exact: "environment" } : "user"
                }
            };

            webcam = new tmImage.Webcam(width, height, flip, constraints);
            await webcam.setup();
            await webcam.play();
            window.requestAnimationFrame(loop);

            const webcamContainer = document.getElementById("webcam-container");
            webcamContainer.innerHTML = '';
            webcamContainer.appendChild(webcam.canvas);
            webcamContainer.classList.add("active");

            const startButton = document.getElementById("start-button");
            const toggleCameraButton = document.getElementById("toggle-camera-button");
            if (startButton) {
                startButton.style.display = "none";
            }
            if (toggleCameraButton) {
                toggleCameraButton.style.display = "block";
            }

            document.getElementById("loader").style.display = "none";

            labelContainer = document.getElementById("label-container");
            labelContainer.innerHTML = '';
            for (let i = 0; i < maxPredictions; i++) {
                labelContainer.appendChild(document.createElement("div"));
            }
            console.log("Modelo y webcam configurados correctamente.");
        }

        function toggleCamera() {
            usingBackCamera = !usingBackCamera;
            setupWebcam();
        }

        async function loop() {
            webcam.update();
            await predict();
            window.requestAnimationFrame(loop);
        }

        async function predict() {
            try {
                const prediction = await model.predict(webcam.canvas);
                console.log("Predicciones: ", prediction);

                let highestPrediction = { index: -1, probability: 0 };

                for (let i = 0; i < maxPredictions; i++) {
                    const classPrediction = {
                        index: i,
                        probability: prediction[i].probability
                    };

                    if (classPrediction.probability > highestPrediction.probability) {
                        highestPrediction = classPrediction;
                    }
                }

                console.log("Mejor predicción: ", highestPrediction);

                const resultContainer = document.getElementById("result-container");
                let message = ""; 
                let message2 = "";

                switch (highestPrediction.index) {
                    case 0:
                        message = "Daño por Alternaria";
                        message2 = "1. Regar las plantas en la base en lugar de las hojas para reducir la humedad, lo que puede limitar la propagación del hongo. <br> 2. Retirar y destruir las partes de las plantas afectadas para evitar la propagación de esporas. <br> 3. Asegurar un buen flujo de aire alrededor de las plantas espaciándolas adecuadamente.";
                        break;
                    case 1:
                        message = "Daño por Congelación";
                        message2 = "1. Utiliza coberturas como mantas de jardín, telas antiheladas o mulch (acolchado) para proteger las plantas durante las heladas. <br>  2. Realiza una poda cuidadosa para eliminar las partes dañadas de la planta. <br> 3.Usa fertilizantes ricos en potasio, que pueden ayudar a aumentar la resistencia de las plantas al frío y mejorar su recuperación.";
                        break;
                    case 2:
                        message = "Daño por falta de agua";
                        message2 = "1. Asegúrate de agregar agua manualmente y desde los detalles observar cuando tengas el nivel de humedad correcto <br> 2. Cubre el suelo alrededor de las plantas con mulch (acolchado) para conservar la humedad y reducir la evaporación. <br> 3. No riegues en exceso, ya que esto puede provocar problemas de raíz y aumentar el riesgo de enfermedades.";
                        break;
                    case 3:
                        message = "Daño por Mildiu";
                        message2 = "1. Riega las plantas en la base y evita mojar las hojas <br> 2. Retira y destruye las partes de las plantas que muestran signos de mildiu para reducir la fuente de inóculo. <br> 3. Aplicación de mulch para mantener el suelo húmedo y reducir el riesgo de esporas del mildiu ";
                        break;
                    case 4:
                        message = "Daño por Moho Polvoriento";
                        message2 = "1. Aplica fungicidas específicos para el moho polvoriento, como aquellos que contienen azufre, bicarbonato de potasio o miconazol. <br> 2. Mantén una buena ventilación y controla la humedad en el área de cultivo. <br> 3. Retira y destruye las partes de las plantas que muestran signos de moho polvoriento";
                        break;
                    case 5:
                        message = "Daño por Pudricion Bacteriana";
                        message2 = "1. Evita el riego excesivo, ya que el exceso de agua puede promover la proliferación de bacterias. <br> 2. Espacia las plantas adecuadamente para mejorar la ventilación y reducir la humedad ";
                        break;
                    case 6:
                        message = "Daño por Quemadura de sol";
                        message2 = "1. Utiliza sombrillas, redes de sombra, o estructuras de sombra o reubica las plantas en áreas donde reciban luz solar indirecta <br> 2. Aplica una capa de mulch (acolchado) alrededor de la base de las plantas para ayudar a mantener la humedad del suelo y moderar las temperaturas extremas del suelo.";
                        break;
                    case 7:
                        message = "Daño por Roya";
                        message2 = "1. Realiza y bierte una mezcla de leche y agua (1 parte de leche por 9 partes de agua). <br> 2. Asegura un buen espaciado entre las plantas para mejorar la ventilación y reducir la humedad, lo que puede limitar el desarrollo del hongo";
                        break;
                    case 8:
                        message = "Daño por virus de mosaico";
                        message2 = "Infusión de Ajo: Mezcla 3-4 dientes de ajo triturados con 1 litro de agua y deja reposar durante 24 horas. Cuela la mezcla y aplícalo en las plantas para repeler insectos vectores como los áfidos.";
                        break;
                    default:
                        message = "Clase no reconocida";
                        message2 = "";
                        break;
                }

                resultContainer.innerHTML = `
                   <div class="notification">
                        <div class="notiglow"></div>
                        <div class="notiborderglow"></div>
                        <div class="notititle">${message}</div>
                        <div class="notibody">${message2}</div>
                    </div>
                `;
            } catch (error) {
                console.error("Error en la predicción: ", error);
            }
        }
    </script>
</body>
</html>
