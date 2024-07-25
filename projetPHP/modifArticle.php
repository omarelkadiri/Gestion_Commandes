<?php 
    ob_start(); // Démarrer le tampon de sortie
    include_once("header.php");
    include_once("main.php");

    if (!empty($_GET["id"]))
    {
        $query="SELECT * FROM article WHERE idarticle = :id";
        $pdostmt=$pdo->prepare($query);
        $pdostmt->execute(["id"=>$_GET["id"]]);
        while( $row=$pdostmt->fetch(PDO::FETCH_ASSOC) ):
        //  header("Location: articales.php");
       // var_dump($row);
?>

    <h1 class="mt-5">Modifier article</h1>

    <form class="row g-3" method="POST">
         <input type="hidden"  name="inputid" value="<?php echo $_GET["id"]; ?>" >

        <div class="col-md-6">
            <label for="inputid" class="form-label">ID</label>
            <input type="number" disabled class="form-control" id="inputid" name="inputid" value="<?php echo $_GET['id'];?>"  required>
        </div>
        <div class="col-md-6">
            <label for="inputpu" class="form-label">Prix unitaire ($)</label>
            <input type="tel" class="form-control" id="inputpu" name="inputpu" value="<?php echo $row['prix_unitaire']; ?>" required>
        </div>
        <div class="col-12">
            <label for="inputdescpt" class="form-label">Description</label>
            <input type="text" class="form-control" id="inputdescpt" name="inputdescpt" value="<?php echo $row['description']; ?>" required>
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
        if (!empty($_POST["inputdescpt"]) && !empty($_POST["inputpu"]) && !empty($_POST["inputid"])) {
            $query = "UPDATE article SET description = :descriptio , prix_unitaire = :pu WHERE idarticle = :id";
            $pdostmt = $pdo->prepare($query);
            $result = $pdostmt->execute([
                'descriptio' => $_POST["inputdescpt"],
                'id' => $_POST["inputid"],
                'pu' => $_POST["inputpu"]
            ]);
    
            if ($result) {
                header("Location: articles.php");
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