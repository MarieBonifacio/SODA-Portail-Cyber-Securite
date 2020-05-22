

<?php /* Template Name: Add Tag*/ 

$_SESSION['needAdmin'] = true;

get_header();

cleanSession();

?>

<h2 id="debut" class="h2">Gestion des tags</h2>



<div class="add_tag">

    <div class="contentTag">

        <div class="listTag">

            <h3>Tags existants</h3>

            <ul>

                <?php 

                    //ajout boucle tags db

                    $tags = $wpdb->get_results( "SELECT tag.id AS tId, tag.name as tName, count(quiz.id) as nbUse FROM `tag`LEFT JOIN quiz ON quiz.tag_id = tag.id LEFT JOIN module ON module.tag_id = tag.id GROUP BY tag.name
                    ");

                    foreach($tags as $t){

                        echo '<li>'.$t->tName;

                        if($t->nbUse == 0){
                            echo ' <a href ="'.get_template_directory_uri().'/app/deleteTag.php?id='.$t->tId.'">X</a>';
                        }
                        echo '</li>';

                    }

                ?>

            </ul>

        </div>

        <form action="<?php echo get_template_directory_uri(); ?>/app/add_tag.php" method="post" enctype="multipart/form-data">

            <h3>Ajoutez un tag</h3>

            <div>

                <label for="">Nom du tag :</label>

                <input type = "text" name="tag"></input>

            </div>

            <input type="submit" value="Ajouter">

        </form>

    </div>

</div>

<div class="svg_tag">

<svg viewBox="0 0 1083 759" fill="none" xmlns="http://www.w3.org/2000/svg">

<g id="undraw_mention_6k5d 1">

<g clip-path="url(#clip0)">

<path id="Vector" d="M398.304 745.608C591.771 745.608 748.607 588.771 748.607 395.304C748.607 201.836 591.771 45 398.304 45C204.836 45 48 201.836 48 395.304C48 588.771 204.836 745.608 398.304 745.608Z" fill="rgba(242, 242, 242, 0.8)"/>

<path id="Vector_2" d="M541.5 758.562C840.562 758.562 1083 743.577 1083 725.092C1083 706.608 840.562 691.623 541.5 691.623C242.438 691.623 0 706.608 0 725.092C0 743.577 242.438 758.562 541.5 758.562Z" fill="#3d3c4c"/>

<g id="plant5">

<path id="Vector_3" d="M89.8836 712.792V577.612" stroke="#3F3D56" stroke-width="2" stroke-miterlimit="10"/>

<path id="Vector_4" d="M89.8836 596.729C100.441 596.729 109 588.17 109 577.612C109 567.055 100.441 558.496 89.8836 558.496C79.3259 558.496 70.7672 567.055 70.7672 577.612C70.7672 588.17 79.3259 596.729 89.8836 596.729Z" fill="#3F3D56"/>

<path id="Vector_5" d="M89.8836 660.927C89.8836 660.927 87.1527 602.19 31.169 609.018L89.8836 660.927Z" fill="#3F3D56"/>

</g>

<g id="plant4">

<path id="Vector_6" d="M554.773 691L555.451 113.532" stroke="#3F3D56" stroke-width="2" stroke-miterlimit="10"/>

<path id="Vector_7" d="M555.451 139.826C569.973 139.826 581.745 128.054 581.745 113.532C581.745 99.0101 569.973 87.2379 555.451 87.2379C540.93 87.2379 529.157 99.0101 529.157 113.532C529.157 128.054 540.93 139.826 555.451 139.826Z" fill="#3F3D56"/>

<path id="Vector_8" d="M555.451 220.616C555.451 220.616 551.695 139.826 474.691 149.217L555.451 220.616Z" fill="#3F3D56"/>

</g>

<path id="plant3" d="M463.203 443.645C385.789 562.363 407 713.357 407 713.357C407 713.357 553.725 671.871 631.139 553.153C708.553 434.435 687.342 283.441 687.342 283.441C687.342 283.441 540.617 324.927 463.203 443.645Z" fill="#2F2E41"/>

<g id="plant1">

<path id="Vector_9" d="M406.589 711.977C406.589 711.977 404.704 711.676 401.236 710.974C398.469 710.413 394.66 709.611 390.008 708.508C348.428 698.704 237.88 665.564 165.604 578.433C75.1451 469.329 78.9543 316.899 78.9543 316.899C78.9543 316.899 217.27 339.374 308.411 437.351C312.36 441.561 316.203 445.925 319.938 450.443C398.649 545.373 405.987 673.103 406.568 704.679C406.649 709.411 406.589 711.977 406.589 711.977Z" fill="#6091A0"/>

<path id="Vector_10" d="M321.699 451.166C412.642 559.869 409.481 712.313 409.481 712.313C409.481 712.313 258.873 688.515 167.93 579.812C76.9873 471.108 80.1482 318.664 80.1482 318.664C80.1482 318.664 230.756 342.463 321.699 451.166Z" stroke="#3F3D56" stroke-width="2" stroke-miterlimit="10"/>

</g>

<g id="plant2">

<path id="Vector_11" d="M502.511 455.844C505.997 597.53 408.61 714.854 408.61 714.854C408.61 714.854 305.571 602.461 302.085 460.776C298.599 319.09 395.986 201.765 395.986 201.765C395.986 201.765 499.024 314.159 502.511 455.844Z" fill="#6091A0"/>

<path id="Vector_12" d="M408.339 710.854L397.324 207.463" stroke="#3F3D56" stroke-width="2" stroke-miterlimit="10"/>

<path id="Vector_13" d="M502.508 454.323C506.185 596.004 408.957 713.459 408.957 713.459C408.957 713.459 305.767 601.205 302.089 459.525C298.412 317.844 395.64 200.388 395.64 200.388C395.64 200.388 498.831 312.642 502.508 454.323Z" stroke="#3F3D56" stroke-width="2" stroke-miterlimit="10"/>

</g>

<path id="Vector_14" d="M871.294 282.604L848.469 325.62C848.469 325.62 683.427 357.224 704.496 406.386C725.565 455.547 749.268 527.534 761.558 525.778C773.849 524.022 841.446 485.395 844.079 473.983C846.713 462.57 783.505 409.019 783.505 409.019L887.974 388.828C887.974 388.828 902.898 459.059 883.584 507.342C864.271 555.626 852.858 686.431 866.026 688.186C879.195 689.942 912.554 700.477 927.478 690.82C942.402 681.163 949.425 469.593 949.425 469.593C949.425 469.593 981.029 330.888 961.716 315.086C942.402 299.284 871.294 282.604 871.294 282.604Z" fill="#2F2E41"/>

<path id="Vector_15" d="M907.161 666.858C907.161 666.858 886.988 656.24 882.741 664.734C882.741 664.734 885.926 690.216 873.185 693.401C860.444 696.586 855.135 718.883 873.185 721.006C891.234 723.13 902.914 716.759 909.284 716.759C915.654 716.759 909.284 694.463 909.284 694.463L907.161 666.858Z" fill="#2F2E41"/>

<path id="Vector_16" d="M810.945 490.623C810.945 490.623 788.987 484.499 786.627 493.698C786.627 493.698 795.114 517.934 783.332 523.735C771.549 529.535 771.062 552.45 789.153 550.719C807.244 548.989 817.317 540.298 823.545 538.955C829.772 537.612 818.843 517.16 818.843 517.16L810.945 490.623Z" fill="#2F2E41"/>

<path id="Vector_17" d="M920.016 131.169C920.016 131.169 920.894 163.651 914.749 166.284C908.604 168.918 948.986 184.72 948.986 184.72L956.01 172.43C956.01 172.43 948.109 128.535 949.864 125.024C951.62 121.512 920.016 131.169 920.016 131.169Z" fill="#9F616A"/>

<path id="Vector_18" d="M934.665 138.554C964.392 138.554 988.491 114.455 988.491 84.7278C988.491 55.0003 964.392 30.9015 934.665 30.9015C904.937 30.9015 880.839 55.0003 880.839 84.7278C880.839 114.455 904.937 138.554 934.665 138.554Z" fill="#2F2E41"/>

<path id="Vector_19" d="M938.377 56.6105C950.678 56.6105 960.65 46.6385 960.65 34.3375C960.65 22.0365 950.678 12.0645 938.377 12.0645C926.076 12.0645 916.104 22.0365 916.104 34.3375C916.104 46.6385 926.076 56.6105 938.377 56.6105Z" fill="#2F2E41"/>

<path id="Vector_20" d="M908.68 22.273C908.68 16.7675 910.719 11.4572 914.404 7.36651C918.088 3.27577 923.157 0.694423 928.633 0.12043C927.862 0.0403958 927.087 0.000198988 926.312 0C920.405 1.24484e-07 914.74 2.34662 910.563 6.52361C906.386 10.7006 904.039 16.3658 904.039 22.273C904.039 28.1802 906.386 33.8454 910.563 38.0224C914.74 42.1994 920.405 44.546 926.312 44.546C927.087 44.5458 927.862 44.5056 928.633 44.4256C923.157 43.8516 918.088 41.2702 914.404 37.1795C910.719 33.0888 908.68 27.7785 908.68 22.273Z" fill="#2F2E41"/>

<path id="Vector_21" d="M933.185 147.849C953.548 147.849 970.056 131.341 970.056 110.978C970.056 90.6144 953.548 74.1067 933.185 74.1067C912.821 74.1067 896.313 90.6144 896.313 110.978C896.313 131.341 912.821 147.849 933.185 147.849Z" fill="#9F616A"/>

<path id="Vector_22" d="M959.082 158.822C959.082 158.822 927.478 168.479 911.676 158.822C895.875 149.166 858.126 177.258 851.98 189.548C845.835 201.839 874.805 214.129 874.805 214.129C874.805 214.129 866.533 237.863 868.221 249.683C869.977 261.974 866.904 286.993 866.904 286.993C866.904 286.993 944.462 338.091 961.716 315.086C964.349 311.574 986.296 229.053 986.296 229.053L1017.02 198.327C1017.02 198.327 997.709 170.235 986.296 167.601C974.884 164.968 959.082 158.822 959.082 158.822Z" fill="#D0CDE1"/>

<path id="Vector_23" d="M747.073 339.228C747.073 339.228 687.377 369.953 699.668 378.732C711.958 387.511 761.997 344.495 761.997 344.495L747.073 339.228Z" fill="#9F616A"/>

<path id="Vector_24" d="M981.468 317.28C981.468 317.28 954.906 299.347 950.63 308.314C946.353 317.28 979.712 337.472 986.735 329.571C993.759 321.67 981.468 317.28 981.468 317.28Z" fill="#9F616A"/>

<path id="Vector_25" d="M1001.22 188.671L1017.02 198.327C1017.02 198.327 1070.57 272.069 1052.14 288.749C1033.7 305.429 986.297 338.789 986.297 338.789C986.297 338.789 970.495 315.964 975.762 315.086C981.029 314.208 1023.17 279.092 1023.17 279.092L986.297 210.618L1001.22 188.671Z" fill="#D0CDE1"/>

<path id="Vector_26" d="M862.515 185.159L851.103 189.548L821.255 243.099L742.245 338.789C742.245 338.789 752.78 355.468 761.558 351.957C770.337 348.445 836.179 274.703 836.179 274.703L879.195 207.984L862.515 185.159Z" fill="#D0CDE1"/>

<path id="Vector_27" d="M934.665 89.443C955.167 89.443 971.786 79.4711 971.786 67.17C971.786 54.869 955.167 44.8971 934.665 44.8971C914.163 44.8971 897.543 54.869 897.543 67.17C897.543 79.4711 914.163 89.443 934.665 89.443Z" fill="#2F2E41"/>

<path id="Vector_28" d="M858 543.238H685V716.238H858V543.238Z" fill="#6091A0"/>

<path id="tag" d="M835 622.544C835 647.051 823.524 662.497 805.367 662.497C796.073 662.497 788.996 657.536 787.772 650.16H786.449C783.175 657.833 776.428 662.034 767.366 662.034C751.226 662.034 740.445 649.102 740.445 629.854C740.445 611.366 751.292 598.5 767.134 598.5C775.27 598.5 782.183 602.602 785.225 609.315H786.548V600.121H799.744V642.884C799.744 648.209 802.688 651.417 807.979 651.417C817.141 651.417 822.961 640.305 822.961 623.041C822.961 595.491 802.324 577.069 771.831 577.069C741.668 577.069 720.171 599.063 720.171 630.184C720.171 662.001 741.437 682.307 774.543 682.307C780.573 682.342 786.595 681.832 792.534 680.786C793.876 680.528 795.264 680.805 796.404 681.558C797.544 682.31 798.344 683.479 798.633 684.814C798.923 686.148 798.678 687.543 797.953 688.7C797.227 689.857 796.078 690.685 794.75 691.005C787.945 692.535 780.989 693.29 774.014 693.254C733.764 693.221 708 668.35 708 629.754C708 592.084 734.293 566.221 772.625 566.221C809.468 566.221 835 589.207 835 622.544ZM754.699 630.151C754.699 642.388 760.454 649.797 769.813 649.797C779.669 649.797 785.887 642.19 785.887 630.151C785.887 618.113 779.669 610.671 769.979 610.671C760.354 610.671 754.699 617.881 754.699 630.151Z" fill="white"/>

</g>

</g>

<defs>

<clipPath id="clip0">

<rect width="1083" height="758.562" fill="white"/>

</clipPath>

</defs>

</svg>







</div>



<?php  get_footer(); ?>