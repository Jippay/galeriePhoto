<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/united/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="script/jquery-ui/jquery-ui.css">
    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
    <title>Banque d'image Nature 18</title>
</head>
<body>
<div class="title">
    <h1>Banque d'image Nature 18</h1>
</div>
<?php
  require_once 'class/connectDB.php';
  include("selectForm.php");
?>

<div class="container mt-2 w-50">
    <div class="d-flex justify-content-center p-3 rounded-top titleform">
        <h2>Ajouter une photo</h2>
    </div>
    <div class="d-flex rounded-bottom pt-2 justify-content-center bg-light">
        <form class="upload" method="POST" action="upload.php" enctype="multipart/form-data">
            <!-- On limite le fichier à 100Ko -->
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000000 ">
            <div class="form-group p-2">
                <input type="file" class="form-control-file" name="photo" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 pb-2">
                    <label for="theme">Choisir un theme:</label>
                    <select name="theme" class= "form-control" id="themeSelect" required>
                        <?php getThemes(); ?>
                    </select>
                </div>
                <div class="form-group col pb-2">
                    <label for="photographe">Choisir un photographe:</label>
                    <select name="photographe" class="form-control" id="photographeSelect" required>
                        <?php 
                        getPhotographe(); ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8 pb-2">
                    <label for="sujet">Choisir le sujet (espece, milieux ...)</label>
                    <input type="text" name="sujet" class="form-control" id="sujet" placeholder="sujet" required>
                    
                </div>
                <div class="form-group col pb-2">
                    <label for="droit">Droit de diffusion :</label>
                    <select name="droitDiff" class= "form-control" id="themeSelect" required>
                        <?php getDiffusion(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group pb-2">
                <input type="submit" class="btn btn-primary" name="envoyer" value="Envoyer le fichier">
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="script/jquery-ui/external/jquery/jquery.js"></script>
<script src="script/jquery-ui/jquery-ui.js"></script>
<script src="script/completion.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>