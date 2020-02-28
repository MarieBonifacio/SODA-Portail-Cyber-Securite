<?php /* Template Name: Create Quiz Etape 1 */ get_header();?>

<h2>Créez votre quiz</h2>

<div class="createQuiz">
    <h3>Étape 1: Le sujet</h3>
    <div class="steps">
        <div class="step stepInto">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
        <div class="stick"></div>
    </div>

    <form action="<?php echo get_template_directory_uri(); ?>/app/create_quiz_1.php" method="post">
        <?php
            if(!empty($_SESSION["errorQuiz"])){
                echo "<p class='mess error'>".$_SESSION["errorQuiz"]."</p>";
                unset($_SESSION["errorQuiz"]);
            }
            elseif(!empty($_SESSION["quizOk"])){
                echo "<p class='mess good'>".$_SESSION["quizOk"]."</p>";
                unset($_SESSION["quizOk"]);
            }
        ?>
        <div>
            <label for="">Titre du quiz :</label>
            <input type="text" name="title">
        </div>
        <div>
            <label for="">Thème du quiz :</label>
            <select name="theme" id="sites">
                <option value="">Thème de votre quiz</option>
                <?php 

                $sites = array("lol", "mdr", "ptdr");

                for($i=0; $i<count($sites); $i++){
                    echo '<option value="'.$sites[$i].'">'.$sites[$i].'</option>';
                }
                ?>
            </select>
            <i class="fas fa-sort-down"></i>
        </div>
        <div>
            <label for="">Image :</label>
            <button type="button" disabled><p id="fakebtn">Séléctionnez une image</p></button>
            <span id="img_select">Aucune image sélectionnée.</span>
            <input id="realbtn" type="file" name="img_quiz" hidden>
        </div>
        <input type="submit" value="Suivant">
        <!-- <iframe src="https://www.youtube.com/embed/VLbMXG8lvjI?list=RDZdQLWg2E1fg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
    </form>
</div>

<div class="svg_step1">
    <svg viewBox="0 0 803 591" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g id="undraw_researching_22gp 1">
    <g clip-path="url(#clip0)">
    <path id="Vector" d="M802.027 218.808H464.906V228.697H802.027V218.808Z" fill="#E6E6E6"/>
    <path id="Vector_2" d="M578.178 136.101H492.774V221.505H578.178V136.101Z" fill="#E6E6E6"/>
    <path id="Vector_3" d="M561.097 153.182H509.855V204.424H561.097V153.182Z" fill="#CCCCCC"/>
    <path id="Vector_4" d="M705.835 136.101H684.259V221.505H705.835V136.101Z" fill="#E6E6E6"/>
    <path id="Vector_5" d="M705.835 149.586H684.259V159.474H705.835V149.586Z" fill="#CCCCCC"/>
    <path id="Vector_6" d="M705.835 192.737H684.259V202.626H705.835V192.737Z" fill="#CCCCCC"/>
    <path id="Vector_7" d="M672.572 136.101H650.997V221.505H672.572V136.101Z" fill="#E6E6E6"/>
    <path id="Vector_8" d="M672.572 149.586H650.997V159.474H672.572V149.586Z" fill="#CCCCCC"/>
    <path id="Vector_9" d="M672.572 192.737H650.997V202.626H672.572V192.737Z" fill="#CCCCCC"/>
    <path id="Vector_10" d="M724.425 135.748L705.089 145.321L742.982 221.858L762.318 212.285L724.425 135.748Z" fill="#E6E6E6"/>
    <path id="Vector_11" d="M730.408 147.832L711.072 157.405L715.46 166.268L734.796 156.695L730.408 147.832Z" fill="#CCCCCC"/>
    <path id="Vector_12" d="M749.554 186.504L730.218 196.077L734.606 204.939L753.942 195.366L749.554 186.504Z" fill="#CCCCCC"/>
    <path id="Vector_13" d="M524.688 170.382L535.554 189.201L546.419 208.02H524.688H502.958L513.823 189.201L524.688 170.382Z" fill="#E6E6E6"/>
    <path id="Vector_14" d="M543.567 173.978L554.432 192.797L565.298 211.616H543.567H521.837L532.702 192.797L543.567 173.978Z" fill="#E6E6E6"/>
    <path id="Vector_15" d="M551.209 168.464C554.684 168.464 557.502 165.647 557.502 162.171C557.502 158.696 554.684 155.879 551.209 155.879C547.733 155.879 544.916 158.696 544.916 162.171C544.916 165.647 547.733 168.464 551.209 168.464Z" fill="#E6E6E6"/>
    <path id="Vector_16" d="M464.906 92.9492L802.027 92.9492V83.0603L464.906 83.0603V92.9492Z" fill="#E6E6E6"/>
    <path id="Vector_17" d="M688.754 85.7573L774.158 85.7573V0.353165L688.754 0.353165V85.7573Z" fill="#E6E6E6"/>
    <path id="Vector_18" d="M705.835 68.6765H757.077V17.434L705.835 17.434V68.6765Z" fill="#CCCCCC"/>
    <path id="Vector_19" d="M561.097 85.7573H582.673V0.353165H561.097V85.7573Z" fill="#E6E6E6"/>
    <path id="Vector_20" d="M561.097 23.7269L582.673 23.7269V13.838L561.097 13.838V23.7269Z" fill="#CCCCCC"/>
    <path id="Vector_21" d="M561.097 66.8784H582.673V56.9895H561.097V66.8784Z" fill="#CCCCCC"/>
    <path id="Vector_22" d="M594.36 85.7573H615.936V0.353165H594.36V85.7573Z" fill="#E6E6E6"/>
    <path id="Vector_23" d="M594.36 23.7269L615.936 23.7269V13.838L594.36 13.838V23.7269Z" fill="#CCCCCC"/>
    <path id="Vector_24" d="M594.36 66.8784H615.936V56.9895H594.36V66.8784Z" fill="#CCCCCC"/>
    <path id="Vector_25" d="M504.614 76.5375L523.95 86.1104L561.843 9.573L542.507 4.33597e-05L504.614 76.5375Z" fill="#E6E6E6"/>
    <path id="Vector_26" d="M532.137 20.9471L551.472 30.5201L555.86 21.6578L536.524 12.0849L532.137 20.9471Z" fill="#CCCCCC"/>
    <path id="Vector_27" d="M512.991 59.6187L532.326 69.1917L536.714 60.3294L517.378 50.7565L512.991 59.6187Z" fill="#CCCCCC"/>
    <path id="Vector_28" d="M742.244 34.634L731.379 53.453L720.514 72.272H742.244H763.975L753.109 53.453L742.244 34.634Z" fill="#E6E6E6"/>
    <path id="Vector_29" d="M723.365 38.23L712.5 57.049L701.635 75.868H723.365H745.096L734.231 57.049L723.365 38.23Z" fill="#E6E6E6"/>
    <path id="Vector_30" d="M715.724 32.7168C719.199 32.7168 722.017 29.8994 722.017 26.4239C722.017 22.9484 719.199 20.131 715.724 20.131C712.248 20.131 709.431 22.9484 709.431 26.4239C709.431 29.8994 712.248 32.7168 715.724 32.7168Z" fill="#E6E6E6"/>
    <path id="Vector_31" d="M464.906 364.444L802.027 364.444V354.555L464.906 354.555V364.444Z" fill="#E6E6E6"/>
    <path id="Vector_32" d="M688.754 357.252H774.158V271.848H688.754V357.252Z" fill="#E6E6E6"/>
    <path id="Vector_33" d="M705.835 340.172H757.077V288.929H705.835V340.172Z" fill="#CCCCCC"/>
    <path id="Vector_34" d="M561.097 357.252H582.673V271.848H561.097V357.252Z" fill="#E6E6E6"/>
    <path id="Vector_35" d="M561.097 295.222H582.673V285.333H561.097V295.222Z" fill="#CCCCCC"/>
    <path id="Vector_36" d="M561.097 338.374H582.673V328.485H561.097V338.374Z" fill="#CCCCCC"/>
    <path id="Vector_37" d="M594.36 357.252H615.936V271.848H594.36V357.252Z" fill="#E6E6E6"/>
    <path id="Vector_38" d="M594.36 295.222H615.936V285.333H594.36V295.222Z" fill="#CCCCCC"/>
    <path id="Vector_39" d="M594.36 338.374H615.936V328.485H594.36V338.374Z" fill="#CCCCCC"/>
    <path id="Vector_40" d="M504.614 348.033L523.95 357.606L561.843 281.068L542.507 271.495L504.614 348.033Z" fill="#E6E6E6"/>
    <path id="Vector_41" d="M532.137 292.442L551.472 302.015L555.86 293.153L536.524 283.58L532.137 292.442Z" fill="#CCCCCC"/>
    <path id="Vector_42" d="M512.991 331.114L532.326 340.687L536.714 331.825L517.378 322.252L512.991 331.114Z" fill="#CCCCCC"/>
    <path id="Vector_43" d="M742.244 306.129L731.379 324.948L720.514 343.768H742.244H763.975L753.109 324.948L742.244 306.129Z" fill="#E6E6E6"/>
    <path id="Vector_44" d="M723.365 309.725L712.5 328.544L701.635 347.364H723.365H745.096L734.231 328.544L723.365 309.725Z" fill="#E6E6E6"/>
    <path id="Vector_45" d="M715.724 304.212C719.199 304.212 722.017 301.395 722.017 297.919C722.017 294.444 719.199 291.626 715.724 291.626C712.248 291.626 709.431 294.444 709.431 297.919C709.431 301.395 712.248 304.212 715.724 304.212Z" fill="#E6E6E6"/>
    <path id="Vector_46" d="M397.129 590.916C616.458 590.916 794.259 578.288 794.259 562.711C794.259 547.134 616.458 534.506 397.129 534.506C177.801 534.506 0 547.134 0 562.711C0 578.288 177.801 590.916 397.129 590.916Z" fill="#E6E6E6"/>
    <path id="Vector_47" d="M707.387 578.506C642.632 566.981 571.819 568.897 497.54 578.506C531.395 549.925 560.615 521.343 526.759 492.762C592.798 506.386 602.048 505.007 675.511 492.762C658.472 521.343 690.348 549.925 707.387 578.506Z" fill="#6091A0"/>
    <path id="Vector_48" opacity="0.2" d="M707.387 578.506C642.632 566.981 571.819 568.897 497.54 578.506C531.395 549.925 560.615 521.343 526.759 492.762C592.798 506.386 602.048 505.007 675.511 492.762C658.472 521.343 690.348 549.925 707.387 578.506Z" fill="black"/>
    <path id="Vector_49" d="M691.592 566.312C636.585 557.113 576.432 558.642 513.335 566.312C542.094 543.498 566.915 520.684 538.156 497.87C594.253 508.745 602.111 507.644 664.515 497.87C650.041 520.684 677.118 543.498 691.592 566.312Z" fill="#6091A0"/>
    <path id="Vector_50" d="M670.64 529.553C686.827 529.553 699.949 516.431 699.949 500.244C699.949 484.057 686.827 470.935 670.64 470.935C654.453 470.935 641.331 484.057 641.331 500.244C641.331 516.431 654.453 529.553 670.64 529.553Z" fill="#2F2E41"/>
    <path id="Vector_51" d="M537.591 466.249L557.899 469.634L568.053 498.967L538.72 517.019L504.873 466.249H536.463H537.591Z" fill="#A0616A"/>
    <path id="Vector_52" d="M595.13 511.378C621.3 511.378 642.515 490.163 642.515 463.993C642.515 437.823 621.3 416.608 595.13 416.608C568.96 416.608 547.745 437.823 547.745 463.993C547.745 490.163 568.96 511.378 595.13 511.378Z" fill="#A0616A"/>
    <path id="Vector_53" d="M333.386 291.377C333.386 291.377 218.308 303.787 198.001 301.531C177.693 299.274 168.667 297.018 168.667 297.018C168.667 297.018 155.129 315.069 161.898 322.967C165.689 327.518 170.277 331.341 175.436 334.249C175.436 334.249 187.847 330.864 196.872 334.249C205.898 337.634 297.283 352.3 313.078 338.762C328.873 325.223 333.386 291.377 333.386 291.377Z" fill="#2F2E41"/>
    <path id="Vector_54" d="M341.283 542.967C341.283 542.967 265.693 521.531 252.155 426.762V417.736C252.155 417.736 237.198 443.975 231.847 449.326C225.642 455.531 203.642 511.378 204.77 517.019C205.898 522.66 204.77 524.916 204.77 524.916L172.052 521.532V511.378C172.052 511.378 189.539 458.916 190.667 446.506C191.795 434.095 234.103 347.787 234.103 347.787C234.103 347.787 249.898 315.069 276.975 347.787C304.052 380.505 306.309 403.07 306.309 403.07L341.283 470.762L341.283 542.967Z" fill="#2F2E41"/>
    <g id="foot">
    <path id="Vector_55" d="M172.052 293.633L135.949 281.223C135.949 281.223 102.103 256.402 110 281.223C117.898 306.044 154 360.198 164.154 354.557C174.308 348.916 186.52 334.913 183.799 332.889C181.077 330.864 163.026 316.198 172.052 293.633Z" fill="#2F2E41"/>
    </g>
    <path id="Vector_56" d="M176.416 504.717L147.272 518.95C147.272 518.95 112.028 524.372 131.683 534.538C151.338 544.705 205.56 555.549 208.271 546.06C210.982 536.572 209.906 520.824 207.055 521.243C204.204 521.661 184.549 523.694 176.416 504.717Z" fill="#2F2E41"/>
    <path id="Vector_57" d="M326.616 468.506C326.616 468.506 311.95 531.685 336.77 545.224C361.591 558.762 535.335 561.019 548.873 536.198C562.412 511.378 555.643 511.378 555.643 511.378L519.54 470.762L548.873 468.506C548.873 468.506 548.873 459.48 538.72 458.352C528.566 457.224 496.976 445.941 469.899 453.839C442.822 461.736 427.027 438.044 427.027 438.044L326.616 468.506Z" fill="#575A89"/>
    <path id="Vector_58" d="M307.437 271.069L288.257 375.993L420.258 360.198L443.95 265.428L307.437 271.069Z" fill="#3F3D56"/>
    <path id="Vector_59" d="M311.386 275.018L295.591 368.659L415.745 354.557L438.873 269.377L311.386 275.018Z" fill="white"/>
    <path id="Vector_60" d="M292.77 377.121L288.257 375.993L286.001 380.505L322.104 480.916L325.499 479.618L326.616 473.019L292.77 377.121Z" fill="#B3B3B3"/>
    <path id="Vector_61" d="M288.257 374.864L324.36 479.788L460.873 459.48L420.258 360.198L288.257 374.864Z" fill="#D0CDE1"/>
    <path id="Vector_62" d="M306.309 371.48V377.121L406.719 365.839L405.591 360.198L306.309 371.48Z" fill="#3F3D56"/>
    <path id="Vector_63" d="M308.565 382.762L324.36 426.762L427.027 414.352L408.976 372.608L308.565 382.762Z" fill="#3F3D56"/>
    <g id="r_hand">
    <path id="Vector_64" d="M437.181 444.813L433.796 435.788C433.796 435.788 407.847 390.659 394.309 399.685C380.77 408.711 422.514 452.711 422.514 452.711H436.053L437.181 444.813Z" fill="#A0616A"/>
    </g>
    <g id="l_hand">
    <path id="Vector_65" d="M351.437 451.583L348.052 438.044C348.052 438.044 339.027 396.3 354.822 398.557C370.617 400.813 375.129 440.3 375.129 440.3L374.001 449.326L351.437 451.583Z" fill="#A0616A"/>
    </g>
    <path id="Vector_66" d="M378.514 445.942C378.514 445.942 349.181 441.429 348.052 448.198C346.924 454.967 341.283 556.506 369.488 559.891C397.694 563.275 537.591 577.942 522.925 542.967C508.258 507.993 485.694 512.506 485.694 512.506L389.796 522.66L378.514 445.942Z" fill="#575A89"/>
    <path id="Vector_67" d="M467.078 458.916L437.181 438.044L417.437 453.275L442.258 480.352L467.078 458.916Z" fill="#575A89"/>
    <path id="Vector_68" opacity="0.2" d="M386.976 479.224L391.488 522.096L469.335 517.583L401.642 516.455L386.976 479.224Z" fill="black"/>
    <path id="Vector_69" d="M618.521 529.013C649.675 529.013 674.931 503.757 674.931 472.603C674.931 441.448 649.675 416.192 618.521 416.192C587.366 416.192 562.11 441.448 562.11 472.603C562.11 503.757 587.366 529.013 618.521 529.013Z" fill="#2F2E41"/>
    <path id="Vector_70" d="M328.309 307.736L398.258 305.301L405.027 279.531L332.822 281.71L328.309 307.736Z" fill="#6091A0"/>
    <path id="Vector_71" d="M310.258 322.403L416.309 319.018L417.437 314.505L311.386 318.239L310.258 322.403Z" fill="#E6E6E6"/>
    <path id="Vector_72" d="M308.001 333.685L414.053 330.3L415.181 325.787L309.129 329.521L308.001 333.685Z" fill="#E6E6E6"/>
    <path id="Vector_73" d="M306.873 342.71L412.924 339.326L414.053 334.813L308.001 338.546L306.873 342.71Z" fill="#E6E6E6"/>
    </g>
    </g>
    <defs>
    <clipPath id="clip0">
    <rect width="802.027" height="590.916" fill="white"/>
    </clipPath>
    </defs>
    </svg>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/quiz_step1.js">

<?php get_footer(); ?>