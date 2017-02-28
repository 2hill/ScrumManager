/* This "ready" function is invoked thanks to an addEventListener below */

let ready = function() {


              /* datatimepicker creation with a format complying with db
              inserion. Autoclose when date is selected. minView set to 2 */


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

         /* Function used to auto-fill today's date in the first date input */


            function DateAujourdhui(_id){
                let _dat = document.querySelector(_id);
                let aujourdui = new Date(),
                    j = aujourdui.getDate(),
                    m = aujourdui.getMonth()+1,
                    a = aujourdui.getFullYear(),
                    data;


           /* If days and/or month < 10 we concat with a "0"
            so that the format is valid  */



                if(j < 10){
                    j = "0" + j;
                };
                if(m < 10){
                    m = "0" + m;
                };
                data = a + "-" + m + "-" + j;
                _dat.value = data;
            };


          /*  DateAujourdhui('#dateDebut');*/


            /* Set the second datapicker at today's date +14 days */


            function DateApres(_id){
                let _dat = document.querySelector(_id);
                let Apres = new Date(),
                    j = Apres.getDate()+14,
                    m = Apres.getMonth()+1,
                    a = Apres.getFullYear(),
                    data;


             /* When odd months > 31 days update date */



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


          /* if months > 12 then switch to next year and update to next month. */

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

        /*    DateApres("#DateFin"); */

          };

/* When the DOM is loaded, the "ready" function is triggered */
document.addEventListener("DOMContentLoaded", ready);
