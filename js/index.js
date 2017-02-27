// This "ready" function is invoked thanks to an addEventListener below

const ready = function() {



              /*Creation du format des datatimepicker avec un format ok pour
             l'insertion dans la bdd, un close auto lorsque l'on choisie la date
              et un view a 2 car on a pas besoin de plus. */

             $('#dateDebut').datetimepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    minView : 2
             });
             $('#dateFin').datetimepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    minView : 2
             });

            //Fonction pour auto remplir la date d'aujourd'hui dans le premier input date
            function DateAujourdhui(_id){
                let _dat = document.querySelector(_id);
                let aujourdui = new Date(),
                    j = aujourdui.getDate(),
                    m = aujourdui.getMonth()+1,
                    a = aujourdui.getFullYear(),
                    data;

                //si jour ou mois inferrieur a 10 genre "1" il doit avoir un "0" avant pour que le date soit dans un format valide.
                if(j < 10){
                    j = "0" + j;
                };
                if(m < 10){
                    m = "0" + m;
                };
                data = a + "-" + m + "-" + j;
                _dat.value = data;
            };
            DateAujourdhui('#dateDebut');

            //Mettre le deuxieme datapicker à 14jours après la date d'aujourd'hui.
            function DateApres(_id){
                let _dat = document.querySelector(_id);
                let Apres = new Date(),
                    j = Apres.getDate()+14,
                    m = Apres.getMonth()+1,
                    a = Apres.getFullYear(),
                    data;

                //Si l'on dépasse 31jours avec le bon mois, faire le calcule.
                if((m == 1) || (m == 3) || (m == 5) || (m == 7) || (m == 9) || (m == 11) ) {
                    if(j > 31){ console.log('Jour avant le changement : ' + j + '  car "jour du début" + 27'); console.log('Mois avant le changement : ' + m + ' (impair donc 31 jours compris)');
                    console.log('-- Passage au prochain mois --');
                        j -= 31; console.log('Jour après le changement : ' + j )
                        m += 1;   console.log('Mois après le changement : ' + m + '  (soit +1 car nouveau mois)')
                    }
                }
                    else{
                       if(j > 30){  console.log('Jour avant le changement : ' + j ); console.log('Mois avant le changement : ' + m + ' (pair donc 30 jours compris)');
                           console.log('-- Passage au prochain mois --');
                        j -= 30; console.log('Jour après le changement : ' + j )
                        m += 1;  console.log('Mois après le changement : ' + m + '  (soit +1 car nouveau mois)')
                    };
                };

                //si mois dépasse 12 alors passer à l'année prochaine et remettre le bon mois.
                if(m > 12){
                  m -= 12;
                  y += 1;
                };

                if(j < 10){
                    j = "0"+j;
                };

                if(m < 10){
                    m = "0"+m;
                };

                data = a + "-" + m + "-" + j;
                _dat.value = data;
            };

            DateApres("#DateFin");

          };

// When the DOM is loaded, the "ready" function is triggered
document.addEventListener("DOMContentLoaded", ready);
