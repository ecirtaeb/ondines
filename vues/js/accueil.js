'use strict';
console.log("accueil.js charg\u00e9");

$(function(){

    // si une position est stockée on revient d'une page précédente, on se re positionne
    //
    position = localStorage.getItem('position');

    if (position) {

        $("html, body").animate({ scrollTop: position }, "fast"); 
        localStorage.removeItem('position');

    }

    // si des dates de période sont alimentées les boutons "effacer les dates" doivent être visibles
    if ( $("input#du").val() && $("input#au").val() ) {

        oterClass('a.btnrazdat','hidden');

    }

    $('ul.diapo li:nth-child(2) img').addClass('bordure'); // mise en évidence de la première vignette 
                                                           // affichée en grand format


    //   _________________________________________________________________________________________

    //                      Actions déclenchant une requête AJAX
    //   _________________________________________________________________________________________


    $('form#recherche button').on('click',function(event) {
// fonction appelée lorsqu'une recherche de dispo est lancée

        event.preventDefault();
        var msgOk = '<i class="fas fa-search"></i>   Recherche en cours';
        var msgKo = '';

        oterClass('h3#icimsg','attente');


        if ( $("input#du").val() && $("input#au").val() ) {
            // si les 2 dates sont renseignées on contrôle

            var datdeb = $.datepicker.parseDate('dd-mm-yy', $('input#du').val());
            var datfin = $.datepicker.parseDate('dd-mm-yy', $('input#au').val());
      
            if ( datdeb > datfin ) {
        
                msgKo = 'Période demandée du ' + $('input#du').val() + ' au ' + $('input#au').val();
                msgKo += '\n Ces dates sont incoh\u00e9rentes merci d\'indiquer une autre p\u00e9riode';
                $( "input#au, input#du"  ).datepicker( "setDate", null );
                $('#icimsg').html(msgKo);

                ajouterClass('a.btnrazdat','hidden');
           
            } else {

                $('#icimsg').html(msgOk);
                oterClass('#icimsg','rouge');
                ajouterClass('h3#icimsg','attente');
                ajouterClass('a.btnrazdat','hidden');
            }

        } else {

            msgKo = infoErreur("110");

            ajouterClass('a.btnrazdat','rouge');

            ajouterClass('#icimsg','rouge');

           $('#icimsg').html(msgKo);


        }

// Requête Ajax retournant les logements disponibles pour la période demandée
        if ( msgKo === '') {

            var url = "routeur?page=rechercheDispoPeriode";
            
            var param = {   datdeb: $('input#du').val(),
                            datfin: $('input#au').val()};

            $.get(  url, 
                    param,
                    function(html){

                        if (html.substring(0,5) == "error") {

                            ajouterClass('#icimsg','rouge');
                            $('#icimsg').html(infoErreur(html.substring(5,8)));

                        } else {

                            $('div#listlogements').html(html);
                            $('#icimsg').html('');
                            $('html,body').animate({scrollTop: $("#logements").offset().top}, 'slow');
                            oterClass('a.btnrazdat','hidden');
                        }

                //re-déclaration de l'événement click sur les éléments modifiés
                        $('td.detail, td li.detail, td li.dispo').on('click', function() {

                    // Lorsqu'un logement est sélectionné :
                    // - on sauvegarde dans la liste de la page d'accueil (pour se repositionner au retour)
                            position = $('div#listlogements').offset().top;
                            localStorage.setItem('position',position);
                    // - puis on route vers la page qui affiche la fiche (contenu dans data-href);
                            window.location.href=$(this).attr('data-href');  
                        })

                    },
                    'html'
            );

        }

    });


    $('a.btnrazdat').on('click',function(event) {

        console.log("effacer date");
    // on efface les dates, il faut afficher tous les appartements (page accueil)    
        $("input#au, input#du").datepicker( "setDate", null );
        $("input#au, input#du").val('');

    // Requête Ajax retournant tous les logements disponibles

        $("html, body").animate({ scrollTop: 1200 }, "slow");
        var url = "routeur?page=rechercheDispoTout";
        var param = "";
        
        $.get(  url, 
                param,
                function(html){

                    $('div#listlogements').html(html);
                    $('#icimsg').html('');
                    ajouterClass('a.btnrazdat','hidden');

            //re-déclaration de l'événement click sur les éléments modifiés
                    $('td.detail, td li.detail, td li.dispo').on('click', function() {

                // Lorsqu'un logement est sélectionné :
                // - on sauvegarde le tarif du séjour s'il y a

                        var prix = $(this).closest('tr').find('p.prix').text();

                        if ( prix ) {

                            localStorage.setItem('prix',prix);

                        } else {

                            localStorage.removeItem('prix');
                        }
                // - et sa position dans la liste de la page d'accueil (pour se repositionner au retour)
                        position = $('div#listlogements').offset().top;
                        localStorage.setItem('position',position);
                // - puis on route vers la page qui affiche la fiche (contenu dans data-href);
                        window.location.href=$(this).attr('data-href');  
                    })
                
                },
                'html'
        );

    });


    //   _________________________________________________________________________________________

    //                      Autres actions 
    //   _________________________________________________________________________________________


    $('td.detail, td li.detail, td li.dispo').on('click', function() {

// Lorsqu'un logement est sélectionné :

// - on sauvegarde le tarif du séjour s'il y a

        var prix = $(this).closest('tr').find('p.prix').text();

        if ( prix ) {

            localStorage.setItem('prix',prix);

        } else {

            localStorage.removeItem('prix');
        }

// - et sa position dans la liste de la page d'accueil (pour se repositionner au retour)
        position = $('div#listlogements').offset().top;
        localStorage.setItem('position',position);

// - puis on route vers la page qui affiche la fiche (contenu dans data-href);

        window.location.href=$(this).attr('data-href');  
    });


    $('div#nav div:first-child').on('click', function() {

        $(this).addClass("none1");
        $('div#nav nav').removeClass("none1");

    });

    $('div#nav nav div').on('click', function() {

        $('div#nav nav').addClass("none1");
        $('div#nav div:first-child').removeClass("none1");

    });



    //   _________________________________________________________________________________________

    //                                      FONCTIONS
    //   _________________________________________________________________________________________


    function ajouterClass(selecteur,classe) {


        $.each( $(selecteur), function() {

            if ( !$(this).hasClass(classe) ) {
                $(this).addClass(classe);
            }        
        });
    };

    function oterClass(selecteur,classe) {

        $.each( $(selecteur), function() {
            if ( $(this).hasClass(classe) ) {
                $(this).removeClass(classe);
            }        
        });
    };


// la fonction "infoErreur" retourne le libellé correspondant au code passé en paramètre
    function infoErreur(code) {

        var msg = "";
        switch (code) {
            case '110':
                msg = "Merci de saisir une p\u00e9riode (date d\u00e9but ET date de fin)";
                break;
            case '120':
                msg = "Ces dates sont incoh\u00e9rentes merci d\'indiquer une autre p\u00e9riode";
                break;
            case '130':
                msg = "Pour cette p\u00e9riode location uniquement de samedi \u00e0 samedi, merci de modifier vos dates";
                break;           
            case '140':
                msg = "2 nuits minimum, merci de modifier vos dates";
                break;
            case '200':
                msg = "Nous n'avons plus de disponibilit\u00e9s pour ces dates";
                break;
            default:
                msg = "Merci de nous contacter pour ces dates"
                break;
        }

        return msg;
    };
});
