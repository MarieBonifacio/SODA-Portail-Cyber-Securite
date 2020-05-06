<?php
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
}else{
	wp_redirect( home_url() );
}


?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/portail.min.css">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/logo/LogoCyberDéfense.png" alt="logo portail SODA cyber Défense">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
		</script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
		
	</head>
	<body>


		<nav class="above">
			<div class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo/LogoCyberDéfense.png" alt="logo portail SODA cyber Défense">
			</div>
			<div class="search">
				<i class="arrow fas fa-arrow-left"></i>
				<div class="icons">
					<!-- <div class="searchContainer">
						<i class="fas fa-search"></i>
						<input class="searchBar"></input>
					</div> -->
					<i class="far fa-bell">
						<div class="notif">
							<div class="notifs"></div>
						</div>
						<span class="nbr_notifs"></span>
					</i>
				</div>
				<div class="profile_pic">
					<div class="circle">
						<div class="dropMenuProfile">
							<a href="<?php echo home_url()."/profil" ?>">Votre profil</a>
							<a href="<?php echo get_template_directory_uri(); ?>/app/deconnect.php">Déconnexion</a>
						</div>
						<?php if(get_user_meta(get_current_user_id() , 'avatar', true)){?>
							<img src="<?php echo get_template_directory_uri()."/img/avatar/".get_user_meta(get_current_user_id() , 'avatar', true) ?>" alt="votre photo de profil">
						<?php } else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/avatar/default.jpg" alt="logo portail SODA cyber Défense">
						<?php } ?>
					</div>
				</div>
				<div class="settings"></div>
			</div>
		</nav>
		<nav class="side">
			<div id="link" class="home">
				<a id="a" href="<?php echo home_url()."/accueil" ?>"><i class="fas fa-home"></i><p id="p">Accueil</p></a>
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link" class="articles">
					<a id="a" href="<?php echo home_url()."/articles" ?>"><i class="far fa-newspaper"></i><p id="p">Articles</p></a>
					<i class="fas fa-sort-down" data-id="articles"></i>
					<ul class="dropMenu" id="articles">
						<li>
							<a target="_blank" href="<?php echo home_url()."/ajouter-un-nouvel-article"?>">Ajoutez un article</a>
						</li>
					</ul>	
				<?php } else { ?>
					<div id="link" class="articles left">
						<a id="a" href="<?php echo home_url()."/articles" ?>"><i class="far fa-newspaper"></i><p id="p">Articles</p></a>
				<?php } ?>
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link" class="modules">
					<a id="a" href="<?php echo home_url()."/menu-module" ?>"><i class="fas fa-graduation-cap"></i><p id="p">Modules</p></a>
					<i class="fas fa-sort-down" data-id="modules"></i>
					<ul class="dropMenu" id="modules">
						<li>
							<a href="<?php echo home_url()."/creationmoduleetape1"?>">Créez votre module</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/liste-modules"?>">Liste des modules</a>
						</li>
					</ul>	
			<?php } else { ?>		
				<div id="link" class="modules left">
					<a id="a" href="<?php echo home_url()."/menu-module" ?>"><i class="fas fa-graduation-cap"></i><p id="p">Modules</p></a>
			<?php }?>
			</div>
			<div id="link"  class="tools">
				<a id="a" href="<?php echo home_url()."/generateur-de-mots-de-passe"?>"><i class="fas fa-tools"></i><p id="p">Outils</p></a>
				<i class="fas fa-sort-down" data-id="tools"></i>
				<ul class="dropMenu" id="tools">
						<li>
							<a href="<?php echo home_url()."/generateur-de-mots-de-passe"?>">Générateur de mot de passe solide</a>
						</li>
					</ul>	
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link"  class="quiz">
					<a id="a" href="<?php echo home_url()."/menu-quiz" ?>"><i class="fas fa-question-circle"></i><p id="p">Quizs</p></a>
					<i class="fas fa-sort-down" data-id="quizs"></i>
						<ul class="dropMenu" id="quizs">
							<li>
								<a href="<?php echo home_url()."/creationquizetape1"?>">Créez votre quiz</a>
							</li>
							<li>
								<a href="<?php echo home_url()."/liste-quizs"?>">Liste des quizs</a>
							</li>
						</ul>	
				<?php }  else {?>
					<div id="link"  class="quiz left">
						<a id="a" href="<?php echo home_url()."/menu-quiz" ?>"><i class="fas fa-question-circle"></i><p id="p">Quizs</p></a>
				<?php } ?>
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link" class="rank">
					<a id="a" href="<?php echo home_url()."/classements" ?>"><i class="fas fa-trophy"></i><p id="p">Classement</p></a>
				</div>
			<?php } ?>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link" class="admin">
				<a id="a" href="<?php echo home_url()."/wp-admin" ?>" target="_blank"><i class="fab fa-wordpress"></i><p id="p">Admin</p></a>
				</div>
			<?php } ?>
			<i class="fas fa-question"></i>
		</nav>

		<section class="content">
		