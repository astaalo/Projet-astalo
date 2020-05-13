<?php
is_connect();
?>
<div class="blog-container">
    <div class="blog-header">
        <div class="blog-title">CREER ET PARAMETREZ VOS QUIZZ</div>
            <a href="index.php?statut=logout"><button type="submit" class="btn-form-2" name="deconnexion">Deconnection</button></a>
        </div>
            <div class="blog-body">
                <div class="blog-body-header">
                    <div class="avatar">
                    <a href="#"><img src="./public/images/upload/<?php echo  $_SESSION['user']['avatar']?>" alt="img"></a>
                   <?php echo $_SESSION['user']['login'];?>
                    </div>
                </div>
                    <div class="menu">
                        <ul>
                            <div class="ic-form ic-form-list"></div>
                            <li><a href="index.php?lien=accueil&menu=liste_question" target="_top">Liste Questions</a></li>
                            <div class="ic-form ic-form-ajout"></div>
                            <li><a href="index.php?lien=accueil&menu=creer_admin" target="_top">Creer Admin</a></li>
                            <div class="ic-form ic-form-list"></div>
                            <li><a href="index.php?lien=accueil&menu=liste_joueur" target="_top">Liste Joueurs</a></li>
                            <div class="ic-form ic-form-ajout"></div>
                            <li><a href="index.php?lien=accueil&menu=creer_question" target="_top">Creer Questions</a></li>
                        </ul>
                    </div>
                <!-- AFFICHAGE DES ELEMENTS DU MENU -->
                <div class="content-menu">
                    <?php
                            if (isset($_GET['menu']) && $_GET['menu']=="creer_admin") {
                                require_once('./pages/CreerCompteAdmin.php');
                            }
                            if(isset($_GET['menu']) && $_GET['menu']=="liste_question"){
                                require_once('./pages/Liste_question.php');
                            }
                            if(isset($_GET['menu']) && $_GET['menu']=="liste_joueur"){
                                require_once('./pages/Liste_joueur.php');
                            }
                            if(isset($_GET['menu']) && $_GET['menu']=="creer_question"){
                                require_once('./pages/Creer_question.php');
                            }
                    ?>
                </div>
                <!-- Fin -->
                </div>
            </div>
        </div>
    </div>

</div>
                  