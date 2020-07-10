$(document).ready(function() {
    
    // Function qui génère le numéro d'une chambre

    $('#chambre_batiment').change(function (){
        nbrField= $('#nbrfield').val().toString().padStart(4,'0'); // toString convertit le int récupéré en chaine et padStart ajoute les zeros par exemples en avant du chiffre ( 4 signifie la chaine et 0 le chiffre à ajouter )
        numBatiment=$('#chambre_batiment').val();
        c=numBatiment.toString().padStart(3,'0');
        $('#chambre_numchambre').attr('value',`${c}-${nbrField}`)
    });

    // generation des champs address et numchambe
    $('#etudiants_addresse').hide();
    $('#etudiants_relation').hide();
    /* let nbr=0;
    $('#etudiant_type').change(function() {
        $('#etudiants_addresse').hide();
        $('#etudiants_relation').hide();
        nbr=0;
    })
    let choix = */ 
    $('#etudiants_type').change(function() {
        $('#etudiants_addresse').hide();
        $('#etudiants_relation').hide();
        if ($('#etudiants_type').val()==="Boursier_loger") {
            alert('ok')
            $('#etudiants_relation').show();   
        }else if ($('#etudiants_type').val()==="Boursier_NonLoger" ){
            alert(ok)
            $('#etudiants_addresse').show();

            
        }
        else {
           
            $('#etudiants_addresse').show();


        }
    });


});