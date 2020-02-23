<?php /* Template Name: Profil */ get_header(); ?>
    
<section class="insc">

<?php 
require('app/class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_SESSION['userConnected'])){
    $id = $_SESSION['userConnected'];
    
    $userConnected = new User();
    $userConnected->selectById($id);
    
    echo $userConnected->print();
  }


?>

</section>

<?php get_footer(); ?>