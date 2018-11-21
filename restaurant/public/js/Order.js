'use strict';
	document.addEventListener('DOMContentLoaded',function(){
		var tableau;
		var panier;
		var trash;
		var dropDownMeal = document.querySelector("#Name_meal");
		var description = document.querySelector(".description");
		var quantite = document.querySelector("input[name='quantite']");
		var boutonAjouter = document.querySelector("#ajouterCommande");
		var tableHtmlDuRecap = document.querySelector("#recap");
		
//function actualiser description


		function Actualiserdescription(idMeal) {
		var data= "id="+ idMeal;
		ajaxPost('index.php?action=orderIdMeal&'+data,'',function(reponse){
		description.innerHTML = reponse;
		},false);
		//function ajaxGet(url, callback);
		//function ajaxPost(url, data, callback, isJson);
	}

	function actualiserRecap(){
		panier = 0;
		tableHtmlDuRecap.innerHTML = "";
			for (var i = 0; i < tableau.length; i++) { // function pour afficher la liste dans le tableau ici 
			tableHtmlDuRecap.innerHTML += "<tr><td>"+tableau[i].quantite +"</td><td>"+tableau[i].nom +"</td><td>"+tableau[i].prixUnitaire +" €</td><td>"+tableau[i].prixTotal +" €</td><td><i class='fas fa-trash-alt' id="+i+"></i></td>";

			panier += tableau[i].prixTotal;
			}
			tableHtmlDuRecap.innerHTML += "</tr><tr><td></td><td></td><td><strong>Panier<strong> : </td> <td>"+ panier +"</td></tr>";
	}

	function rajoutEventListenerALiconePoubelle(){///////////////////////

		var trash = document.querySelectorAll('.fa-trash-alt');
		if (trash) { 
		//le for //////////
		for (var i=0;i <= trash.length;i++) {
			//eventlistener////
		trash[i].addEventListener('click',function(e){
		var id = e.id;
		tableau.splice(id,1);
		localStorage.setItem('liste',JSON.stringify(tableau));
		actualiserRecap();
			});
			/////////////////////////////////////////////////////////////////////////////////////////////////////////
		} ////////////////////////////////////////////////////////////////////////////////////////////////////
	}/// la fin de la condition
	}//la fin de la function

	dropDownMeal.addEventListener('change',function(e){
		var idMeal = e.target.value;
		Actualiserdescription(idMeal);
	})


	boutonAjouter.addEventListener('click',function(e){
		var quantiteWow = Number(quantite.value);

		var nomAlimentSelectionne = document.getElementById('Name_meal').selectedOptions[0].text;

		var prixUnitaire = document.querySelector("#prix_unitaire").textContent;

		var prixTotal = quantiteWow * prixUnitaire;

		var commande = {quantite:quantiteWow,nom:nomAlimentSelectionne,prixUnitaire:prixUnitaire,prixTotal:prixTotal};
		tableau.push(commande);
		localStorage.setItem('liste',JSON.stringify(tableau));
		tableau = JSON.parse(localStorage.getItem('liste'));
		rajoutEventListenerALiconePoubelle();
	})


	if (!localStorage.getItem('liste')) {
		tableau = [];
		}else {
		tableau = JSON.parse(localStorage.getItem('liste'));
		actualiserRecap();
		rajoutEventListenerALiconePoubelle();
	}

})