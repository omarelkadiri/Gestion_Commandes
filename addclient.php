<?php 
    $clients=true;
    ob_start();
    include_once("header.php");
    include_once("main.php");

    if (!empty($_POST["inputnom"])&&!empty($_POST["inputville"])&&!empty($_POST["inputtele"]))
    {
        $query="insert into client(nom,ville,telephone) value (:nom,:ville,:tele)";
        $pdostmt=$pdo->prepare($query);
        $pdostmt->execute(["nom"=>$_POST["inputnom"],"ville"=>$_POST["inputville"],"tele"=>$_POST["inputtele"]]);
        $pdostmt->closeCursor();
        header("Location: clients.php");
    }
    ob_end_flush();
?>

    <h1 class="mt-5">Ajouter client</h1>


    <form class="row g-3" method="POST">
        <div class="col-md-6">
            <label for="inputnom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="inputnom" name="inputnom" required>
        </div>
        <div class="col-md-6">
            <label for="inputville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="inputville" name="inputville" required>
        </div>
        <div class="col-12">
            <label for="inputtel" class="form-label">Télephone</label>
            <input type="tel" class="form-control" id="inputtel" name="inputtele" require>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

</div>
</main>

<?php 
    include_once("footer.php");
?>