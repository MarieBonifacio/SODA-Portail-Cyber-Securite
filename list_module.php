<?php /* Template Name: Liste Module */ 

$_SESSION['needAdmin'] = true;

get_header(); 

cleanSession();

?>



<h2 class="h2"> Liste Modules </h2>



<div class="modulesL">

  <div class="listModules">

    <table>

      <thead>

        <tr>

          <th>Nom</th>

          <th>Tag</th>

          <th>Mod/Supp</th>

        </tr>

      </thead>

      <tbody class="list"></tbody>

    </table>

  </div>

</div>



<?php  get_footer(); ?>