<?php /* Template Name: Create Quiz Etape 1 */ get_header();?>

<h2>Créez votre quiz</h2>

<div class="createQuiz">
    <h3>Étape 1: Le sujet</h3>
    <div class="steps">
        <div class="step step1">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
        <div class="stick"></div>
    </div>
    <form action="">
        <div>
            <label for="">Titre du quiz :</label>
            <input type="text">
        </div>
        <div>
            <label for="">Thème du quiz :</label>
            <select name="location" id="sites">
                <option value="">Thème de votre quiz</option>
                <?php 

                $sites = array();

                for($i=0; $i<count($sites); $i++){
                    echo '<option value="'.$sites[$i].'">'.$sites[$i].'</option>';
                }
                ?>
            </select>
            <i class="fas fa-sort-down"></i>
        </div>
        <div>
            <label for="">Image :</label>
            <span>Choisissez votre image.</span>
            <input type="file" hidden>
            <button></button>
        </div>
        <input type="submit">
    </form>
</div>

<div class="svg_step1"></div>

<?php get_footer(); ?>