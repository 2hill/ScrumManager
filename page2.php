<html>

    <?php
        include('header.php');
    ?>

    </br></br>

    <div class="container-fluid">

        <div class="row">

            <form method="POST" action="EditerBdd\AjoutHeureAttribution.php">

                <div class="col-sm-3">

                    <!-- Retrieve the lists of sprints -->

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

                    <!-- Retrieve project's list -->

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

                    <!-- Retrieve employees's list -->

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

                    <!-- Input for the number of hours -->

                    <div class="row">
                        <div class="col-sm-11">
                            <div class="input-group" >
                                <span class="input-group-addon" >Nb Heures</span>
                                <input type="number" class="form-control bfh-number" name="nbheure"  value=1 aria-describedby="basic-addon1" >
                            </div>
                        </div>
                    </div>

                    </br>

                    <!-- Buttons for creating sprints  -->

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

</html>
