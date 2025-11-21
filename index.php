<?php
    include('lib/functions.php');
    bootstrap();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles.css">
    <title>CONTADOR DE VISITAS</title>
</head>
<body>
      <main class="container center">
        <section class="card gradient-border pad-4 stack-3" style="width:min(680px,100%);">
            
            <header class="card-header">
                <div>
                    <h1 class="halo" style="font-size:var(--step-2);">
                        Contador de visitas con cookies
                    </h1>
                    <p class="text-soft" style="font-size:var(--step-0);margin-top:.25rem;">
                        Este contador usa cookies para recordar tus visitas.
                    </p>
                </div>
            </header>

            <div class="card-body stack-3">
                <p class="badge">
                    <?php echo $cookieMarkup; ?>
                </p>
            </div>

        </section>
    </main>   
</body>
</html>

