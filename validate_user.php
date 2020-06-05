<?php /* Template Name: userValidation */ 

$_SESSION['needAdmin'] = true;

get_header();

cleanSession(); 

if(isset($_POST['user'])){
    $userId = $_POST['user'];

    update_user_meta($userId, "status", 1);
    unset($_POST);
}
?>

<h2 class="h2 h2board">Utilisateurs en attente de validation</h2>

<div class="modulesL">

  <div class="listModules">

    <table>

      <thead>

        <tr>

          <th>Nom</th>

          <th>Prénom</th>

          <th>Matricule</th>

          <th>Email</th>

          <th>Site</th>

          <th>Activer</th>

        </tr>

      </thead>

      <tbody class="list">
        <?php
            global $wpdb;

            $users = $wpdb->get_results("SELECT wp_users.ID AS ID FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID WHERE wp_usermeta.meta_key = 'status' AND wp_usermeta.meta_value =  0");

            if(count($users) === 0){
                echo "<tr>
                    <td colspan='6'>Aucun utilisateur en attente de validation.</td>
                </tr>";
            }

            foreach($users as $user){
                $userId = $user->ID;
                echo "<tr>

                <td>".get_user_meta($userId, 'last_name', true)."</td>
      
                <td>".get_user_meta($userId, 'first_name', true)."</td>
      
                <td>".get_user_meta($userId, 'id_alc', true)."</td>
      
                <td>".get_user_meta($userId, 'nickname', true)."</td>
      
                <td>".get_user_meta($userId, 'location', true)."</td>
      
                <td><form action='./' method='POST' ><button type = 'submit' value='".$userId."' name='user' >Valider</button></form></td>
      
              </tr>";
            }
        ?>
      </tbody>

    </table>

  </div>

</div>


<?php get_footer();?>