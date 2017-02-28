    <html>

        <?php
            include('header.php');
        ?>

        </br></br>

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-3">

                    <form method="POST" action="EditerBdd\AjoutHeureDescendue.php">

                        <!-- Displaying sprint's list -->

                        <div class="row">
                            <div class="col-sm-11">
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

                        <!--  Displaying emloyees list -->

                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group">
                                    <label for="sel1">Employe</label>
                                        <select class="form-control"  name="employeid">

                                                <?php
                                                    $result = $pdo->query("select id, prenom from employe");

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

                        <!-- Displaying projects list -->
                        <div class="row">
                            <div  class="col-sm-11">
                               <div class="form-group">
                                   <label for="sel1">Projet</label>
                                        <select class="form-control"  name="projetid">
                                            <?php

                                            $result = $pdo->query("select id, nom from projet");

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

                        <!-- Number of hours -->

                        <div class="row">
                            <div class="col-sm-11">
                                <div class="input-group" >
                                    <span class="input-group-addon" >Nb Heures</span>
                                    <input type="number" class="form-control bfh-number" name="nbheure"  min=1 value=1 aria-describedby="basic-addon1" >
                                </div>
                            </div>
                        </div>

                        </br>

                        <!--  Display hour -->

                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <input type='text' placeholder="Date de Début"  name="dateDebut" id='dateDebut' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Display button -->

                        <div class="row">
                            <div class="col-md-11">
                                <button type="submit" class="btn btn-success btn-block">
                                    <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Ajouter
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-sm-6">

                    <h4><b>Heures descendue(s) par Employé(e), par Projet, par Jour</b></h4>

                        <table id="datatable1" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>Employé(e)</th>
                                    <th>Projet</th>
                                    <th>Heure(s)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                        </table>

                </div>

                <!-- Total hours downed per day -->

                <div class="col-sm-3"  style="background-color: white;">

                    <h4><b>Heures descendue(s) par jour</b></h4>

                        <table id="datatable2" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>Heure(s)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                        </table>

                        <h4><b>Heures descendue(s) par jour</b></h4>

                        <table id="datatable3" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>total</th>
                                </tr>
                            </thead>

                        </table>

                </div>

            </div>

        </div>
    </html>
