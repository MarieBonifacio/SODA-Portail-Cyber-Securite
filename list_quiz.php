<?php /* Template Name: Liste Quiz */ 
$_SESSION['needAdmin'] = true;
get_header(); 
?>

<h2 class="h2"> Liste Quizs </h2>

<div class="quizs">
  <div class="listQuiz">
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Tag</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="list"></tbody>
    </table>
  </div>
</div>

<?php  get_footer(); ?>