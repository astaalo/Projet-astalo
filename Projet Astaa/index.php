<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./public/css/style.css"/>
        <link rel="StyleSheet" type="text/css" href="./public/css/CompteUser.css"/>
		<title>ACCUEIL</title>
    </head>
        <body>
        <div class="header">
            <div class="logo"></div>
            <div class="header-text">Le plaisir de jouer</div>
        </div>
        <div class="content">
        <?php
        session_start();
        require_once("./traitements/fonction.php");

        if(isset($_GET['lien'])){
            switch ($_GET['lien']) {
                case 'accueil':
                    require_once("./pages/admin.php");
                    break;
                
                case 'jeux':
                    require_once("./pages/jeux.php");
                    break; 
                case 'inscription':
                    require_once('./pages/CreerCompteUser.php');
                    break;
                case 'Inscription Reussie':
                    require_once('./pages/Liste_joueur.php');
            }
        }else{
            if(isset($_GET['statut']) && $_GET['statut']==="logout"){
                deconnection();
            }
            require_once("./pages/connexion.php");
            
        }
            
        ?>
        </div>
    </body>
    </html>