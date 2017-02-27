

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
