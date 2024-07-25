<?php
    include_once("main.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!empty($_GET['id'])) {
            $idclient = $_GET['id'];
    
            $query = "DELETE FROM client WHERE idclient = :idclient";
            $pdostmt = $pdo->prepare($query);
            
            try {
                $pdostmt->execute([':idclient' => $idclient]);
                header("Location: clients.php");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression : " . $e->getMessage();
            }
        } else {
            echo "ID du client non fourni.";
        }
    }
?>
