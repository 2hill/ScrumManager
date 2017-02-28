// This "ready" function is invoked thanks to an addEventListener below

let ready = function() {


    /*Function that catches data from the Sql request*/

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

            }
        });
        return (exist);
    };

    /*Function that update display*/

    let update = function() {
        x = parseInt($("#sprintIdList").val());

        let hatt = getdatafromurlNEW("http://localhost/ScrumManager/api/www/action/gethouratt/" + x);
        let tothatt = getdatafromurlNEW("http://localhost/ScrumManager/api/www/action/gettothouratt/" + x);

        let hours = hatt[2];

        let Lehatt = [];
        let Letothatt = [];

        for (i = 1; i < hours.length; i++) {
            Lehatt.push({
                name: hatt[0][i],
                project: hatt[1][i],
                hours: hatt[2][i]
            });
        }

        Letothatt.push({
            tot: tothatt[0]
        });

        console.log('Une fois heure attribue convertie en objet js : ', Lehatt);
        console.log('Une fois total heure attribue convertie en objet js : ', Letothatt);

        $('#datatable').DataTable({
            "bDestroy": true,
            data: Lehatt,
            columns: [{
                    data: 'name'
                },
                {
                    data: 'project'
                },
                {
                    data: 'hours'
                }
            ]
        });

        $('#datatable2').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "bFilter": false,
            "bDestroy": true,
            data: Letothatt,
            columns: [{
                data: 'tot'
            }]
        });

    };

};

// When the DOM is loaded, the "ready" function is triggered
document.addEventListener("DOMContentLoaded", ready);
