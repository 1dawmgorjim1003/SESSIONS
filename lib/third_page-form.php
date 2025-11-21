<?php
session_start();   // Iniciar sesión. Necesario para multipaso
include('functions.php');

//INICIALIZACIÓN DEL ENTORNO
bootstrap();

//LÓGICA NEGOCIO
function saveSessionData() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Guardar valores del formulario en la sesión
    $_SESSION["name"]  = $_POST["name"]  ?? null;
    $_SESSION["email"] = $_POST["email"] ?? null;

    // Manejo de archivo subido (como en CRUD)
    if (!empty($_FILES['photo']['name'])) {
        $avatarTmpName = $_FILES['photo']['tmp_name'];
        $avatarName = $_FILES['photo']['name'];
        $avatarExt = strtolower(pathinfo($avatarName, PATHINFO_EXTENSION));
        // Nombre final del archivo
        $avatarName = 'avatar_' . time() . '.' . $avatarExt;
        $avatarDir  = '../src/uploads/';
        $avatarPath = $avatarDir . $avatarName;
        move_uploaded_file($avatarTmpName, $avatarPath);

        $_SESSION["photo"] = $avatarName;

        }
        header("Location: fourth_page-form.php");
    }
}

saveSessionData();
// dump($_SESSION["photo"]);

//LÓGICA PRESENTACIÓN
function getFormMarkup() {
    $formMarkup  = '
    <form class="stack-3" action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data">
        <div class="form-banner-invalid">
            <span>⚠️</span>
            <span>Revisa los campos marcados.</span>
        </div>

        <div class="field">
            <label class="label" for="name">Nombre</label>
            <input class="input" type="text" name="name" id="name" value="'.($_SESSION['name'] ?? '').'" required>
        </div>

        <div class="field">
            <label class="label" for="email">Email</label>
            <input class="input" type="email" name="email" id="email" value="'.($_SESSION['email'] ?? '').'" required>
        </div>';

    if (!isset($_SESSION["photo"])) {
        $formMarkup .= '
        <div class="field">
            <label class="label" for="photo">Avatar</label>
            <input class="input" type="file" accept=".jpg, .png" name="photo" id="photo" required>
            <p class="help">Formatos permitidos: JPG, PNG.</p>
        </div>';
    } else {
        $formMarkup .= '
        <p class="text-soft">Foto ya seleccionada antes.</p>';
    }

    $formMarkup .= '
        <div style="display:flex;gap:.75rem;justify-content:space-between;flex-wrap:wrap;margin-top:var(--sp-3);">
            <a class="btn btn-outline" href="second_page-form.php">Atrás</a>
            <button class="btn" type="submit">Siguiente</button>
        </div>
    </form>';

    return $formMarkup;
}

$formMarkup = getFormMarkup();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Multipaso - Paso 3</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
    <main class="container" style="padding-block:var(--sp-5);">
        <section class="card gradient-border float mx-auto stack-3" style="max-width:720px;">
            <header class="card-header">
                <div>
                    <h1 class="halo">Formulario multipaso – Paso 3</h1>
                    <p class="text-soft">Datos de contacto y tu avatar.</p>
                </div>
            </header>

            <div class="card-body">
                <?php echo $formMarkup ?>
            </div>
        </section>
    </main>
</body>
</html>