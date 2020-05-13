      <!-- partie validation -->
<?php
$dataQuiz = file_get_contents("./data/parametre.json");
$QuizData = json_decode($dataQuiz, true); 
$_SESSION['nbr_quiz'] = $QuizData['nbr_quiz'];

if (isset($_POST['ok'])) {
    $nbr_quiz = $_POST['nbr_quiz'];
    $_SESSION['nbr_quiz'] = $nbr_quiz;
    $nbr_quiz = intval($nbr_quiz);
    $QuizData['nbr_quiz'] = $nbr_quiz;
    $data_Quizz = json_encode($QuizData);
    file_put_contents("./data/parametre.json", $data_Quizz);
}

//
$file="questions";
$tab = array();
$data = file_get_contents("./data/".$file.".json");
$userData = json_decode($data, true); 
foreach ($userData as $key => $value) {
        $tab[] = $value;
} 
?>
  <!-- partie formulaire -->
<div class="liste-qcm">
    <div class="para_quiz">
        <span><?php if(isset($msg)) {echo $msg;}?></span>
        <form action="" method="POST" id="add-rep">
            <label for="" class="label_ok" style="color:silver; margin-left:80px;">Nbre de question/jeu</label>
            <input type="number"  class="input_ok" min="5" name="nbr_quiz" value="<?php echo $_SESSION['nbr_quiz'];?>" />
           <button type="submit" class="ok" name="ok" onchange="ok"> OK </button>
        </form>
    </div><br>
        <div class="quizzz">
            <div class="tab-question">
                
    <?php
        //recuperation et pagination liste question
        $tab_data_quiz=json_decode(file_get_contents('./data/questions.json'), true);
        if (isset($_GET['page'])) {
            $NumPage = $_GET['page'];
        }else{
            $NumPage=1;
        }
        
        $NbValeurTotal = count( $tab_data_quiz);
        $NbValeurParPage = 5;
        $NbPages = ceil($NbValeurTotal / $NbValeurParPage);
        $IndiceDebut = ($NumPage - 1) * $NbValeurParPage;
        $IndiceFin = $IndiceDebut + $NbValeurParPage - 1;
        $tab_data_quiz=array_slice($tab_data_quiz,$IndiceDebut,$NbValeurParPage,$IndiceFin);

                foreach($tab_data_quiz as $key => $value){
                    echo '<div class="blog_list_quiz">';
                    echo ' '.($key+1).'. '.$value['question'];
                    echo '</div>';
                    echo '<div class="bloc_quiz1">';
                    if($value['choix']=="simple"){
                        foreach($value['Reponse'] as $k =>$val){
                            echo "<input type='radio' class='checkin' name='checked_$k' ";
                            if($val=="true"){echo "checked";}  echo "/> $k <br>";
                        }
                    
                    } elseif($value['choix']=="multiple"){
                        foreach($value['Reponse'] as $k =>$val){
                            echo "<input type='checkbox' class='checkin' name='checked_$k' ";
                            if($val=="true"){echo "checked";}  echo " /> $k <br>";
                        }
                       
                    }elseif($value['choix']=="texte"){
                    echo "<input type='ReponseTexte' name='texte' value=".$value['ReponseTexte']." class='bloc-quiz' readonly><br>";
                    }
                     echo '</div>';
                }
            echo '<div class="div">';
            if ($NumPage > 1){
                $precedent= $NumPage - 1;
                echo '<a class="pré"  href="index.php?lien=accueil&menu=liste_question&page='.$precedent.'">PRECEDANT</a>';
            }
        
            if ($NumPage != $NbPages){
                $suivant= $NumPage + 1;
                echo '<a class="suiv" href="index.php?lien=accueil&menu=liste_question&page='.$suivant.'">SUIVANT</a>';
            }
        
            echo '</div>';
               
    ?>
            </div>    
        </div>
</div>