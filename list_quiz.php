<?php /* Template Name: Liste Quiz */ 

$_SESSION['needAdmin'] = true;

get_header(); 

cleanSession();

?>



<h2 class="h2"> Liste des Quizs </h2>



<div class="quizsL">

  <div class="listQuiz">

    <table>

      <thead>

        <tr>

          <th>Nom</th>

          <th>Tag</th>

          <th>Status</th>

          <th>Mod/Supp</th>

        </tr>

      </thead>

      <tbody class="list"></tbody>

    </table>

  </div>

</div>



<?php  get_footer(); ?>