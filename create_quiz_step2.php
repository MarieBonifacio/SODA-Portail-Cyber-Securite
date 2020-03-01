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
    <?php
        if(!empty($_SESSION["errorQuiz"])){
            echo "<p class='mess error'>".$_SESSION["errorQuiz"]."</p>";
            unset($_SESSION["errorQuiz"]); 
            /* SI ON REVIENT DU SCRIPT VALIDATION */
            $p = $_SESSION['formQuizStep2'];
           
        }
    ?>
    <form action="<?php echo get_template_directory_uri(); ?>/app/create_quiz_2.php" method="post">
        <?php
           
            for($i=1; $i<=10; $i++){
                echo '
                <div class="question">
                    <input type="hidden" name="nbrQuestion" value = "10">
                    <div>
                        <label for="">Votre question: '.$i.'.</label>
                        <input type="text" name="question_'.$i.'" value="'.$p['question_'.$i].'">
                    </div>
                    <div class="answers">
                        <label for="">Vos réponses(2 minimum):</label>
                        <div class="abcd">
                            <div class="answer">
                                <label for="">A.</label>
                                <input type="text" name="q_'.$i.'_reponse_1" value="'.$p['q_'.$i.'_reponse_1'].'">
                                <label class="true" id="truea">
                                    <input type="radio" value="true" name="q_'.$i.'_isTrue_1">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falsea">
                                    <input type="radio" value="false" name="q_'.$i.'_isTrue_1">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="answer">
                                <label for="">B.</label>
                                <input type="text" name="q_'.$i.'_reponse_2" value="'.$p['q_'.$i.'_reponse_2'].'">
                                <label class="true" id="trueb">
                                    <input type="radio" value="true" name="q_'.$i.'_isTrue_2">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falseb">
                                    <input type="radio" value="false" name="q_'.$i.'_isTrue_2">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="answer">
                                <label for="">C.</label>
                                <input type="text" name="q_'.$i.'_reponse_3"  value="'.$p['q_'.$i.'_reponse_3'].'">
                                <label class="true" id="truec">
                                    <input type="radio" value="true" name="q_'.$i.'_isTrue_3">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falsec">
                                    <input type="radio" value="false" name="q_'.$i.'_isTrue_3">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="answer">
                                <label for="">D.</label>
                                <input type="text" name="q_'.$i.'_reponse_4"  value="'.$p['q_'.$i.'_reponse_4'].'">
                                <label class="true" id="trued">
                                    <input type="radio" value="true" name="q_'.$i.'_isTrue_4">
                                    <span>
                                        <i class="fas fa-check"></i>
                                    </span>
                                </label>
                                <label class="false" id="falsed">
                                    <input type="radio" value="false" name="q_'.$i.'_isTrue_4">
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
        <input type="submit" value="Valider" />
    </form>

    <i class="fas fa-plus"></i>

</div>
<?php get_footer()?>