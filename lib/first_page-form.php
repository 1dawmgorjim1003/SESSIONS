<?php
session_start();   // Iniciar sesión. Necesario para multipaso
include('functions.php');

//INICIALIZACIÓN DEL ENTORNO
bootstrap();

//LÓGICA NEGOCIO
function saveSessionData() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Guardar valores del formulario en la misma sesión
    $_SESSION["sex"] = $_POST["sex"];
    $_SESSION["muscle"] = $_POST["muscle"];
    $_SESSION["reps"] = $_POST["reps"];

    // Pasar a la siguiente sección del formulario
    header("Location: second_page-form.php");
    }
}

saveSessionData();

//LÓGICA PRESENTACIÓN
function getFormMarkup() {
    return '
    <form class="stack-3" action="'.$_SERVER['PHP_SELF'].'" method="post">
        <div class="form-banner-invalid">
            <span>⚠️</span>
            <span>Revisa los campos marcados.</span>
        </div>

        <div class="field">
            <label class="label" for="sex">Sexo biológico</label>
            <select class="select" name="sex" id="sex" required>
                <option value="" disabled '.(!isset($_SESSION["sex"]) ? "selected" : "").'>Selecciona...</option>
                <option value="Masculino" '.(($_SESSION["sex"] ?? "") == "Masculino" ? "selected" : "").'>Masculino</option>
                <option value="Femenino" '.(($_SESSION["sex"] ?? "") == "Femenino" ? "selected" : "").'>Femenino</option>
            </select>
        </div>

        <div class="field">
            <label class="label" for="muscle">Músculo que deseas mejorar</label>
            <select class="select" name="muscle" id="muscle" required>
                <option value="" disabled '.(!isset($_SESSION["muscle"]) ? "selected" : "").'>Selecciona...</option>
                <option value="Pectorales" '.(($_SESSION["muscle"] ?? "") == "Pectorales" ? "selected" : "").'>Pectorales</option>
                <option value="Biceps" '.(($_SESSION["muscle"] ?? "") == "Biceps" ? "selected" : "").'>Bíceps</option>
                <option value="Glúteos" '.(($_SESSION["muscle"] ?? "") == "Glúteos" ? "selected" : "").'>Glúteos</option>
            </select>
        </div>

        <div class="field">
            <label class="label" for="reps">Repeticiones al fallo</label>
            <input class="input" type="number" name="reps" id="reps" value="'.($_SESSION['reps'] ?? '').'" required>
        </div>

        <div style="display:flex;gap:.75rem;justify-content:flex-end;flex-wrap:wrap;margin-top:var(--sp-3);">
            <button class="btn" type="submit">Siguiente</button>
        </div>
    </form>';
}


$formMarkup = getFormMarkup();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Multipaso - Paso 1</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
    <main class="container" style="padding-block:var(--sp-5);">
        <section class="card gradient-border float mx-auto stack-3" style="max-width:720px;">
            <header class="card-header">
                <div>
                    <h1 class="halo">Formulario multipaso – Paso 1</h1>
                    <p class="text-soft">Completa los datos iniciales para personalizar tu plan.</p>
                </div>
            </header>

            <div class="card-body">
                <?php echo $formMarkup ?>
            </div>
        </section>
    </main>
</body>
</html>
