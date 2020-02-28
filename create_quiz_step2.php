<?php /* Template Name: Create Quiz Etape 2 */ get_header();?>

<h2>Titre du quiz</h2>

<div class="step2">

    <h3>Étape 2: Les questions</h3>


    <div class="steps">
        <div class="step">1</div>
        <div class="step stepInto">2</div>
        <div class="step">3</div>
        <div class="stick"></div>
    </div>
    <!-- <?php
        if(!empty($_SESSION["errorQuiz"])){
            echo "<p class='mess error'>".$_SESSION["errorQuiz"]."</p>";
            unset($_SESSION["errorQuiz"]);
        }
        elseif(!empty($_SESSION["quizOk"])){
            echo "<p class='mess good'>".$_SESSION["quizOk"]."</p>";
            unset($_SESSION["quizOk"]);
        }
    ?> -->
    <form action="">
        <!-- <?php
        
            for($i=1; $i<10; $i++){
                echo '<div class="question">
                    <label></label>
                    <input type="text" name="">
                    <label></label>
                </div>';
            }

        ?> -->
        <div class="question">
            <div>
                <label for="">Votre question: 1.</label>
                <input type="text" name="question">
            </div>
            <div>
                <label for="">Vos réponses(2 minimum):</label>
                <div id="a">
                    <label for="">A.</label>
                    <input type="text" name="">
                </div>
                <div id="b">
                    <label for="">B.</label>
                </div>
                <div id="c">
                    <label for="">C.</label>
                </div>
                <div id="d">
                    <label for="">D.</label>
                </div>
            </div>
        </div>
        
    </form>

    <i class="fas fa-plus"></i>

</div>

<?php get_footer(); ?>