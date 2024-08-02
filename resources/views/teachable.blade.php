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

    <div class="titulo-teach"> Un Curita Para Tu Planta </div>
    <button id="start-button" class="butt-init" type="button" onclick="init()">Comenzar</button>
    <div class="loader" id="loader">
        <span class="item"></span>
        <span class="item"></span>
        <span class="item"></span>
        <span class="item"></span>
    </div>
    <div id="webcam-container"></div>
    <div id="label-container"></div>
    <div id="result-container"></div>

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

                console.log("Configurando webcam...");
                const flip = true; 
                const width = 600;  
                const height = 400; 
                webcam = new tmImage.Webcam(width, height, flip);
                await webcam.setup(); 
                await webcam.play();
                window.requestAnimationFrame(loop);

                const webcamContainer = document.getElementById("webcam-container");
                webcamContainer.appendChild(webcam.canvas);
                webcamContainer.classList.add("active");

                // Oculta el botón y la carta después de iniciar la webcam
                const startButton = document.getElementById("start-button");
                if (startButton) {
                    startButton.style.display = "none";
                    console.log("Botón ocultado.");
                } else {
                    console.error("Botón no encontrado.");
                }

                document.getElementById("loader").style.display = "none";

                labelContainer = document.getElementById("label-container");
                for (let i = 0; i < maxPredictions; i++) {
                    labelContainer.appendChild(document.createElement("div"));
                }
                console.log("Modelo y webcam configurados correctamente.");
            } catch (error) {
                console.error("Error durante la inicialización:", error);
                document.getElementById("loader").style.display = "none";
                document.getElementById("info-card").style.display = "block";
            }
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
                        message = "Daño por causa de sol";
                        message2 = "Utiliza azúcar";
                        break;
                    case 1:
                        message = "Daño por falta de agua";
                        message2 = "Asegúrate de agregar agua manualmente y desde los detalles observar cuando tengas el nivel de humedad correcto";
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
