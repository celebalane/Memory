<?php
	$tab = array("img/araignee.svg", "img/araignee.svg", "img/cochon.svg", "img/cochon.svg", "img/flamand", "img/flamand", "img/mouton", "img/mouton", "img/baleine", "img/baleine", "img/taupe.svg", "img/taupe.svg");
	$dos = 'img/verso.svg';
	$etat='jeu';
	shuffle($tab); 

	if(isset($_GET["min"]) && isset($_GET["sec"])){ //Si les variables existent
		if ($_GET["min"] != ""){ //Si la variable contient bien quelque chose
			$etat='victoire';
			$min = (int)htmlspecialchars($_GET["min"]);
			$sec = (int)htmlspecialchars($_GET["sec"]);
		}
	}
	if(isset($_GET['perdu'])){
		$etat='perdu';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Patapon et ses amis - Memory</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">
	<script type="text/javascript"> 
		var tab = [ 
		<?php                                   
			foreach ($tab as $index => $case) {               
				echo '"'. $case . '"';                        
				if ($index != 11){                        
					echo ',';                           
				}
			}
		?>
		];
	</script>
</head>
<body>
	<header class="row-fluid">
		<div class="text-center" id="logo">
			<?php include("img/logo-patapon.svg"); ?>
		</div>
	</header>
	<div class="container">
		<section class="row">
			<p class="text-center">Aide Patapon à retrouver toutes les paires de cartes représentant ses amis. Attention Patapon n'est pas patient, ce filou a installé un chronomètre!</p>
			<div class="col-md-2 text-center">
				<p>Nombre de paire</p> 
				<p id='paires'>0</p>
			</div>
			<?php if (($etat ==='victoire')): ?>
					<div class="alert alert-light col-md-7 text-center">
						<h1 id="victoire">BRAVO !</h1>
						<p>Ton temps est de <?= $min; ?> min et <?= $sec; ?> sec</p>
						<button type="button" class="btn btn-info" onclick="relance(2)">Rejouer</button>
					</div>
				<?php elseif($etat==='perdu'): ?>
					<div class="alert alert-light col-md-7 text-center">
						<h1 id="victoire">Dommage :(</h1>
						<p>Tu n'as pas trouvé les paires à temps<br>Patapon te propose un nouvel essai, veux tu rejouer?</p>
						<button type="button" class="btn btn-info" onclick="relance(2)">Rejouer</button>
					</div>
				<?php else: ?>
					<div class="col-lg-8 col-md-8" id="niveau2">
						<div class="row">
							<?php for($i=0; $i<=count($tab) -1 ; $i++): ?>
								<div class="col-lg-3 col-md-4 text-center">
									<img src="<?= $dos; ?>" class='illu2 img-fluid' onclick='choisir("<?= $i; ?>","6")' draggable='false' />
								</div>
							<?php endfor; ?>
						</div>
					</div>
			<?php endif; ?>
			<div class="col-md-2 text-center">
				<p>Chronomètre</p>
				<p id='chronotime'>00:30</p>
			</div>
		</section>
	</div>
	<footer class="row-fluid">
		<img src="img/patapon-fond-ecran.svg" id="img-patapon" />
	</footer>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>