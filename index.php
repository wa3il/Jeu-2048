<?php
    session_start(); // démarre une session
    ini_set('display_errors',1);//affichage des erreurs
    ini_set('display_startup_errors',1);//affichage des erreurs
    error_reporting(E_ALL);//affichage des erreurs
    
    global $grille;
    global $score;
    $score = 0;

    require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 	<title>
 	 <?php echo "2048"; ?>
 	</title>
</head>
<body> 
    <?php
        if(isset($_GET['start'])) nouvelle_partie();
        else fichier_vers_matrice();

        //Si le joueur fais une actions alors on écris dans les logs l'actions du joueur
        if (isset($_GET['action-joueur'])){
            $message_action = " le joueur à appuyé sur la touche " . $_GET['action-joueur'];
            write_log($message_action);

            if(!grille_pleine()) place_nouveau_nb();
            else echo "perdu";
        }       
    ?>
    <div class="main-page">

        <h1>Jeu du 2048</h1>

        <?php infoServ();?>

        <form name="jeu-2048" method="get" action="index.php">
            <button  class="button-74" type="submit" name="start" value="start" >start</button>
            <button class="button-74" type="reset" name="reset">reset</button>
        

            <div class="score">
                <span>score : <?php echo $score; ?></span>
            </div> 

            <div class="main-game">            
                <table>
                    <?php 
                        for ($i = 0; $i < 4 ; $i++){
                            echo "<tr>";
                            for ($j = 0; $j < 4; $j++) {
                                echo "<td> " . affiche_case($i,$j)  ."</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </table>
                
            </div>

            <div class="controle">
                <button type="submit" name="action-joueur" value="gauche" >
                    <img src="./image/arrow_back_FILL0_wght400_GRAD0_opsz48.png">
                </button>
                <button type="submit" name="action-joueur" value="haut" >
                    <img src="./image/arrow_upward_FILL0_wght400_GRAD0_opsz48.png">
                </button>
                <button type="submit" name="action-joueur" value="droite" >
                    <img src="./image/arrow_forward_FILL0_wght400_GRAD0_opsz48.png">
                </button>
                <button type="submit" name="action-joueur" value="bas" >
                    <img src="./image/arrow_downward_FILL0_wght400_GRAD0_opsz48.png">
                </button>
            </div>
            


        </form>
        
        <div class="regle-du-jeu">
            <p>Le gameplay du jeu repose sur l'utilisation des touches fléchées du clavier (ou de la fonction tactile sur tablettes et smartphones) pour déplacer les tuiles vers la gauche, la droite, le haut ou le bas. Lors d'un mouvement, l'ensemble des tuiles du plateau sont déplacés dans la même direction jusqu'à rencontrer les bords du plateau ou une autre tuile sur leur chemin. Si deux tuiles, ayant le même nombre, entrent en collision durant le mouvement, elles fusionnent en une nouvelle tuile de valeur double (par ex. : deux tuiles de valeur « 2 » donnent une tuile de valeur « 4 »). À chaque mouvement, une tuile portant un 2 ou un 4 apparaît dans une case vide de manière aléatoire.
                Le jeu, simple au début, se complexifie de plus en plus, du fait du manque de place pour faire bouger les tuiles, et des erreurs de manipulation possibles, pouvant entraîner un blocage des tuiles et donc la fin du jeu à plus ou moins long terme, selon l’habileté du joueur.</p>
        </div>
  
    </div> 
    <footer>
        <a href="index.php">Jeu-2048</a>
        <a href="log-2048.php"> Les logs du jeu </a>
        <a href="http://perso.univ-lyon1.fr/olivier.gluck/supports_enseig.html#LIFASR2" target="_blank">lifasr2</a>
        <a href="https://fr.freepik.com/vecteurs-libre/neon-direction-fleche-perspective_6024598.htm#query=background%20gaming&position=5&from_view=keyword&track=ais">Image de starline sur Freepik"></a>
    </footer>  
</body>

</html>

<?php 
    matrice_vers_fichier();
?>