<?php include('_head.php');
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
                    <label for="sujet">Choisir le sujet (espece, le milieux ...)</label>
                    <input type="text" name="sujet" class="form-control" placeholder="sujet" required>
                    <input type="text" name="sujet2" class="form-control" placeholder="sujet">
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

<?php include('_footer.php');?>