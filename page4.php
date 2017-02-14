    <html class="bg">

        <?php
            include('header.php');
        ?>
        
        </br>
        
        <div class="container">
        
            <div class="row">
            
                <!-- /// Bouton /// -->
                <div class="col-md-1"> 
                    <button  class="btn suppression btn-primary btn-block" onClick="moins1()">
                      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                    </button>
                </div>
                
                <!-- ///  AFFICHER LISTE SPRINT  /// -->
               <div  class="col-md-8">
                    <div class="form-group">
                        <select class="form-control"  id="sprintIdList" onchange='sprintIdListChanged();'>
                            <?php
                            $result = $conn->query("select id, numero from sprint order by id desc");
                            
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
                                                console.log('Le premier sprint a pour numero : ', $firstNumero);
                                                console.log('Le dernier sprint a pour numero : ', $lastNumero);
                                            </script>";
                            ?>
                        </select>
                    </div>
                </div>
                    
                <!-- /// BOUTON -> /// -->
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
                    
                        <script>
                     
                            var createChartNEW = function(heures, dates, seuils, sprintou){
                                heures = heures.map(function (x) { 
                                    return parseInt(x, 10); 
                                });
                            
                                seuils = seuils.map(function (x) { 
                                    return parseInt(x, 10); 
                                });
                                
                                var x = $("#sprintIdList").val();
                                
                                console.log("Les Informations : ",heures, dates, seuils, sprintou);
                                
                                new Highcharts.Chart({
                                    chart: {
                                     renderTo: 'container'
                                    },
                                    title:{
                                            text: 'BurnDownChart du Sprint n°'+x
                                    },
                                    subtitle:{
                                            text: document.ontouchstart === undefined ?
                                           'Déplace ta souris sur les points pour avoir plus de détails': ''
                                    },
                                    yAxis: {
                                            min: 0,
                                            title: {
                                            text: 'Heures'
                                            }
                                    },
                                    xAxis: {
                                        type: 'datetime',
                                        categories: dates
                                    },
                                    series: [{
                                        name: 'Heures Restantes',
                                        data: heures
                                    },
                                    {
                                        name: 'Seuil',
                                        data: seuils,
                                        color: 'red'
                                    }
                                    ]
                                });
                            };
                            
                        </script>
                </div>
        </div>
        
        
        
        
        
        <script>

            /// FONCTION POUR RECCUPERER LES DONNEES DEPUIS LE SELECT, LE METTRE DANS LE LIENS DE L'API ET LE METTRE LE RESULTAT DANS LES DIFFERENTES VARIABLE ///
            var misajour = function(){
                        var x = $("#sprintIdList").val();
                        var result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/action/getChart/"+x);
                        var heures = result[0];
                        var dates = result[1];
                        var seuils = result[2];
                        var sprintou = result[3];
                        createChartNEW(heures, dates, seuils, sprintou);
                        $("#sprintIdList").val(x);  
            };
        
            /// Lors de l'appuis sur le bouton pour voir le sprint suivant ///
            var plus1 = function(number){
                
                var SiErreurPlus = parseInt($("#sprintIdList").val()) + 2; //si lorsque je vais au sprint suivant, il  me faut celui d'apres, donc + 2 au lieu de + 1 
                
                x = parseInt($("#sprintIdList").val()) + 1;
                if (x > DernierSprint){
                    x -= 1;
                    }
                
                $("#sprintIdList").val(x);
                
                var result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/action/sprintExist/"+x);
                
                if (result)
                {
                    misajour();    
                }
                
                else if( ( !result ) && ( x < (DernierSprint - 1) ) )
                { 
                    console.log('Problème sur le sprint à afficher, + , je vais donc directement au : ', SiErreurPlus);
                    $("#sprintIdList").val(SiErreurPlus);
                    misajour();   
                }
                
                bloquerbouton();
                
            };
            
            //////////////////////////////////////////////////////////////////
            var moins1 = function(number){
                
                var SiErreurMoins = parseInt($("#sprintIdList").val()) - 2;
                
                x = parseInt($("#sprintIdList").val()) -1;
                if (x < PremierSprint){
                    x += 1
                    }
                
                $("#sprintIdList").val(x);
               
                var result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/action/sprintExist/"+x);
                    
                 
                if (result) //si le sprint fonctionne
                {
                    misajour();  
                }
                
                else if( ( !result ) && ( x > (PremierSprint + 1) ) )
                {
                   console.log('Problème sur le sprint à afficher, - , je vais donc directement au : ', SiErreurMoins);
                   $("#sprintIdList").val(SiErreurMoins);
                   misajour();  
                }
                
                
                bloquerbouton();

            };
            
            var bloquerbouton = function(){
                
               if ((x < DernierSprint) && (x > PremierSprint)){
                   $('button.ajout').prop('disabled', false);
                   $('button.suppression').prop('disabled', false);
                    }
                    
                else if ( x == DernierSprint )
                {
                   $('button.ajout').prop('disabled', true);
                }
                
                else {
                     $('button.suppression').prop('disabled', true); 
                    }
            };
           
            /// FONCTION POUR TRANSFORMER L'URL COMME IL FAUT ///
            var getdatafromurlNEW = function(myurl)
            {
                var toret = null;
                console.log("getdatafromurlNEW", myurl);
                $.ajax({
                    url: myurl,
                    async: false,
                    success: function(result){
                        toret = result;
                    },
                    error: function(xhr){
                        console.log("error NEW", xhr);
                        alert("Le sprint selectionner ne peut être affiché car manque d'info. Veuillez en selectionner un autre. Merci1");
                    }
                });
                return (toret);
                console.log('coucou',toret)
            };
            
            //Fonction lorsque l'on choisie un nouveau sprint depuis la liste deroulante
            var sprintIdListChanged = function(){
                
                
                
                var x = $("#sprintIdList").val();
                
                var result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/action/sprintExist/"+x);
                    
                if (result)
                {
                    misajour();
                }
                else
                {
                    alert("Le sprint selectionner ne peut être affiché car manque d'info. Veuillez en selectionner un autre. Merci2.");
                    x = PremierSprint;
                    $("#sprintIdList").val(x);  
                    misajour();
                }
                
                console.log('bim1');
                bloquerbouton();
                console.log('bim2');
            };
            
            var result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/action/getChart/0");
                  
            if (result != null)
            {
                misajour();
            }
            
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
        </script>

    </html>