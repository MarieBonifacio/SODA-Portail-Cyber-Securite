<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/portail.css">
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
		<script src="https://kit.fontawesome.com/06909fb3de.js"></script>
	</head>
	<body>
			<div class="above">
				<div class="logo">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo/LogoCyberDéfense.png" alt="logo portail SODA cyber Défense">
					<!-- <div class="filter"></div> -->
				</div>
				<div class="search">
					<!-- <i class="fas fa-arrow-left"></i> -->
					<div class="icons">
						<i class="fas fa-search"></i>
						<i class="far fa-bell"></i>
					</div>
					<div class="profile_pic">
						<div class="circle">
							<img src="" alt="photo de votre profil">
						</div>
					</div>
					<div class="settings"></div>
				</div>
			
			</div>
			<div class="side">
				<div class="home">
					<i class="fas fa-home"></i>
					<!-- <p>Accueil</p> -->
                    <i class="fas fa-sort-down"></i>
				</div>
				<div class="articles">
					<i class="far fa-newspaper"></i>
					<!-- <p>Articles</p> -->
                    <i class="fas fa-sort-down"></i>
				</div>
				<div class="modules">
					<i class="fas fa-graduation-cap"></i>
					<!-- <p>Modules</p> -->
                    <i class="fas fa-sort-down"></i>
				</div>
				<div class="tools">
					<i class="fas fa-tools"></i>
					<!-- <p>Outils</p> -->
					<i class="fas fa-sort-down"></i>
				</div>
				<div class="quiz">
					<i class="fas fa-question-circle"></i>
					<!-- <p>Quiz</p> -->
					<i class="fas fa-sort-down"></i>
				</div>
				<div class="games">
					<i class="fas fa-gamepad"></i>
					<!-- <p>Jeux</p> -->
					<i class="fas fa-sort-down"></i>
				</div>
				<div class="rank">
					<i class="fas fa-trophy"></i>
					<!-- <p>Classement</p> -->
					<i class="fas fa-sort-down"></i>
				</div>
				<i class="fas fa-question"></i>
			</div>
