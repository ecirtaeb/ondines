"use strict";
console.log('data.js chargé');

//------------------------------------------------
// Variables globales utiles à la page d'accueil
//________________________________________________

var position = 0;


//       >>>   pour les diaporamas

var listeImages = [];
var nlisteImages = [];
var idImg = 0;
var iImgZoom = 0;

/*
$.each( $('ul.diapo li:nth-child(n+2) img'), function(key, value) {

  	var image = {
	src : $(this).attr('src'),
	legende : $(this).parent().children('p.legende').html()
	};
 	listeImages[idImg] = image;

 	idImg++;
});

var nbImg = idImg;
*/

$.each( $('ul.diapo'), function(key, value) {

	var id = $(this).attr('data-id');
	idImg = 0;
	nlisteImages[id] = [];

	$.each( $(this).find('li:nth-child(n+2) img'), function(key, value) {

		nlisteImages[id][idImg] = { 
		photo : {}
		};
		
		var legende = "legende";
		if ( $(this).next('p.legende') ) {
			legende = $(this).next('p.legende').text();
		}

	  	var image = {
		src : $(this).attr('src'),
		legende : legende
		};

	 	nlisteImages[id][idImg].photo = image;

	 	idImg++;
	});
	nlisteImages[id].nbImg = idImg;
	nlisteImages[id].iZoom = 0;
});	
