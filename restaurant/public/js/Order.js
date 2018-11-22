'use strict';
document.addEventListener('DOMContentLoaded', function() {
	var tableau;
	var panier;
	var trash;
	var boutonAjouter = document.querySelector("#ajouterCommande");
	var dropDownMeal = document.querySelector("#Name_meal");
	var description = document.querySelector(".description");
	var quantite;
	var tableHtmlDuRecap = document.querySelector("#recap");
	var boutonPasser = document.querySelector("#passerCommande")
	//function actualiser description
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function Actualiserdescription(idMeal) {
		var data = new FormData();
		data.append("id", idMeal);
		ajaxPost('index.php?action=orderIdMeal', data, function(reponse) {
			description.innerHTML = reponse;
		}, false);
		//function ajaxGet(url, callback);
		//function ajaxPost(url, data, callback, isJson);
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function actualiserRecap() {
		if (!localStorage.getItem('liste')) {
			tableau = [];
		} else {
			tableau = JSON.parse(localStorage.getItem('liste'));
		}
		panier = 0;
		tableHtmlDuRecap.innerHTML = "";
		for (var i = 0; i < tableau.length; i++) { // function pour afficher la liste dans le tableau ici 
			tableHtmlDuRecap.innerHTML += "<tr><td>" + tableau[i].quantite + "</td><td>" + tableau[i].nom + "</td><td>" + tableau[i].prixUnitaire + " €</td><td>" + tableau[i].prixTotal + " €</td><td><i class='fas fa-trash-alt' id=" + i + "></i></td>";

			panier += tableau[i].prixTotal;
		}
		tableHtmlDuRecap.innerHTML += "</tr><tr><td></td><td></td><td><strong>Panier<strong> : </td> <td>" + panier + " €	</td></tr>";
		rajoutEventListenerALiconePoubelle();
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function rajoutEventListenerALiconePoubelle() {
		trash = document.querySelectorAll('.fa-trash-alt');
		if (trash.length !== 0) {
			//le for //////////
			for (var i = 0; i < trash.length; i++) {
				trash[i].addEventListener('click', function(e) {
					var id = e.target.id;
					tableau.splice(id, 1);
					localStorage.setItem('liste', JSON.stringify(tableau));
					actualiserRecap();
				});
			}
		}
	}
	dropDownMeal.addEventListener('change', function(e) {
		var idMeal = e.target.value;
		Actualiserdescription(idMeal);
		quantite = document.querySelector("input[name='quantite']");
		quantite.value = 1;
	});

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	boutonAjouter.addEventListener('click', function(e) {
		e.preventDefault();

		quantite = document.querySelector("input[name='quantite']");
		var quantiteWow = Number(quantite.value);

		var nomAlimentSelectionne = document.getElementById('Name_meal').selectedOptions[0].text;

		var prixUnitaire = document.querySelector("#prix_unitaire").textContent;

		var prixTotal = quantiteWow * prixUnitaire;

		var commande = {
			id: dropDownMeal.value,
			quantite: quantiteWow,
			nom: nomAlimentSelectionne,
			prixUnitaire: prixUnitaire,
			prixTotal: prixTotal
		};
		localStorage.setItem('liste', JSON.stringify(tableau));
		tableau = JSON.parse(localStorage.getItem('liste'));
		actualiserRecap();
		quantite.value = 1;
	});

	boutonPasser.addEventListener('click', function(e) {
		e.preventDefault();
		var divInfo = document.querySelector('#message_info');


		if (tableau.length !== 0) {
			divInfo.textContent = 'Commande validé';
			divInfo.style.border = '1px solid green';

			//executing program
			fadeIn(divInfo);
			setTimeout(function() {
				fadeOut(divInfo);
			}, 5000);
			var data = new FormData();
			data.append('listeCommande', {data :tableau});
			ajaxPost('index.php?action=ConfirmOrder',data , function(reponse) {
				console.log(reponse);
			}, true);

		} else {

			divInfo.textContent = 'votre commande est vide ... commandez avant d\'esseyer de passer une commande';
			divInfo.style.border = '1px solid red';

			//executing program
			fadeIn(divInfo);
			setTimeout(function() {
				fadeOut(divInfo);
			}, 5000);
		}
	})



	actualiserRecap()

});