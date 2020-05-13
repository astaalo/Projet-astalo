    <!--validation reponse joueur-->
<?php
    is_connect(); 
    echo 'Bienvenue ' .$_SESSION['user']['login'];
    require_once("./traitements/fonction.php"); 
    $file="questions";
    $tab= array();
    $data = file_get_contents("./data/".$file.".json");
    $userData = json_decode($data, true); 
    foreach ($userData as $key => $value) {
        $tab[] = $value;
    } 
       /* $randomStr=array();
   for ($i = 0; $i < count($tab); $i++){
       $index = rand(0, count($tab)); 
         $randomStr[] .= $tab[$index];  
     
     return $randomStr[]; 
   } */
   

if (isset($_POST['terminer'])) {
    $data_rep = array(
        "question" => $_POST["question"],
        "nbre_point" => $_POST["nbpoint"],
        "choix" => $_POST["choix"],
        "Reponse"=>"Reponse",
        "ReponseTexte"=>"ReponseTexte"
    );
    if (reponse_player($data_rep)) {
        echo "Mission accomplie ";
    }else{
        echo "Vous pouvez continuer le jeux";
    }
}
?>
<div class="bj-container">
    <div class="bj-container-header">
        <div class="image">
            <a href="#"><img src="./public/images/upload/<?php echo $_SESSION['user']['avatar'];?>" alt="img"></a>
        </div>
            <div class="bj-title"> BIENVENUE SUR LA PLATEFORME DE JEUX<br>
                JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</div>
                 <a href="index.php?statut=logout"><button type="submit" class="btn-form-2" name="deconnexion" >Deconnection</button></a>
    </div>
    <div class="bj-1-container">
        <div class="bj-2-container">
            <div class="bjj">
                <div class="bj-3-container">
                    <h4>Question 1/5:</h4><br>
                    <?php
                            //recuperation et pagination liste question
                        $tab_data_quiz=json_decode(file_get_contents('./data/questions.json'), true);
                        if (isset($_GET['page'])) {
                            $NumPage = $_GET['page'];
                        }else{
                            $NumPage=1;
                        }
                        $NbValeurTotal = count( $tab_data_quiz);
                        $NbValeurParPage = 1;
                        $NbPages = ceil($NbValeurTotal / $NbValeurParPage);
                        $IndiceDebut = ($NumPage - 1) * $NbValeurParPage;
                        $IndiceFin = $IndiceDebut + $NbValeurParPage - 1;
                        $tab_data_quiz=array_slice($tab_data_quiz,$IndiceDebut,$NbValeurParPage,$IndiceFin);
                        foreach($tab_data_quiz as $key => $value){
                                echo '<div class="blog_list_quizz">';
                                echo ' '.($key+1).'. '.$value['question'];
                                echo '<div class="nbp">' .$value['nbre_point'] .' pts'.'</div>'.'<br>';
                                echo '</div><br>';
                                echo '<div class="bloc_quiz_1">';
                                if($value['choix']=="simple"){
                                    foreach($value['Reponse'] as $k =>$val){
                                        echo "<input type='radio' class='checkine' name='radio_choix_$k' ";
                                        echo " $k <br>";
                                        if($val)  echo " $k <br>";
                                    }
                                    
                                } elseif($value['choix']=="multiple"){
                                    foreach($value['Reponse'] as $k =>$val){
                                        echo "<input type='checkbox' class='checkine' name='checked_$k' ";
                                        echo " $k <br>";
                                        if($val) echo " $k <br>";
                                    }
                                    
                                }elseif($value['choix']=="texte"){
                                echo "<input type='ReponseTexte' name='texte' class='blocquiz' ><br>";
                            }
                            echo '</div>';
                        }
                            echo '<div class="div">';
                                if ($NumPage > 1){
                                    $precedent= $NumPage - 1;
                                    echo '<a class="pre"  href="index.php?lien=jeux&page='.$precedent.'">PRECEDANT</a>';
                                }
                    
                                if ($NumPage != $NbPages){
                                    $suivant= $NumPage + 1;
                                    echo '<a class="sui" href="index.php?lien=jeux&page='.$suivant.'">SUIVANT</a>';
                                }
                                if($NumPage == $NbPages){
                                    $termine= $NumPage=$NbPages ;
                                    echo '<a class="ter" href="index.php?lien=jeux&page='.$termine.' name="terminer" ">TERMINE</a>';
                                }
                    
                            echo '</div>';
                        
                    ?>
            </div>
            </div>
            <div class="bloc_score">
                <button type="submit" class="title-score" name="click1" onclick="cacher1()">Top Scores </button>
                    <button type="submit" class="title-score" onclick="cacher2()">Meilleur Score </button>
                            <table  class="tab-score">
                                <thead>
                                    <tr>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                    <?php
                                        list_meilleur_score();
                                    ?>           
            </div>
        </div>
    </div>
</div>


