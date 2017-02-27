    <html>

        <?php
            include('header.php');
        ?>

        </br></br>

        <div class="container-fluid">

            <div class="row">

                <form method="POST" action="EditerBdd\AjoutHeureAttribution.php">

                    <div class="col-sm-3">

                        <!-- /// OBTENIR LISTE SPRINT /// -->
                        <div class="row">
                            <div  class="col-sm-11">
                                <div class="form-group">
                                    <label for="sel1">Sprint n°</label>
                                        <select class="form-control"  id="sprintIdList" onchange='update();'>
                                            <?php
                                            $result = $pdo->query("select id, numero from sprint order by id desc");

                                                            while ($row = $result->fetch_assoc()) {
                                                                          unset($id, $numero);
                                                                          $id = $row['id'];
                                                                          $numero = $row['numero'];
                                                                          echo '<option value="'.$id.'"> ' .$numero. ' </option>';
                                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>
                        </div>

                        <!-- /// OBTENIR LISTE PROJET /// -->
                       <div class="row">
                            <div  class="col-sm-11">
                                <div class="form-group">
                                    <label for="sel1">Projet</label>
                                        <select class="form-control"  name="projetid">
                                            <?php
                                                $result = $conn->query("select id, nom from projet");


                                                        while ($row = $result->fetch_assoc()) {
                                                          unset($id, $nom);
                                                          $id = $row['id'];
                                                          $nom = $row['nom'];
                                                          echo '<option value="'.$id.'"> ' .$nom. ' </option>';
                                                        }
                                            ?>
                                       </select>
                                </div>
                            </div>
                        </div>

                        <!-- /// OBTENIR LISTE EMPLOYE  /// -->
                        <div class="row">
                            <div  class="col-sm-11">
                                <div class="form-group">
                                    <?php
                                        $result = $pdo->query("select id, prenom from employe");

                                        echo "<label for=\"sel1\">Employe</label>";
                                            echo "<select class=\"form-control\"  name=\"employeid\">";
                                                while ($row = $result->fetch_assoc()) {
                                                  unset($id, $nom);
                                                  $id = $row['id'];
                                                  $prenom = $row['prenom'];
                                                  echo '<option value="'.$id.'"> ' .$prenom. ' </option>';
                                                }
                                    ?>
                                            </select>
                                </div>
                            </div>
                        </div>

                        <!-- /// Input pour le nombre d'heures d'heures  /// -->
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="input-group" >
                                    <span class="input-group-addon" >Nb Heures</span>
                                    <input type="number" class="form-control bfh-number" name="nbheure"  value=1 aria-describedby="basic-addon1" >
                                </div>
                            </div>
                        </div>

                        </br>

                        <!-- /// Bouton pour créer sprint /// -->
                        <div class="row">
                            <div class="col-md-11">
                                <button type="submit" class="btn btn-success btn-block">
                                  <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Ajouter
                                </button>
                            </div>
                        </div>

                    </div>

                </form>

                <div class="col-sm-5">

                    <h4><b>Heures attribuée(s) par Employé(e), par Projet</b></h4>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Employé(e)</th>
                                    <th>Projet</th>
                                    <th>Heure(s)</th>
                                </tr>
                            </thead>
                        </table>
                </div>

                <div class="col-sm-3">

                    <h4><b>Total heures attribués pour le sprint</b></h4>

                        <table id="datatable2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        </table>

                </div>

            </div>

        </div>

        </br>

        <script>

            /////////// Attrapper les infos de la requete sql
            let getdatafromurlNEW = function(myurl)
            {
                let exist = null;
                console.log("getdatafromurlNEW", myurl);
                $.ajax({
                    url: myurl,
                    async: false,
                    success: function(result){
                        exist = result;
                    },
                    error: function(xhr){
                        console.log("error NEW", xhr);

                    }
                });
                return (exist);
            };

            /////////// Fonction pour mettre à jour l'affichage
            let update = function(){
            x = parseInt($("#sprintIdList").val());

            let hatt = getdatafromurlNEW("http://localhost/ScrumManager/api/www/action/gethouratt/"+x);
            let tothatt = getdatafromurlNEW("http://localhost/ScrumManager/api/www/action/gettothouratt/"+x);

            let hours = hatt[2];

            let Lehatt = [];
            let Letothatt = [];

            for (i = 1; i < hours.length; i++) {
                Lehatt.push({name: hatt[0][i], project: hatt[1][i], hours: hatt[2][i]});
            }

            Letothatt.push({tot: tothatt[0]});

            console.log('Une fois heure attribue convertie en objet js : ',Lehatt);
            console.log('Une fois total heure attribue convertie en objet js : ',Letothatt);

            $('#datatable').DataTable({
                "bDestroy": true,
                data: Lehatt,
                columns: [
                    { data: 'name' },
                    { data: 'project' },
                    { data: 'hours' }
                ]
            });

            $('#datatable2').DataTable({
                "paging":   false,
                "ordering": false,
                "info":     false,
                "bFilter": false,
                "bDestroy": true,
                data: Letothatt,
                columns: [
                    { data: 'tot' }
                ]
            });

            };

            /////////// Au premier lancement de la page
            $(document).ready(function() {
                update();
            } );

        </script>

    </html>
