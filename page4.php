    <html class="bg">

        <?php
            include('header.php');
        ?>

        </br>

        <div class="container">

            <div class="row">

                <!-- Button -->

                <div class="col-md-1">
                    <button  class="btn suppression btn-primary btn-block" onClick="moins1()">
                      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                    </button>
                </div>

                <!-- Display sprint's list -->

               <div  class="col-md-8">
                    <div class="form-group">
                        <select class="form-control"  id="sprintIdList" onchange='sprintIdListChanged();'>
                            <?php
                            $result = $pdo->query("select id, numero from sprint order by id desc");

                                            while ($row = $result->fetch_assoc()) {
                                              unset($id, $numero);
                                              $id = $row['id'];
                                              $numero = $row['numero'];
                                              echo '<option value="'.$numero.'"> ' .$numero. ' </option>';
                                              if (!$lastNumero)
                                                    $lastNumero = $numero;
                                                if ($numero < $numero+1)
                                                    $firstNumero = $numero;
                                            }
                                        echo "<script>
                                                var PremierSprint = $firstNumero;
                                                var DernierSprint = $lastNumero;
                                            </script>";
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Button -->

                    <div class="col-md-1">

                        <button  class="btn ajout btn-primary btn-block" onClick="plus1()">
                          <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                        </button>

                    </div>

            </div>

        </div>

        </br></br>

        <div class="container-fluid">
            <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div id="container" style="height: 600;margin-top:20px;width: 1300"></div>

                </div>
        </div>


    </html>
