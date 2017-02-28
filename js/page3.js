
// This "ready" function is invoked thanks to an addEventListener below

let ready3 = function() {

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

    /////////// Fonction pour mettre à jours l'affichage
    let update = function(){

        x = parseInt($("#sprintIdList").val());

        let hdown = getdatafromurlNEW("http://localhost/ScrumManager/api/www/heuresdescendues/LaListeGeneral/"+x);
        let hdownperday = getdatafromurlNEW("http://localhost/ScrumManager/api/www/heuresdescendues/LaListeParJour/"+x);
        let hdowntotal = getdatafromurlNEW("http://localhost/ScrumManager/api/www/heuresdescendues/LaListeTotal/"+x);

        let heures = hdown[0];
        let date = hdownperday[1];
        let heuretotal = hdowntotal[0]

        let Leshdown = [];
        let LeshdownParJour = [];
        let LeshdownTotal = [];

        for (i = 1; i < heures.length; i++) {
            Leshdown.push({heure: hdown[0][i], date: hdown[1][i], projet: hdown[2][i], employe: hdown[3][i]});
         }

        for (i = 1; i < date.length; i++) {
            LeshdownParJour.push({heure: hdownperday[0][i], date: hdownperday[1][i]});
        }

        LeshdownTotal.push({total: hdowntotal[0]});

        console.log('Heure descendues convertie en objet js : ',Leshdown);
        console.log('Heure descendues groupé par jours convertie en objet js : ',LeshdownParJour);
        console.log('Heure descendues total convertie en objet js : ',LeshdownTotal);

        $('#datatable1').DataTable({
            "bDestroy": true,
            data: Leshdown,
            columns: [
                { data: 'employe' },
                { data: 'projet' },
                { data: 'heure' },
                { data: 'date' }
            ]
        });

        $('#datatable2').DataTable({
            "paging":   false,
            "info":     false,
            "bFilter":  false,
            "bDestroy": true,
            data: LeshdownParJour,
            columns: [
                { data: 'heure' },
                { data: 'date' }
            ]
        });

        $('#datatable3').DataTable({
            "paging":   false,
            "ordering":   false,
            "info":     false,
            "bFilter":  false,
            "bDestroy": true,
            data: LeshdownTotal,
            columns: [
                { data: 'total' }
            ]
        });

    };

    //Donnée a l'objet datedebut le format de date
    $('#dateDebut').datetimepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        minView : 2
    });

    //Changer l'affichage de la date si possible erreur
    function DateAujourdhui(_id){
        let _dat = document.querySelector(_id);
        let aujourdui = new Date(),
            j = aujourdui.getDate()-1,
            m = aujourdui.getMonth()+1,
            a = aujourdui.getFullYear(),
            data;

        if(j < 10){
            j = "0" + j;
        };
        if(m < 10){
            m = "0" + m;
        };
        data = a + "-" + m + "-" + j;
        _dat.value = data;
    };

    DateAujourdhui("#dateDebut");

  };

  // When the DOM is loaded, the "ready" function is triggered
  document.addEventListener("DOMContentLoaded", ready3);
