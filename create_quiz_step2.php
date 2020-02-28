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
        <?php
        
            for($i=1; $i<=10; $i++){
                echo '
                <div class="question">
                    <input type="number" name="nbrQuestion" hidden>
                    <div>
                        <label for="">Votre question: '.$i.'.</label>
                        <input type="text" name="question">
                    </div>
                    <div class="answers">
                        <label for="">Vos réponses(2 minimum):</label>
                        <div class="abcd">
                            <div class="answer">
                                <label for="">A.</label>
                                <input type="text" name="answerA">
                                <label class="true" id="truea">
                                    <input type="radio" value="true" name="ansA'.$i.'">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falsea">
                                    <input type="radio" value="false" name="ansA'.$i.'">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="answer">
                                <label for="">B.</label>
                                <input type="text" name="answerB">
                                <label class="true" id="trueb">
                                    <input type="radio" value="true" name="ansB'.$i.'">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falseb">
                                    <input type="radio" value="false" name="ansB'.$i.'">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="answer">
                                <label for="">C.</label>
                                <input type="text" name="answerC">
                                <label class="true" id="truec">
                                    <input type="radio" value="true" name="ansC'.$i.'">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falsec">
                                    <input type="radio" value="false" name="ansC'.$i.'">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="answer">
                                <label for="">D.</label>
                                <input type="text" name="answerD">
                                <label class="true" id="trued">
                                    <input type="radio" value="true" name="ansD'.$i.'">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falsed">
                                    <input type="radio" value="false" name="ansD'.$i.'">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }

        ?> 
    </form>

    <i class="fas fa-plus"></i>

</div>
<?php get_footer()?>