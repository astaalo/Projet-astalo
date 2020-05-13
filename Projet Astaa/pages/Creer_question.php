<?php
require_once("./traitements/fonction.php");
// require_once("./traitements/const.php");
if (isset($_POST['btn'])) {

    $data_quiz = array(
        "question" => $_POST["question"],
        "nbre_point" => $_POST["nbpoint"],
        "choix" => $_POST["choix"],
        "Reponse"=>"Reponse",
        //"ReponseTexte"=>"ReponseTexte"
    );

    // Enregistrement et la verification des questions
    if (enregistrer_quiz($data_quiz)) {
        echo "Enregistrement question Reussie ";
    } else {
        echo "Oups echec Enregistrement question";
    }
}
?>
<div class="droite-qcm">
    <div class="para"> PARAMETRER VOTRE QUESTION</div><br>
    <div class="quizz">
        <form method="POST" action="" id="add-name" enctype="multipart/form-data" >
            <div class="qcm">
                <label>Questions</label>
                <input name="question" error="error-1"></input>
                <div class="error-form" id="error-1"></div>
            </div><br><br>
            <div class="nbrpoint">
                <label for="">Nbre de Points</label>
                <input class="nbpoint" type="number" error="error-2" name="nbpoint">
                <div class="error-form" id="error-2"></div>
            </div><br><br>

            <div class="trep">
                <label for="" error="error-3">Type de Reponse</label>
                <select id="choix" name="choix" onchange="choisir();">
                    <option>Donnez le type de Reponse</option>
                    <option value="texte">choix texte</option>
                    <option value="simple">Choix Simple</option>
                    <option value="multiple">choix multiple</option>
                    <div class="error-form" id="error-3"></div>
                </select> <br><br>
                <input type="button" class="btn-add" id="ajout" onclick="addInputs()" value="+">
                <!-- <img src="./public/images/ic-ajout-reponse.png" alt="">
                </input> -->
            </div>
            <div class="inputs" id="inputs">
            </div>
            <input type="hidden" name="nbrep" id="nbrep" />
            <button type="submit" class="btn-enrg" name="btn">Enregistrer</button> 
        </form>
    </div>
</div>
<!--generation champs-->
<script>
    var nbr_row = 0;

    function choisir() {
        document.getElementById('inputs').innerHTML = "";
        nbr_row = 0;
        if (document.getElementById('ajout').disabled) {
            document.getElementById('ajout').disabled = false;
        }
    }

    function addInputs() {
        nbr_row += 1;
        document.getElementById('nbrep').value = nbr_row;
        var choix = document.getElementById('choix').value;
        var Divajouter = document.getElementById('inputs');
        var newInput = document.createElement('div');
        newInput.setAttribute('class', 'row');
        newInput.setAttribute('id', 'row_'+ nbr_row);
        if (choix === "simple") {
            newInput.innerHTML = `<label for="" class="rep1">Reponse${nbr_row}</label>
                    <input type="text"  name="Reponse${nbr_row}" id="Reponse${nbr_row}" class="rep_input">
                    <input type="radio" name="choix_radio"  class="radio" value="${nbr_row}" >
                    <button type="button" class="btn-del" onclick="deleteInputs(${nbr_row});" >
                        <img src="./public/images/ic-supprimer.png" alt="img"> 
                    </button><br><br>`;
        } else if (choix === "multiple") {
            newInput.innerHTML = `<label for="" class="rep1">Reponse${nbr_row}</label>
                    <input type="text" name="Reponse${nbr_row}" id="Reponse${nbr_row}" class="rep_input">
                    <input type="checkbox" name="checked" value="${nbr_row}"  class="check" >
                    <button type="button" class="btn-del" onclick="deleteInputs(${nbr_row});" >
                        <img src="./public/images/ic-supprimer.png" alt="img"> 
                    </button><br><br>`;
        } else if (choix === "texte") {
            newInput.innerHTML = `<div class="rep"><label for="">Reponse${nbr_row}</label>
                    <input type="text" name="ReponseTexte" id="Reponse${nbr_row}" class="rep_input"></div>
        `;
            document.getElementById('ajout').disabled = true;
        }

        Divajouter.appendChild(newInput);
    }

    function deleteInputs(n) {
        var del = document.getElementById('row_' + n);
        del.remove();
    }

    //validation question
    const inputs = document.getElementsByTagName("input");
    for (input of inputs) {
        input.addEventListener("keyup", function(e) {
            if (e.target.hasAttribute("error")) {
                var idDivError = e.target.getAttribute("error");
                document.getElementById(idDivError).innerText = "";
            }
        })
    }
    document.getElementById("add-name").addEventListener("submit", function(e) {
        const inputs = document.getElementsByTagName("input");
        var error = false;
        for (input of inputs) {
            if (input.hasAttribute("error")) {
                var idDivError = input.getAttribute("error");
                if (!input.value) {
                    document.getElementById(idDivError).innerText = "Champ obligatoire"
                    error = true
                }

            }

        }
        if (error) {
            e.preventDefault();
            return false;
        }

    })
</script>