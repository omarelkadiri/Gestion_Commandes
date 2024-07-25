<?php 
    $articles=true;
    ob_start();
    include_once("header.php");
    include_once("main.php");

    if (!empty($_POST["inputdescpt"])&&!empty($_POST["inputpu"]))
    {
        $query="insert into article(description,prix_unitaire) value (:description,:pu)";
        $pdostmt=$pdo->prepare($query);
        $pdostmt->execute(["description"=>$_POST["inputdescpt"],"pu"=>$_POST["inputpu"]]);
        $pdostmt->closeCursor();
        header("Location: articles.php");
        exit;
    }
    ob_end_flush();
?>

    <h1 class="mt-5" style="margin-bottom:60px;">Ajouter Article</h1>


    <form class="row g-3" method="POST">
        <div class="col-md-12">
            <label for="inputdescpt" class="form-label">Description</label>
            <input type="text" class="form-control" id="inputdescpt" name="inputdescpt" required>
        </div>
        <div class="col-md-6">
            <label for="inputpu" class="form-label">Prix unitaire</label>
            <input type="text" class="form-control" id="inputpu" name="inputpu" required>
        </div>

        <div class="col-12" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

</div>
</main>

<?php 
    include_once("footer.php");
?>