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
                                            $result = $conn->query("select id, numero from sprint order by id desc");
                                            
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
                                        $result = $conn->query("select id, prenom from employe");
                                        
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
           var getdatafromurlNEW = function(myurl)
            {
                var exist = null;
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
                console.log('coucou',exist)
            };
            
            /////////// Fonction pour mettre à jours l'affichage
            var update = function(){
            x = parseInt($("#sprintIdList").val()); 
            
            var hdown = getdatafromurlNEW("http://localhost/ScrumManager/api/www/action/gethourdown/"+x);
            var tothdown = getdatafromurlNEW("http://localhost/ScrumManager/api/www/action/gettothourdown/"+x);
            
            var hours = hdown[2];
            
            var Lehdown = [];
            var Letothdown = [];
            
          
            
            // var data = "[\n";
            // console.log('resultat pour employe : ', employes);
            // console.log('resultat pour projet ', project);
            // console.log('resultat pour heures ', hours);
            
            for (i = 1; i < hours.length; i++) {
               
                Lehdown.push({name: hdown[0][i], project: hdown[1][i], hours: hdown[2][i]});
                // data += "{\n\"name\": \"" + hdown[0][i]+"\",\n \"project\": \""+hdown[1][i]+"\",\n \"hours\": \""+ hdown[2][i] + "\"\n},\n";
             
             }
             
                Letothdown.push({tot: tothdown[0]});
            // data = data.slice(0, -1);
            // data += "\n]"
            // data = eval(data);
            // console.log(data);
            
            console.log('Une fois convertie en objet js : ',Lehdown);
            console.log('Une fois convertie en objet js : ',Letothdown);
            
            $('#datatable').DataTable({
                "bDestroy": true,
                data: Lehdown,
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
                data: Letothdown,
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