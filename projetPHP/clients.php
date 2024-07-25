<?php 
    $clients=true;
    include_once("header.php");
    include_once("main.php");   

?>

    <h1 class="mt-5">Clients</h1>
    <a href="addclient.php" class="btn btn-primary" style="float:right; margin-bottom:20px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
        <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
      </svg>
    </a>

    <?php 
      $query="select * from client";
      $pdostmt=$pdo->prepare($query);
      $pdostmt->execute();
    //   var_dump($pdostmt->fetch(PDO::FETCH_ASSOC));
    ?> 

  <table id="myTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Ville</th>
            <th>téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
          $count=0;
          while( $ligne=$pdostmt->fetch(PDO::FETCH_ASSOC)):
          $count++;
      ?>
        <tr>
            <td> <?php echo $ligne["idclient"];?>   </td>
            <td> <?php echo $ligne["nom"];?>        </td>
            <td> <?php echo $ligne["ville"];?>      </td>
            <td> <?php echo $ligne["telephone"];?>  </td>
            <td>
              <a href="modifclient.php?id=<?php echo $ligne["idclient"];?>" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                </svg>
              </a>

                       <!-- Button trigger modal -->
             <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $count?>" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                      <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                  </svg>
             </button>
            </td>

         </tr>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal<?php echo $count?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                vous voulez supprimer le client : <?php echo $ligne["nom"] ?> avec l'ID : <?php echo $ligne["idclient"] ?>?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a href="deleteclient.php?id=<?php echo $ligne["idclient"];?>" class="btn btn-danger">supprimer</a>
              </div>
            </div>
          </div>
        </div>

        <?php endwhile; ?>
    </tbody>
  </table>

  </div>
</main>

<?php 
    include_once("footer.php");
?>