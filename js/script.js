var dos = 'img/verso.svg';
var clic=0;
var paires = 0;
var choixun;
var choixdeux;
var norepeat = true; //empeche le chrono de se repeter


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// Affichage des cartes ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 function choisir(carte) { // Choix des cartes quand l'utilisateur clique
	if (norepeat == true){ // Empêche le chronomètre de se répéter
		timerID = setInterval("chrono()", 1000); //on appelle la fonction chronometre
		norepeat = false;
	}
	if (clic == 2) { // Au delà du 1er clic on affiche rien
		return; 
	}
	if (clic == 0) { // Au premier clic
		choixun = carte; // On attribue le numéro de la carte choisie au premier choix
		document.images[carte].src =  tab[carte]; // Affiche l'image de la carte correspondante au choix
		document.images[choixun].style.pointerEvents = 'none'; //Désactive l'évènement du clic
		clic = 1; // On passe le clique à 1
	}
	else { // Au deuxième clic
		clic = 2; // On passe le clic à 2
		choixdeux = carte; // On attribue le numéro de la carte choisie au deuxième choix
		document.images[carte].src =  tab[carte]; 
		timer = setTimeout("verif()", 500); // Ajoute un temps de pause puis passe à la fonction de vérification
	}	
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// Vérification ////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function verif() { // Vérifie si une paire a été faite
	clic = 0;
	if (tab[choixdeux] ==  tab[choixun]) { //si les deux cartes sont pareilles la paire reste fixe
		paires++; 
		document.getElementById("paires").innerHTML = paires;
		document.images[choixun].style.pointerEvents = 'none'; 
		document.images[choixun].style.opacity = '0.3';// l'opacité s'applique sur la carte retournée
		document.images[choixun].style.pointerEvents = 'none';
		document.images[choixdeux].style.opacity = '0.3';
	} else {
		document.images[choixun].src = dos;
		document.images[choixun].style.pointerEvents = 'auto';//Desactive l'evenement du clique (pas de double clique)
		document.images[choixdeux].src = dos;
		return;
	}	
}

function relance () {
	document.location.href="./index.php";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// Chronomètre ////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var timerID = 0;
var sec = 30;
var min = 0; 

function chrono(){ 
	if(sec<=30 && sec>0){
		sec--;
		if(sec<10){
			sec = "0" +sec; //affiche 0 avant le chiffre 1
		}
		if(paires == 4){
			document.location.href="./index.php?min=" + min + "&sec=" +sec; //Redirection au debut du jeu en recuperant le nom et le score
		}
	}else if(sec == 0){
		if((sec == 0) && paires==4){
			document.location.href="./index.php?min=" + min + "&sec=" +sec; 
		}else if((sec == 0)&&(paires !== 4)){
			document.location.href="./index.php?perdu";
		}
	}
	document.getElementById("chronotime").innerHTML = min + ":" + sec +""; //afiche le chronometre 
} 
 
 