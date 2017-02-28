/* This "ready" function is invoked thanks to an addEventListener below*/

let ready4 = function() {


    let createChartNEW = function(heures, dates, seuils, sprintou) {
        heures = heures.map(function(x) {
            return parseInt(x, 10);
        });

        seuils = seuils.map(function(x) {
            return parseInt(x, 10);
        });

        let x = $("#sprintIdList").val();

        console.log("Les Informations : ", heures, dates, seuils, sprintou);

        new Highcharts.Chart({
            chart: {
                renderTo: 'container'
            },
            title: {
                text: 'BurnDownChart du Sprint n°' + x
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Déplace ta souris sur les points pour avoir plus de détails' : ''
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


    /* FunctionFONCTION  used to retrieve data form the
      "Select". Then put the link in the API and put results
      in different variables
     */

    let misajour = function() {

        let x = $("#sprintIdList").val();
        bloquerbouton();
        let result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/burndownchart/getChart/" + x);
        let heures = result[0];
        let dates = result[1];
        let seuils = result[2];
        let sprintou = result[3];
        createChartNEW(heures, dates, seuils, sprintou);
        $("#sprintIdList").val(x);

    };

    /* Display previous or next sprint when button is clicked */

    /* Next */

    let plus1 = function(number) {

        let SiErreurPlus = parseInt($("#sprintIdList").val()) + 2; //si lorsque je vais au sprint suivant, il  me faut celui d'apres, donc + 2 au lieu de + 1

        x = parseInt($("#sprintIdList").val()) + 1;

        $("#sprintIdList").val(x);

        let result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/burndownchart/sprintExist/" + x);

        if (result) {
            misajour();
        } else if (!result) {
            if (x < (DernierSprint - 1)) {
                $("#sprintIdList").val(SiErreurPlus);
                misajour();
            } else {
                DemanderNouveauSprint();
            }
        }
    };

    /* Previous */

    let moins1 = function(number) {

        let SiErreurMoins = parseInt($("#sprintIdList").val()) - 2;

        x = parseInt($("#sprintIdList").val()) - 1;

        $("#sprintIdList").val(x);

        let result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/burndownchart/sprintExist/" + x); //check si le resultat est true ou false

        if (result) /* if the sprint exists => result is true */
        {
            misajour();
        } else if (!result) {
            if (x > (PremierSprint + 1)) {
                $("#sprintIdList").val(SiErreurMoins);
                misajour();
            } else {
                DemanderNouveauSprint();
            }

        }

    };

    /* Function disabling sprint change's buttons.
    used when we are ate the min/max sprint or in-between */

    let bloquerbouton = function() {

        x = parseInt($("#sprintIdList").val());

        if ((x < DernierSprint) && (x > PremierSprint)) {
            $('button.ajout').prop('disabled', false);
            $('button.suppression').prop('disabled', false);
        } else if (x == DernierSprint) {
            $('button.suppression').prop('disabled', false);
            $('button.ajout').prop('disabled', true);
        } else {
            $('button.suppression').prop('disabled', true);
            $('button.ajout').prop('disabled', false);
        }
    };

    /* If sprints does not Display: ask the user to
    update his/her*/

    let DemanderNouveauSprint = function() {

        x = parseInt(prompt("Le sprint ne peut être affiche car manque d'information, veuillez indiquer un autre sprint", x));

        if ((isFinite(x)) && (x >= PremierSprint) && (x <= DernierSprint)) {
            $("#sprintIdList").val(x);
            misajour();
        } else {
            DemanderNouveauSprint();
        }
    }

    /* Function that transform the URL*/

    let getdatafromurlNEW = function(myurl) {
        let exist = null;
        console.log("getdatafromurlNEW", myurl);
        $.ajax({
            url: myurl,
            async: false,
            success: function(result) {
                exist = result;
            },
            error: function(xhr) {
                console.log("error NEW", xhr);
                DemanderNouveauSprint();
            }
        });
        return (exist);
    };

    /*Function used when a new spint is selected from
    the droplist */


    let sprintIdListChanged = function() {

        let x = parseInt($("#sprintIdList").val());

        let result = getdatafromurlNEW("http://<?php echo $host;?>/ScrumManager/api/www/burndownchart/sprintExist/" + x);

        if (result) {
            misajour();
        } else {
            DemanderNouveauSprint();
        }

    };

  /*  misajour();   check message -> throw error when uncomemnt */

};

/* When the DOM is loaded, the "ready" function is triggered */
document.addEventListener("DOMContentLoaded", ready4)
