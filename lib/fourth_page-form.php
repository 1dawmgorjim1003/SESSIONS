<?php
session_start();   // Iniciar sesión. Necesario para multipaso
include('functions.php');

//INICIALIZACIÓN DEL ENTORNO
bootstrap();

//LÓGICA NEGOCIO
function organizeSessionData() {
    // Organizar los planes para su muestra final
    $output = [];
    $output[0] = $_SESSION['option1_n'];
    $output[1] = $_SESSION['option1_d'];
    $output[2] = $_SESSION['option2_n'];
    $output[3] = $_SESSION['option2_d'];

    return $output;
}

function clearSessionData() {
    // Borrar datos de sesión cuando se envían los datos
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        session_destroy();
        session_unset();
        header('Location: ../form.php');
    }   
}

$routinesData = organizeSessionData();
clearSessionData();

//LÓGICA PRESENTACIÓN
function getPhotoMarkup() {
    $photoName = '../src/uploads/' . $_SESSION['photo'];
    return '
        <img class="halo" src="'.$photoName.'" width="150" height="150" loading="lazy"
             alt="Avatar seleccionado" style="border-radius:var(--r-md);object-fit:cover;">
    ';
}

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

        <form class="stack-2" action="'.$_SERVER['PHP_SELF'].'" method="post">
            <a href="./third_page-form.php" class="btn halo">Volver atrás</a>
            <button class="btn halo" type="submit">Enviar datos y volver al principio</button>
        </form>
    </div>';
}

$photoMarkup = getPhotoMarkup();
$infoMarkup = getInfoMarkup($routinesData);
// dump($_SESSION['photo']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Multipaso - Paso 4</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
    <main class="container" style="padding-block:var(--sp-5);">
        <section class="card gradient-border float mx-auto stack-3" style="max-width:720px;">
            <header class="card-header">
                <div>
                    <h1 class="halo">Resumen de tu plan</h1>
                    <p class="text-soft">Revisa la información antes de enviar.</p>
                </div>
            </header>
            <div class="center" style="padding: var(--sp-4);">
                <?php echo $photoMarkup ?>
            </div> 
            <div class="card-body">
                <?php echo $infoMarkup ?>
            </div>
        </section>
    </main>
</body>
</html>