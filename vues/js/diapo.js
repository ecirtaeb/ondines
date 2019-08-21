'use strict';
console.log("diapo.js charg\u00e9");

$(function(){

    $('ul.diapo li:nth-child(2) img').addClass('bordure'); // mise en évidence de la première vignette 
                                                           // affichée en grand format


    //   _________________________________________________________________________________________

    //                     Mise en place évènements
    //   _________________________________________________________________________________________

    $('ul.diapo li:nth-child(n+2) img').on('click',function() {
    /* 
            lorsqu'une photo-vignette du diaporama est cliquée, elle doit prendre la place de la photo
            affichée en grand format
    */
        var imgclick = $(this).attr('src');  // récup attribut src de l'image cliquée
        var izoom = $(this).parent().attr('data-id'); // récup id de l'image cliquée (porté par son parent)
        
        var ulnode = $(this).closest('ul'); // liste <ul> cliquée        
        var imgfirst = ulnode.find('li:first-child img').attr('src'); //sauvegarde de l'image en tête....

        var id = ulnode.attr('data-id'); //récup indice du diaporama concerné
        nlisteImages[id].iZoom = izoom; // mise à jour indice de l'image zoomée
        
        ulnode.find('li:first-child img').attr('src',imgclick); // l'image cliquée est mise en tête

        ulnode.find('li:first-child p.legende').html(nlisteImages[id][izoom].photo.legende);

        $.each( ulnode.find('li:nth-child(n+2) img'), function() {
            $(this).removeClass('bordure');
        });
        
        $(this).addClass('bordure'); 

    });


    $('ul.diapo li:first-child button').on('click',function() {
    /* 
            Action suite au click "photo suivante" ou "photo précédente" pour afficher la photo correspondante
            en grand format et faire avancer la liste des vignettes
    */
        var ulnode = $(this).closest('ul'); // liste <ul> cliquée 
        var ifirst = ulnode.find('li:nth-child(2)').attr('data-id'); // indice de la première mini photo
        var id = ulnode.attr('data-id'); //récup indice du diaporama concerné
        var izoom = nlisteImages[id].iZoom;

        if ($(this).hasClass('diaposuiv')) {

            izoom < nlisteImages[id].nbImg-1 ? izoom++ : izoom = 0;
            ifirst < nlisteImages[id].nbImg-1 ? ifirst++ : ifirst = 0; // la prochaine première sera la suivante
        }

        if ($(this).hasClass('diapoprec')) {

            izoom > 0 ? izoom-- : izoom = nlisteImages[id].nbImg-1;
            ifirst > 0 ? ifirst-- : ifirst = nlisteImages[id].nbImg-1; // la prochaine première sera la précédente
        }

        nlisteImages[id].iZoom = izoom; // mise à jour indice de l'image zoomée

        var imgZoom = nlisteImages[id][izoom].photo.src;
        var legendeZoom = nlisteImages[id][izoom].photo.legende;

        afficheVignettes(ulnode,ifirst);

        ulnode.find('li:first-child img').attr('src',imgZoom);
        ulnode.find('li:first-child p.legende').html(legendeZoom);

    });
 
    //   _________________________________________________________________________________________

    //                                      FONCTIONS
    //   _________________________________________________________________________________________


    function afficheVignettes(ulnode,ifirst) {

        var i = ifirst;
        var node = ulnode;
        var id = node.attr('data-id');

        $.each( node.find('li:nth-child(n+2) img'), function() {

            $(this).attr('src', nlisteImages[id][i].photo.src);
            $(this).parent().attr('data-id', i);
            $(this).parent().children('p.legende').html(nlisteImages[id][i].photo.legende);
            i < nlisteImages[id].nbImg-1 ? i++ : i= 0;        
        });
    };

});
