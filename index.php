<html class="bg">

  <?php include ('header.php');


  $req = $pdo->query('SELECT numero as nummax from sprint where id = (SELECT max(id) FROM sprint)');
  $data = $req->fetch(PDO::FETCH_ASSOC);
  ?>

                              <br><br><br><br>


  <form method="POST" role="form" action="InsertionBdd\AjoutSprint.php" class="center-form">

      <div class="container">

          <!-- Input that displays the number of the new sprint -->

          <div class="row">
          <div class="col-sm-4"></div>
                  <div class="col-sm-2">
                      <div class="input-group" >
                        <span class="input-group-addon" >Sprint n°</span>
                        <input type="number" class="form-control bfh-number" name="numero" id="numero"
                        min="<?php echo $data['nummax']+1; ?>"
                        max="<?php echo $data['nummax']+1; ?>"
                        value="<?php echo $data['nummax']+1; ?>"
                        aria-describedby="basic-addon1">
                      </div>
                 </div>
          </div>

          </br></br></br>

          <!-- Twitter bootstrap's date time picker -->

          <div class="row">
          <div class="col-sm-2"></div>
              <div class='col-md-3'>
                  <div class="form-group">
                      <div class='input-group date'>
                          <input type='text' placeholder="Date de Début"  name="dateDebut" id='dateDebut' class="form-control" />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                  </div>
              </div>
              <div class='col-md-3'>
                  <div class="form-group">
                      <div class='input-group date' >
                          <input type='text' placeholder="Date de Fin"  name="dateFin" id='dateFin' class="form-control" />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                  </div>
              </div>
          </div>

          </br></br>

            <!-- Twitter bootstrap's submit buttons -->

              <div class="row">
              <div class="col-sm-4"></div>
                  <div class="col-sm-2">
                      <button type="submit" class="btn btn-success btn-block">
                        <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Créer
                      </button>
                  </div>
              </div>

      </div>

  </form>

</html>
