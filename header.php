<?php
require('app/class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
    $userConnected = new User();
    $userConnected->selectById($id);
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


	</head>
	<body>


		<nav class="above">
			<div class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo/LogoCyberDéfense.png" alt="logo portail SODA cyber Défense">
			</div>
			<div class="search">
				<i class="arrow fas fa-arrow-left"></i>
				<div class="icons">
					<div class="searchContainer">
						<i class="fas fa-search"></i>
						<input class="searchBar"></input>
					</div>
					<i class="far fa-bell"></i>
				</div>
				<div class="profile_pic">
					<a href="<?php echo home_url()."/profil" ?>" class="circle">
						<img src="<?php echo get_template_directory_uri()."/img/avatar/".$userConnected->getImgPath(); ?>" alt="votre photo de profil"> 
						<!-- <img src="<?php echo get_template_directory_uri(); ?>/img/myAvatar.png" alt="photo de votre profil"> -->
					</a>
				</div>
				<div class="settings"></div>
			</div>
		</nav>
		<nav class="side">
			<div class="home">
				<a id="a" href="<?php echo home_url()."/accueil" ?>"><i class="fas fa-home"></i><p id="p">Accueil</p></a>
			</div>
			<div class="articles">
				<a id="a" href=""><i class="far fa-newspaper"></i><p id="p">Articles</p></a>
				<i class="fas fa-sort-down"></i>
			</div>
			<div class="modules">
				<a id="a" href=""><i class="fas fa-graduation-cap"></i><p id="p">Modules</p></a>
				<i class="fas fa-sort-down"></i>
			</div>
			<div class="tools">
				<a id="a" href=""><i class="fas fa-tools"></i><p id="p">Outils</p></a>
				<i class="fas fa-sort-down"></i>
			</div>
			<div class="quiz">
				<a id="a" href="<?php echo home_url()."/menu-quiz" ?>"><i class="fas fa-question-circle"></i><p id="p">Quiz</p></a>
				<i class="fas fa-sort-down"></i>
			</div>
			<div class="games">
				<a id="a" href=""><i class="fas fa-gamepad"></i><p id="p">Jeux</p></a>
				<i class="fas fa-sort-down"></i>
			</div>
			<div class="rank">
				<a id="a" href=""><i class="fas fa-trophy"></i><p id="p">Classement</p></a>
				<i class="fas fa-sort-down"></i>
			</div>
			<i class="fas fa-question"></i>
		</nav>

		<section class="content">
		