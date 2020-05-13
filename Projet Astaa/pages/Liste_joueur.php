<div class="title-player">LISTE DES JOUEURS
        <div class="list-player">
            <table class="tab-joueurs" >
                <thead >
                    <tr>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Score</th>
                    </tr>
                </thead>
            <?php
               $data_json=file_get_contents('./data/utilisateurs.json');
                $tab_data=json_decode($data_json, true);
                foreach($tab_data as $value){
                    if($value['role']=="joueur"){
                        $tab_player[]=$value;
                            //var_dump($tab_player);   
                         }
                            }
                    pagination($tab_player);
            ?>
            </table>          
        </div>     
</div>
