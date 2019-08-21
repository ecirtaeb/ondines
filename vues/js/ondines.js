'use strict';
console.log("ondines.js charg\u00e9");

$(function(){


    // mise en évidence de la page active dans le menu de navigation
    // récupération du paramètre page de la page active
    // puis boucle sur les liens de la barre de navigation
    // lorsqu'il y a égalité ajout de la classe pageactive et suppression sinon

    const urlParams = new URLSearchParams(window.location.href);
    //alert(urlParams);
    var urlpage = (window.location.href).split("page=");
    var pageActive = urlpage[1];
    var page =[];

    $.each( $('header nav li a'), function() {

        page = $(this).attr('href').split("page=");

        if (pageActive == page[1]) {
            $(this).addClass('pageactive');
        } else {
            $(this).removeClass('pageactive');
        }
});
/*
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
        position = $('div.icifiche').offset().top;
        localStorage.setItem('position',position);

// - puis on route vers la page qui affiche la fiche (contenu dans data-href);

        window.location.href=$(this).attr('data-href');  
    })
*/
 

});
