<?php
    include_once("main.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!empty($_GET['id'])) {
            $idarticle = $_GET['id'];
    
            $query = "DELETE FROM article WHERE idarticle = :id";
            $pdostmt = $pdo->prepare($query);
            
            try {
                $pdostmt->execute(['id' => $idarticle]);
                header("Location: articles.php");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression : " . $e->getMessage();
            }
        } else {
            echo "ID d'article non fourni.";
        }
    }
?>
