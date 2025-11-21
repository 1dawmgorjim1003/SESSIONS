<?php
session_start();   // Iniciar sesión. Necesario para multipaso
include('functions.php');

//INICIALIZACIÓN DEL ENTORNO
bootstrap();

//LÓGICA NEGOCIO
function createRoutines() {
    $output = [];
    // Creación y carga 2 planes de mejora según los datos introducidos para el usuario
    if ($_SESSION['sex'] == 'Femenino') {
        if ($_SESSION['muscle'] == 'Pectorales') {
            if ($_SESSION['reps'] <= 10 ) {
                $output[0] = 'Priorizar proteínas y creatina. Pescados y carnes.';
                $output[1] = 'Entrenamientos de fuerza con mancuernas, 2 veces a la semana';
                //2º plan
                $output[2] = 'Priorizar solo proteínas. Pescados y frutos secos en abundacia.';
                $output[3] = 'Entrenamientos de fuerza con máquinas, 2 veces a la semana';
            } else {
                $output[0] = 'Priorizar solo suplementación varia. Pescados y pastas.';
                $output[1] = 'Entrenamientos de fuerza con mancuernas, 3 veces a la semana';
                //2º plan
                $output[2] = 'Priorizar solo proteínas. Carnes de calidad.';
                $output[3] = 'Entrenamientos de hipertrofia, 2 veces a la semana';
            }

        } else if ($_SESSION['muscle'] == 'Biceps') {
            if ($_SESSION['reps'] <= 10 ) {
                $output[0] = 'Priorizar proteínas magras. Huevos, legumbres y pescado.';
                $output[1] = 'Curl de bíceps con mancuernas, 2 veces a la semana.';
                //2º plan
                $output[2] = 'Incrementar frutas y frutos secos ricos en antioxidantes.';
                $output[3] = 'Rutina ligera de resistencia con bandas, 2 veces a la semana.';
            } else {
                $output[0] = 'Aumentar hidratos complejos y proteínas. Avena y pollo.';
                $output[1] = 'Entrenamientos de fuerza moderada, 3 veces a la semana.';
                //2º plan
                $output[2] = 'Priorizar comidas equilibradas con verduras y legumbres.';
                $output[3] = 'Entrenamientos de hipertrofia de bíceps, 2 veces a la semana.';
            }

        } else if ($_SESSION['muscle'] == 'Glúteos') {
            if ($_SESSION['reps'] <= 10 ) {
                $output[0] = 'Priorizar proteínas y grasas saludables. Aguacate y salmón.';
                $output[1] = 'Sentadillas y puente de glúteo, 2 veces a la semana.';
                //2º plan
                $output[2] = 'Incrementar ingesta de carbohidratos complejos.';
                $output[3] = 'Rutina básica con bandas elásticas, 2 veces a la semana.';
            } else {
                $output[0] = 'Comidas balanceadas con énfasis en proteínas.';
                $output[1] = 'Entrenamiento de glúteos con cargas medias, 3 veces a la semana.';
                //2º plan
                $output[2] = 'Consumir más fibra vegetal y proteína vegetal.';
                $output[3] = 'Entrenamientos de hipertrofia para glúteos, 2 veces a la semana.';
            }

        }
    } else if ($_SESSION['sex'] == 'Masculino'){
        if ($_SESSION['muscle'] == 'Pectorales') {
            if ($_SESSION['reps'] <= 10 ) {
                $output[0] = 'Priorizar proteínas completas. Pollo, ternera y lácteos.';
                $output[1] = 'Press de pecho con mancuernas, 2 veces a la semana.';
                //2º plan
                $output[2] = 'Añadir carbohidratos complejos para energía.';
                $output[3] = 'Rutina básica de fuerza en pecho, 2 veces a la semana.';

            } else {
                $output[0] = 'Enfatizar proteínas y creatina natural.';
                $output[1] = 'Rutina de pecho con cargas medias, 3 veces a la semana.';
                //2º plan
                $output[2] = 'Incrementar ingesta de verduras y frutos secos.';
                $output[3] = 'Entrenamientos de hipertrofia en pecho, 2 veces a la semana.';
            }

        } else if ($_SESSION['muscle'] == 'Biceps') {
            if ($_SESSION['reps'] <= 10 ) {
                $output[0] = 'Priorizar proteínas y buena hidratación.';
                $output[1] = 'Curl con mancuernas y martillo, 2 veces a la semana.';
                //2º plan
                $output[2] = 'Añadir más frutos secos y semillas.';
                $output[3] = 'Entrenamientos suaves de fuerza, 2 veces a la semana.';
            } else {
                $output[0] = 'Enfatizar carnes magras y carbohidratos complejos.';
                $output[1] = 'Rutina de bíceps con cargas medias, 3 veces a la semana.';
                //2º plan
                $output[2] = 'Priorizar comidas balanceadas ricas en fibra.';
                $output[3] = 'Entrenamientos de hipertrofia focalizada, 2 veces a la semana.';
            }

        } else if ($_SESSION['muscle'] == 'Glúteos') {
            if ($_SESSION['reps'] <= 10 ) {
                $output[0] = 'Consumir proteínas y grasas saludables. Yogur, pescado y aceite de oliva.';
                $output[1] = 'Sentadillas y zancadas, 2 veces a la semana.';
                //2º plan
                $output[2] = 'Aumentar ingesta de cereales integrales.';
                $output[3] = 'Rutina ligera con peso corporal, 2 veces a la semana.';
            } else {
                $output[0] = 'Priorizar alimentos ricos en proteína para mejorar volumen muscular.';
                $output[1] = 'Entrenamientos de glúteos con cargas medias, 3 veces a la semana.';
                //2º plan
                $output[2] = 'Incrementar verduras, arroz y pasta integral.';
                $output[3] = 'Rutina de hipertrofia de glúteos, 2 veces a la semana.';
            }

        }
    }

    // Guardar planes en sesión
    $_SESSION['option1_n'] = $output[0];
    $_SESSION['option1_d'] = $output[1];
    $_SESSION['option2_n'] = $output[2];
    $_SESSION['option2_d'] = $output[3];

    return $output;
}


$routinesData = createRoutines();

//LÓGICA PRESENTACIÓN
function getInfoMarkup($routinesData) {
    return '
    <div class="stack-3">
        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>Plan de mejora</th>
                        <th>Nutrición</th>
                        <th>Deporte</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Opción 1</td>
                        <td>'.$routinesData[0].'</td>
                        <td>'.$routinesData[1].'</td>
                    </tr>
                    <tr>
                        <td>Opción 2</td>
                        <td>'.$routinesData[2].'</td>
                        <td>'.$routinesData[3].'</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="display:flex;gap:.75rem;justify-content:space-between;flex-wrap:wrap;margin-top:var(--sp-3);">
            <a class="btn btn-outline" href="./first_page-form.php">Atrás</a>
            <a class="btn" href="./third_page-form.php">Siguiente</a>
        </div>
    </div>';
}

$infoMarkup = getInfoMarkup($routinesData);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Multipaso - Paso 2</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
    <main class="container" style="padding-block:var(--sp-5);">
        <section class="card gradient-border float mx-auto stack-3" style="max-width:720px;">
            <header class="card-header">
                <div>
                    <h1 class="halo">Formulario multipaso – Paso 2</h1>
                    <p class="text-soft">Elige el plan de mejora que mejor encaje contigo.</p>
                </div>
            </header>

            <div class="card-body">
                <?php echo $infoMarkup ?>
            </div>
        </section>
    </main>
</body>
</html>