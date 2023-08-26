<?php

function test(){
    return printf("Hello world!");
}

function infoServ(){
    echo "HTTP_USER_AGENT"; echo $_SERVER['HTTP_USER_AGENT']; echo "<br />";
    echo "HTTP_HOST="; echo $_SERVER['HTTP_HOST']; echo"<br />";
    echo "DOCUMENT_ROOT="; echo $_SERVER['DOCUMENT_ROOT']; echo "<br />";
    echo "SCRIPT_FILENAME="; echo $_SERVER['SCRIPT_FILENAME']; echo "<br />";
    echo "PHP_SELF="; echo $_SERVER['PHP_SELF']; echo "<br />";
    echo "REQUEST_URI="; echo $_SERVER['REQUEST_URI']; echo "<br /> ";
    echo "action-joueur="; echo $_GET['action-joueur']; echo "<br />";
}

function write_log($mesg){
    $file_name ='logs-2048.txt';
    
    $current_date = date('Y-m-d H:i:s');
    $log_entry = "[$current_date] $mesg" . PHP_EOL;

    $file = fopen($file_name, 'a');

    if($file){
        fwrite($file, $log_entry);
        fclose($file);

    }else{
        echo "Impossible d'ouvrir le fichier logs.";
    }  
    
}

function read_log(){
    $logs = file("logs-2048.txt");
    $nbl = sizeof($logs);

    echo "il y a :" . $nbl . " lignes <br />";

    foreach($logs as $i => $line){
        if ($i > $nbl - 6)
        //logs est un tableau qui contient toutes les lignes du fichier
        // i est l'indice du tableau
        // $lines est le contenue du tableau
        echo "Ligne " . ($i + 1) . " : " . htmlspecialchars($line) . "<br /> \n";
    }
}

function incrScore(){
    global $score;

    $score = fichier_vers_score();

    //start
    if ($_GET['start'] == "start"){
        $score ++ ;
    }

    score_vers_fichier();
    
}

function score_vers_fichier(){
    $file_name = "score.txt";
    global $score;
    file_put_contents($file_name, $score);
}

function fichier_vers_score(){
    $file_name = "score.txt";
    
    return file_get_contents($file_name);
}

function nouvelle_partie(){
    global $grille;
    global $score;
    $score = 0;

    score_vers_fichier();
    
    for($i=0;$i<4;$i++){
        for($j=0;$j<4;$j++){
            $grille[$i][$j]=0;
        } 
    }

    //tirage aléatoire des nombres et des coordonnés dan la grille
    for($j=0;$j<2;$j++){
        $pos = tirage_position_vide();
        $grille[$pos[0]][$pos[1]] = 2;
    } 
}

function matrice_vers_fichier(){
    $file_name = "grille.txt";
    file_put_contents($file_name,'');

    global $grille;
    for($i=0;$i<4;$i++){
        for($j=0;$j<4;$j++){
            if($j < 3){
                file_put_contents($file_name, $grille[$i][$j]. " ", FILE_APPEND);
            }else{
                file_put_contents($file_name, $grille[$i][$j], FILE_APPEND);
            }
            
        } 
        file_put_contents($file_name, PHP_EOL, FILE_APPEND);
    }
}

function fichier_vers_matrice(){
    $file_name = "grille.txt";
    global $grille;
    $chaine = file_get_contents($file_name);
    // on remplace dans $chaine tous les sauts de ligne par des espaces
    $chaine = str_replace("\n", " ", $chaine);
    // $valeurs est un tableau 1D qui va contenir tous les nombres de la grille
    $valeurs = explode(' ', $chaine);
    $n = 0;

    for ($i = 0; $i < 4 ; $i++){
        for ($j = 0; $j < 4; $j++) {
            $grille[$i][$j] = (int) ($valeurs[$n]);
            $n++;
        }
    }
}

function affiche_case($i,$j){
    global $grille;
    $case = $grille[$i][$j];
    if ($case != 0) return $case;
    else return " "; 
}

function tirage_position_vide(){
    global $grille;
    $tab = [rand(0,3),rand(0,3)];

    while ($grille[$tab[0]][$tab[1]] != 0){
        $tab = [rand(0,3),rand(0,3)];
    }

    return $tab;
}

function grille_pleine(){
    global $grille;

    for ($i = 0; $i < 4 ; $i++){
        for ($j = 0; $j < 4; $j++) {
            if ($grille[$i][$j] == 0) return false;
        }
    }

    return true;
}

function tirage_2ou4(){
    return rand(1,2) *2;
}

function place_nouveau_nb(){
    global $grille;
    $pos = tirage_position_vide();
    $grille[$pos[0]][$pos[1]] = tirage_2ou4();
}

function decale_ligne_gauche($l){
    global $grille;
    $ligne = array_fill(0,4,0);
    $i = 0;
    for ($j = 0; $j < 4; $j++)
    {
        if ($grille[$l][$j] != 0)
        {
            $ligne[$i] = $grille[$l][$j];
            $i++;
        }
    }
    $grille[$l] = $ligne;
}

function decale_ligne_droite($l){
    global $grille;
    $ligne = array_fill(0,4,0);
    $i = 0;
    for ($j = 0; $j < 4; $j++)
    {
        if ($grille[$l][$j] != 0)
        {
            $ligne[$i] = $grille[$l][$j];
            $i++;
        }
    }
    $grille[$l] = $ligne;
}


//nouvelle_partie();
//matrice_vers_fichier();
?>





