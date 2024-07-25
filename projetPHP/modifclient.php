<?php 
    ob_start(); // Démarrer le tampon de sortie
    include_once("header.php");
    include_once("main.php");

    if (!empty($_GET["id"]))
    {
        $query="SELECT * FROM client WHERE idclient = :id";
        $pdostmt=$pdo->prepare($query);
        $pdostmt->execute(["id"=>$_GET["id"]]);
        while( $row=$pdostmt->fetch(PDO::FETCH_ASSOC) ):
        //  header("Location: clients.php");
    

       // var_dump($row);
?>

    <h1 class="mt-5">Modifier client</h1>

    <form class="row g-3" method="POST">
         <input type="hidden"  name="inputid" value="<?php echo $_GET["id"]; ?>" >

        <div class="col-md-6">
            <label for="inputnom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="inputnom" name="inputnom" value="<?php echo $row['nom'];?>"  required>
        </div>
        <div class="col-md-6">
            <label for="inputville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="inputville" name="inputville" value="<?php echo $row['ville']; ?>" required>
        </div>
        <div class="col-12">
            <label for="inputtel" class="form-label">Télephone</label>
            <input type="tel" class="form-control" id="inputtel" name="inputtele" value="<?php echo $row['telephone']; ?>" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>

    <?php
        endwhile;
        $pdostmt->closeCursor();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST["inputnom"]) && !empty($_POST["inputville"]) && !empty($_POST["inputtele"]) && !empty($_POST["inputid"])) {
            $query = "UPDATE client SET nom = :nom, ville = :ville, telephone = :telephone WHERE idclient = :idclient";
            $pdostmt = $pdo->prepare($query);
            $result = $pdostmt->execute([
                'nom' => $_POST["inputnom"],
                'ville' => $_POST["inputville"],
                'telephone' => $_POST["inputtele"],
                'idclient' => $_POST["inputid"]
            ]);
    
            if ($result) {
                header("Location: clients.php");
                exit;
            } else {
                echo "Erreur lors de la mise à jour du client.";
            }
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }

    ?>

</div>
</main>

<?php 
    include_once("footer.php");
    ob_end_flush(); // Envoyer le tampon de sortie au navigateur

?>