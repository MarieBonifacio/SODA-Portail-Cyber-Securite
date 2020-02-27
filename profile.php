<?php /* Template Name: Profil */ get_header(); 
global $wpdb;
require('app/class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
    $userConnected = new User();
    $userConnected->selectById($id);
}

?>
  <h2>Mon profil</h2>

  <div class="profile">
    <?php
      if(!empty($_SESSION["errorRegister"])){
        echo "<p class='mess error'>".$_SESSION["errorRegister"]."</p>";
        unset($_SESSION["errorRegister"]);
      }
      elseif(!empty($_SESSION["updateOk"])){
        echo "<p class='mess good'>".$_SESSION["updateOk"]."</p>";
        unset($_SESSION["updateOk"]);
      }
    ?>
    <form action="<?php echo get_template_directory_uri(); ?>/app/update_profile.php" method="post" enctype="multipart/form-data">
        <div class="picture">
          <div class="img">
          <img src="<?php echo get_template_directory_uri(); ?>/img/myAvatar.png" alt="avatar">
          <!-- <img src="<?php echo get_template_directory_uri()."/img/avatar/".$userConnected->getImgPath(); ?>" alt="votre photo de profil"> -->
          </div>
          <button type="button" disabled>
            <i class="fas fa-pencil-alt" id="custom-button"></i>
          </button>
          <span id="custom-text">Aucune image séléctionnée</span>
          <input id="real-file" type="file" name="avatar" hidden>
        </div>
        
        <div>
            <label for="last_name">Nom :</label>
            <input type="text" name="last_name" value="<?php echo $userConnected->getLastName();?>">
        </div>
        <div>
            <label for="first_name">Prénom :</label>            
            <input type="text" name="first_name" value="<?php echo $userConnected->getName();?>">
        </div>
        <div>
            <label for="id_user">Identifiant :</label>  
            <input type="text" name="id_user" value="<?php echo $userConnected->getIdUser();?>">
        </div>
        <div>
            <label for="firs-mail">Adresse mail :</label>
            <input type="mail" name="first_mail"  value="<?php echo $userConnected->getMail();?>">
        </div>
        <div>
            <label for="location">Votre site :</label>
            <div class="select">
                <select name="location" id="sites">
                    <option value="<?php echo $userConnected->getLocation();?>"><?php echo $userConnected->getLocation();?></option>
                    <?php 

                    $sites = array('Auxerre', 'Bielsko-Biala', 'Bordeaux', 'Boulogne-Sur-Mer', 'Caen', 'Calais', 'Caldas da Rainha', 'Châteauroux', 'Cracovie', 'Guimarães', 'Île de France', 'Lisbonne', 'Nevers', 'Poitiers', 'Porto', 'Porto Ferreira Dias', 'Stalowa Wola', 'Tauxigny', 'Tunis', 'Varsovie', "Villeneuve d'Ascq");

                    for($i=0; $i<count($sites); $i++){
                        echo '<option value="'.$sites[$i].'">'.$sites[$i].'</option>';
                    }

                    ?>
                </select>
                <i class="fas fa-sort-down"></i>
            </div>
        </div>
        <input type="submit" value="Modifier">
    </form>

  </div>

  <div class="svg">
    <svg class="svg_profile" width="1140" height="811" viewBox="0 0 1140 811" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g id="undraw_freelancer_b0my (1) 1">
        <g clip-path="url(#clip0)">
          <path id="Vector" opacity="0.1" d="M509 810.43C790.113 810.43 1018 756.48 1018 689.93C1018 623.38 790.113 569.43 509 569.43C227.887 569.43 0 623.38 0 689.93C0 756.48 227.887 810.43 509 810.43Z" fill="#7AB9C9"/>
          <path id="Vector_2" d="M124.53 361.42C124.53 361.42 171.94 408.83 145.18 479.21C118.42 549.59 191.06 666.55 191.06 666.55C191.06 666.55 190.28 666.44 188.84 666.18C91.47 648.97 43.08 537.61 97.23 454.87C117.36 424.11 133.84 388.03 124.53 361.42Z" fill="#7AB9C9"/>
          <path id="Vector_3" d="M124.53 361.42C124.53 361.42 151.29 419.53 124.53 466.94C97.77 514.35 119.94 647.41 191.06 666.53" stroke="#535461" stroke-width="2" stroke-miterlimit="10"/>
          <path id="Vector_4" d="M40.09 553.21C40.09 553.21 94.19 544.59 99.09 593.08C103.99 641.57 203.09 648.28 203.09 648.28C203.09 648.28 202.44 648.72 201.23 649.52C119.47 703.21 41.25 683.7 53.04 612.38C57.42 585.86 57.07 559.21 40.09 553.21Z" fill="#7AB9C9"/>
          <path id="Vector_5" opacity="0.2" d="M40.09 553.21C40.09 553.21 94.19 544.59 99.09 593.08C103.99 641.57 203.09 648.28 203.09 648.28C203.09 648.28 202.44 648.72 201.23 649.52C119.47 703.21 41.25 683.7 53.04 612.38C57.42 585.86 57.07 559.21 40.09 553.21Z" fill="#F5F5F5"/>
          <path id="Vector_6" d="M40.09 553.21C40.09 553.21 82.09 562.43 78.63 600.61C75.17 638.79 140.99 684.61 203.14 648.28" stroke="#535461" stroke-width="2" stroke-miterlimit="10"/>
          <path id="Vector_7" opacity="0.1" d="M1122.99 360.852C1116.04 394.912 1080.36 411.992 1060.37 437.402C1022.7 485.292 1037.37 555.242 1061.27 611.262C1069.27 630.022 1078.35 649.872 1074.96 669.982C1070.83 694.582 1048.88 712.562 1025.83 722.102C983.829 739.472 933.529 735.332 894.919 711.312C861.559 690.562 837.659 656.802 803.729 636.992C746.939 603.842 674.659 616.362 612.989 639.202C569.369 655.352 521.669 676.372 478.319 659.482C447.819 647.602 426.729 618.682 415.239 588.032C409.699 573.232 405.669 557.212 395.079 545.482C388.779 538.482 380.559 533.552 372.149 529.382C295.269 491.262 198.149 511.682 123.519 469.382C73.099 440.832 40.809 386.982 26.519 330.822C12.229 274.662 13.889 215.822 17.519 157.942C20.099 116.842 24.729 72.9417 50.989 41.2417C78.769 7.71172 126.399 -4.77828 169.539 1.61172C212.679 8.00172 251.689 30.7217 286.059 57.4917C329.059 90.9617 368.839 132.622 421.569 146.182C457.479 155.412 495.249 150.362 532.289 148.612C594.209 145.692 656.149 152.192 717.719 159.312C747.719 162.782 777.819 166.422 807.559 171.702C814.226 172.882 820.892 174.152 827.559 175.512C830.892 176.178 834.226 176.892 837.559 177.652C840.159 178.222 842.749 178.822 845.339 179.432C849.426 180.392 853.499 181.392 857.559 182.432C869.219 185.432 880.769 188.882 892.199 192.782C931.939 206.352 963.799 230.982 1001.33 248.192C1025.79 259.412 1052.46 262.512 1075.62 276.792C1104.15 294.412 1130.3 325.032 1122.99 360.852Z" fill="#7AB9C9"/>
          <path id="Vector_8" d="M606.14 643.98C606.14 643.98 647.24 640.72 659.07 654.86C670.9 669 713.13 701.42 695.7 708.64C678.27 715.86 584.7 687.03 584.7 687.03L606.14 643.98Z" fill="#FFB9B9"/>
          <path id="Vector_9" d="M437.17 151.77C436.82 147.046 434.915 142.572 431.752 139.045C428.59 135.519 424.348 133.14 419.69 132.28C413.43 131.28 406.44 133.05 401.06 129.68C398.63 128.15 396.89 125.76 394.93 123.68C387.25 115.47 375.72 111.68 364.48 111.35C353.24 111.02 342.16 113.74 331.36 116.85C309.8 123.06 287.02 132.17 275.55 151.45C258.11 180.8 274.2 220.36 260.41 251.59C254.41 265.23 242.97 276.37 239.25 290.81C234.25 310.1 244.11 329.67 251.7 348.09C258.509 364.611 263.68 381.759 267.14 399.29C270.19 414.77 271.89 430.86 268.45 446.29C266.94 453.04 264.45 459.91 265.79 466.69C267.79 476.95 277.71 483.42 286.73 488.69L289.08 490.07C302.08 497.67 315.45 505.43 330.34 507.31C339.59 508.47 349.34 507.19 357.34 502.46C365.34 497.73 371.43 489.29 372.11 480C372.87 469.49 367.02 459.65 365.76 449.18C365.471 447.603 365.591 445.977 366.11 444.46C366.94 442.46 368.87 441.17 370.65 439.93C396.29 422.05 410.04 388.59 404.37 357.85C400.51 336.91 388.51 316.09 394.32 295.6C397.53 284.28 405.8 275.11 410.44 264.3C415.342 252.754 415.952 239.836 412.16 227.88C409.51 219.62 404.71 211.37 406.36 202.88C409.27 187.8 429.36 182.99 436.95 169.63C442.58 159.69 439.25 145.63 429.75 139.31" fill="#B96B6B"/>
          <path id="Vector_10" opacity="0.1" d="M437.17 151.77C436.82 147.046 434.915 142.572 431.752 139.045C428.59 135.519 424.348 133.14 419.69 132.28C413.43 131.28 406.44 133.05 401.06 129.68C398.63 128.15 396.89 125.76 394.93 123.68C387.25 115.47 375.72 111.68 364.48 111.35C353.24 111.02 342.16 113.74 331.36 116.85C309.8 123.06 287.02 132.17 275.55 151.45C258.11 180.8 274.2 220.36 260.41 251.59C254.41 265.23 242.97 276.37 239.25 290.81C234.25 310.1 244.11 329.67 251.7 348.09C258.509 364.611 263.68 381.759 267.14 399.29C270.19 414.77 271.89 430.86 268.45 446.29C266.94 453.04 264.45 459.91 265.79 466.69C267.79 476.95 277.71 483.42 286.73 488.69L289.08 490.07C302.08 497.67 315.45 505.43 330.34 507.31C339.59 508.47 349.34 507.19 357.34 502.46C365.34 497.73 371.43 489.29 372.11 480C372.87 469.49 367.02 459.65 365.76 449.18C365.471 447.603 365.591 445.977 366.11 444.46C366.94 442.46 368.87 441.17 370.65 439.93C396.29 422.05 410.04 388.59 404.37 357.85C400.51 336.91 388.51 316.09 394.32 295.6C397.53 284.28 405.8 275.11 410.44 264.3C415.342 252.754 415.952 239.836 412.16 227.88C409.51 219.62 404.71 211.37 406.36 202.88C409.27 187.8 429.36 182.99 436.95 169.63C442.58 159.69 439.25 145.63 429.75 139.31" fill="black"/>
          <path id="Vector_11" d="M478.5 675.93H263.5V560.93L383.5 606.93L478.5 560.93V675.93Z" fill="#777B9B"/>
          <path id="Vector_12" opacity="0.1" d="M478.5 675.93H263.5V560.93L383.5 606.93L478.5 560.93V675.93Z" fill="black"/>
          <path id="Vector_13" d="M452.5 686.98C452.5 686.98 413.5 696.3 409.5 713.38C405.5 730.46 432.5 728.91 432.5 728.91C432.5 728.91 470.5 721.14 475.5 690.08C480.5 659.02 452.5 686.98 452.5 686.98Z" fill="#FFB9B9"/>
          <path id="Vector_14" opacity="0.1" d="M452.5 686.98C452.5 686.98 413.5 696.3 409.5 713.38C405.5 730.46 432.5 728.91 432.5 728.91C432.5 728.91 470.5 721.14 475.5 690.08C480.5 659.02 452.5 686.98 452.5 686.98Z" fill="black"/>
          <path id="Vector_15" d="M347.77 739.04C347.77 739.04 311 741.43 310.5 771.26C310.43 775.26 348.8 776.42 394.35 751.93C439.9 727.44 443 724.86 443 724.86C443 724.86 425.4 696.5 413 692.64C400.6 688.78 347.77 739.04 347.77 739.04Z" fill="#ABAFCA"/>
          <path id="Vector_16" d="M132.5 624.92C132.5 624.92 90.5 659.92 168.5 708.92C246.5 757.92 321.5 748.92 321.5 748.92C321.5 748.92 402.86 739.29 415.18 701.1C427.5 662.91 354.5 630.92 354.5 630.92C354.5 630.92 274.5 630.92 238.5 607.92C202.5 584.92 132.5 624.92 132.5 624.92Z" fill="#777B9B"/>
          <path id="Vector_17" d="M359.5 564.92C359.5 564.92 395.5 585.92 444.5 564.92C482.2 548.76 564.9 555.1 601.03 558.92C617.97 560.69 632.48 572.36 637.11 588.75C640.89 602.12 638.11 618.55 615.49 633.95C565.49 667.95 530.49 677.95 517.49 691.95C504.49 705.95 467.49 712.95 467.49 712.95C467.49 712.95 420.49 705.95 420.49 695.95C420.49 685.95 463.49 636.95 463.49 636.95C463.49 636.95 400.49 694.95 335.49 616.95C270.49 538.95 359.5 564.92 359.5 564.92Z" fill="#777B9B"/>
          <path id="Vector_18" d="M341.5 423.92L214.5 336.92C214.5 336.92 275.42 295.61 280.65 258.69C281.838 251.492 280.363 244.108 276.5 237.92C251.5 197.92 364.5 237.92 364.5 237.92C365.23 248.336 366.65 258.692 368.75 268.92C373.66 293.27 384.02 325.7 405.5 341.92C442.5 369.92 341.5 423.92 341.5 423.92Z" fill="#FFB9B9"/>
          <path id="Vector_19" opacity="0.1" d="M368.75 268.88C354.932 276.917 338.885 280.267 323.006 278.43C307.127 276.594 292.268 269.669 280.65 258.69C281.838 251.492 280.363 244.108 276.5 237.92C251.5 197.92 364.5 237.92 364.5 237.92C365.232 248.322 366.652 258.665 368.75 268.88Z" fill="black"/>
          <path id="Vector_20" d="M331.5 276.93C372.369 276.93 405.5 243.799 405.5 202.93C405.5 162.061 372.369 128.93 331.5 128.93C290.631 128.93 257.5 162.061 257.5 202.93C257.5 243.799 290.631 276.93 331.5 276.93Z" fill="#FFB9B9"/>
          <path id="Vector_21" opacity="0.1" d="M377.5 300.92C377.5 300.92 362.5 388.92 337.5 383.92C312.5 378.92 234.5 290.92 234.5 290.92C234.5 290.92 153.5 317.92 166.5 383.92C179.5 449.92 192.5 505.92 165.5 526.92C138.5 547.92 121.5 645.92 121.5 645.92C121.5 645.92 207.5 609.92 252.5 623.92C297.5 637.92 343.5 630.92 354.5 617.92C365.5 604.92 381.5 576.92 381.5 576.92C381.5 576.92 358.5 542.92 369.5 525.92C380.5 508.92 394.5 507.92 402.5 459.92C410.5 411.92 473.5 394.92 461.5 367.92C449.5 340.92 426.5 300.92 377.5 300.92Z" fill="black"/>
          <path id="Vector_22" d="M377.5 296.92C377.5 296.92 362.5 384.92 337.5 379.92C312.5 374.92 234.5 286.92 234.5 286.92C234.5 286.92 153.5 313.92 166.5 379.92C179.5 445.92 192.5 501.92 165.5 522.92C138.5 543.92 121.5 641.92 121.5 641.92C121.5 641.92 207.5 605.92 252.5 619.92C297.5 633.92 343.5 626.92 354.5 613.92C365.5 600.92 381.5 572.92 381.5 572.92C381.5 572.92 358.5 538.92 369.5 521.92C380.5 504.92 394.5 503.92 402.5 455.92C410.5 407.92 473.5 390.92 461.5 363.92C449.5 336.92 426.5 296.92 377.5 296.92Z" fill="#CBCDDA"/>
          <g id="Group" opacity="0.05">
            <path id="Vector_23" opacity="0.05" d="M327.5 379.92C329.837 380.361 332.255 380.009 334.37 378.92C306.59 368.2 234.5 286.92 234.5 286.92C234.5 286.92 231.66 287.87 227.12 289.84C240.9 305.15 305.23 375.47 327.5 379.92Z" fill="black"/>
            <path id="Vector_24" opacity="0.05" d="M451.5 363.92C479.08 353.31 400.5 407.92 392.5 455.92C384.5 503.92 370.5 504.92 359.5 521.92C348.5 538.92 371.5 572.92 371.5 572.92C371.5 572.92 355.5 600.92 344.5 613.92C338.2 621.37 320.41 626.83 297.91 627.52C325.05 628.38 347.29 622.43 354.5 613.92C365.5 600.92 381.5 572.92 381.5 572.92C381.5 572.92 358.5 538.92 369.5 521.92C380.5 504.92 394.5 503.92 402.5 455.92C410.5 407.92 445 366.42 451.5 363.92Z" fill="black"/>
            <path id="Vector_25" opacity="0.05" d="M122.27 637.75C121.76 640.42 121.5 641.93 121.5 641.93C121.5 641.93 177.42 618.52 222.68 616.8C187.75 615.35 142.61 630.21 122.27 637.75Z" fill="black"/>
          </g>
          <g id="arm-l">
            <path id="Vector_26" d="M459.135 363C459.135 363 468.135 364 477.135 411C486.135 458 521.135 503 521.135 503C534.969 521.508 545.771 542.098 553.135 564C565.135 600 618.635 647.5 637.635 649.5C637.635 649.5 601.135 686 605.135 696C609.135 706 601.135 696 601.135 696C601.135 696 551.135 677 540.135 646C529.135 615 481.135 565 481.135 565C481.135 565 417.135 441 414.135 421C411.135 401 459.135 363 459.135 363Z" fill="#CBCDDA"/>
          </g>
          <path id="Vector_27" opacity="0.1" d="M179 527.42C179 527.42 256 536.42 273 560.42C290 584.42 368.75 546.48 368.75 546.48" fill="black"/>
          <g id="arm-r">
            <path id="Vector_28" d="M437.5 657.92C437.5 657.92 477.5 647.92 491.5 659.92C505.5 671.92 552.5 696.92 536.5 706.92C520.5 716.92 423.5 703.92 423.5 703.92L437.5 657.92Z" fill="#FFB9B9"/>
            <!-- <path id="Vector_29" opacity="0.1" d="M254.5 390.92C254.5 390.92 287.5 511.92 299.5 526.92C311.5 541.92 404.5 664.92 448.5 656.92C448.5 656.92 435.5 712.92 426.5 714.92C426.5 714.92 335.5 624.92 304.5 625.92C304.5 625.92 247.5 578.92 241.5 555.92C235.5 532.92 187.5 457.92 187.5 457.92C187.5 457.92 163.5 404.92 173.5 381.92C183.5 358.92 236.5 368.92 254.5 390.92Z" fill="black"/> -->
            <path id="Vector_30" d="M255.5 388.92C255.5 388.92 288.5 509.92 300.5 524.92C312.5 539.92 405.5 662.92 449.5 654.92C449.5 654.92 436.5 710.92 427.5 712.92C427.5 712.92 336.5 622.92 305.5 623.92C305.5 623.92 248.5 576.92 242.5 553.92C236.5 530.92 188.5 455.92 188.5 455.92C188.5 455.92 164.5 402.92 174.5 379.92C184.5 356.92 237.5 366.92 255.5 388.92Z" fill="#CBCDDA"/>
          </g>
          <path id="Vector_31" opacity="0.1" d="M385.17 132.77C384.82 128.046 382.915 123.572 379.752 120.045C376.59 116.519 372.348 114.14 367.69 113.28C361.43 112.28 354.44 114.05 349.06 110.68C346.63 109.15 344.89 106.76 342.93 104.68C335.25 96.47 323.72 92.68 312.48 92.35C301.24 92.02 290.16 94.74 279.36 97.85C257.8 104.06 235.02 113.17 223.55 132.45C206.11 161.8 222.2 201.36 208.41 232.59C202.41 246.23 190.97 257.37 187.25 271.81C182.25 291.1 192.11 310.67 199.7 329.09C206.509 345.611 211.68 362.759 215.14 380.29C218.19 395.77 219.89 411.86 216.45 427.29C214.94 434.04 212.45 440.91 213.79 447.69C215.79 457.95 225.71 464.42 234.73 469.69L237.08 471.07C250.08 478.67 263.45 486.43 278.34 488.31C287.59 489.47 297.34 488.19 305.34 483.46C313.34 478.73 319.43 470.29 320.11 461C320.87 450.49 315.02 440.65 313.76 430.18C313.471 428.603 313.591 426.977 314.11 425.46C314.94 423.46 316.87 422.17 318.65 420.93C344.29 403.05 358.04 369.59 352.37 338.85C348.51 317.91 336.51 297.09 342.32 276.6C345.53 265.28 353.8 256.11 358.44 245.3C363.342 233.754 363.952 220.836 360.16 208.88C357.51 200.62 352.71 192.37 354.36 183.88C357.27 168.8 377.36 163.99 384.95 150.63C390.58 140.69 387.25 126.63 377.75 120.31" fill="black"/>
          <path id="Vector_32" d="M383.17 131.77C382.82 127.046 380.915 122.572 377.752 119.045C374.59 115.519 370.348 113.14 365.69 112.28C359.43 111.28 352.44 113.05 347.06 109.68C344.63 108.15 342.89 105.76 340.93 103.68C333.25 95.47 321.72 91.68 310.48 91.35C299.24 91.02 288.16 93.74 277.36 96.85C255.8 103.06 233.02 112.17 221.55 131.45C204.11 160.8 220.2 200.36 206.41 231.59C200.41 245.23 188.97 256.37 185.25 270.81C180.25 290.1 190.11 309.67 197.7 328.09C204.509 344.611 209.68 361.759 213.14 379.29C216.19 394.77 217.89 410.86 214.45 426.29C212.94 433.04 210.45 439.91 211.79 446.69C213.79 456.95 223.71 463.42 232.73 468.69L235.08 470.07C248.08 477.67 261.45 485.43 276.34 487.31C285.59 488.47 295.34 487.19 303.34 482.46C311.34 477.73 317.43 469.29 318.11 460C318.87 449.49 313.02 439.65 311.76 429.18C311.471 427.603 311.591 425.977 312.11 424.46C312.94 422.46 314.87 421.17 316.65 419.93C342.29 402.05 356.04 368.59 350.37 337.85C346.51 316.91 334.51 296.09 340.32 275.6C343.53 264.28 351.8 255.11 356.44 244.3C361.342 232.754 361.952 219.836 358.16 207.88C355.51 199.62 350.71 191.37 352.36 182.88C355.27 167.8 375.36 162.99 382.95 149.63C388.58 139.69 385.25 125.63 375.75 119.31" fill="#B96B6B"/>
          <path id="Vector_33" d="M451.2 767.21C453.033 765.716 454.368 763.7 455.03 761.43C455.53 759.13 454.55 756.38 452.35 755.54C449.89 754.6 447.26 756.3 445.27 758.03C443.28 759.76 440.99 761.72 438.38 761.35C439.721 760.134 440.725 758.591 441.293 756.872C441.861 755.153 441.973 753.316 441.62 751.54C441.507 750.804 441.196 750.113 440.72 749.54C439.35 748.08 436.88 748.71 435.24 749.86C430.04 753.52 428.59 760.58 428.56 766.94C428.04 764.65 428.48 762.26 428.46 759.94C428.44 757.62 427.8 754.94 425.82 753.72C424.592 753.06 423.213 752.733 421.82 752.77C419.48 752.68 416.88 752.92 415.28 754.63C413.28 756.75 413.81 760.32 415.54 762.63C417.27 764.94 419.89 766.43 422.31 768.05C424.25 769.203 425.904 770.779 427.15 772.66C427.297 772.921 427.417 773.196 427.51 773.48H442.14C445.429 771.809 448.477 769.7 451.2 767.21Z" fill="#7AB9C9"/>
          <path id="Vector_34" opacity="0.3" d="M889 228H571V250H889V228Z" fill="#7AB9C9"/>
          <path id="Vector_35" opacity="0.3" d="M889 323H571V345H889V323Z" fill="#7AB9C9"/>
          <path id="Vector_36" opacity="0.3" d="M889 422H571V444H889V422Z" fill="#7AB9C9"/>
          <path id="Vector_37" opacity="0.3" d="M619 171H599V228H619V171Z" fill="#7AB9C9"/>
          <path id="Vector_38" opacity="0.3" d="M619 180H599V184H619V180Z" fill="#7AB9C9"/>
          <path id="Vector_39" opacity="0.3" d="M619 211H599V215H619V211Z" fill="#7AB9C9"/>
          <path id="Vector_40" opacity="0.3" d="M649 171H629V228H649V171Z" fill="#7AB9C9"/>
          <path id="Vector_41" opacity="0.3" d="M649 180H629V184H649V180Z" fill="#7AB9C9"/>
          <path id="Vector_42" opacity="0.3" d="M649 211H629V215H649V211Z" fill="#7AB9C9"/>
          <path id="Vector_43" opacity="0.3" d="M679 171H659V228H679V171Z" fill="#7AB9C9"/>
          <path id="Vector_44" opacity="0.3" d="M679 180H659V184H679V180Z" fill="#7AB9C9"/>
          <path id="Vector_45" opacity="0.3" d="M679 211H659V215H679V211Z" fill="#7AB9C9"/>
          <path id="Vector_46" opacity="0.3" d="M709 171H689V228H709V171Z" fill="#7AB9C9"/>
          <path id="Vector_47" opacity="0.3" d="M709 180H689V184H709V180Z" fill="#7AB9C9"/>
          <path id="Vector_48" opacity="0.3" d="M709 211H689V215H709V211Z" fill="#7AB9C9"/>
          <path id="Vector_49" opacity="0.3" d="M739 171H719V228H739V171Z" fill="#7AB9C9"/>
          <path id="Vector_50" opacity="0.3" d="M739 180H719V184H739V180Z" fill="#7AB9C9"/>
          <path id="Vector_51" opacity="0.3" d="M739 211H719V215H739V211Z" fill="#7AB9C9"/>
          <path id="Vector_52" opacity="0.3" d="M769 171H749V228H769V171Z" fill="#7AB9C9"/>
          <path id="Vector_53" opacity="0.3" d="M769 180H749V184H769V180Z" fill="#7AB9C9"/>
          <path id="Vector_54" opacity="0.3" d="M769 211H749V215H769V211Z" fill="#7AB9C9"/>
          <path id="Vector_55" opacity="0.3" d="M799 171H779V228H799V171Z" fill="#7AB9C9"/>
          <path id="Vector_56" opacity="0.3" d="M799 180H779V184H799V180Z" fill="#7AB9C9"/>
          <path id="Vector_57" opacity="0.3" d="M799 211H779V215H799V211Z" fill="#7AB9C9"/>
          <path id="Vector_58" opacity="0.3" d="M787.164 363.497L769.286 372.462L794.835 423.415L812.713 414.451L787.164 363.497Z" fill="#7AB9C9"/>
          <path id="Vector_59" opacity="0.3" d="M791.204 371.539L773.325 380.504L775.118 384.079L792.996 375.115L791.204 371.539Z" fill="#7AB9C9"/>
          <path id="Vector_60" opacity="0.3" d="M805.091 399.254L787.212 408.218L789.005 411.794L806.883 402.83L805.091 399.254Z" fill="#7AB9C9"/>
          <path id="Vector_61" opacity="0.3" d="M619 267H599V324H619V267Z" fill="#7AB9C9"/>
          <path id="Vector_62" opacity="0.3" d="M619 276H599V280H619V276Z" fill="#7AB9C9"/>
          <path id="Vector_63" opacity="0.3" d="M619 307H599V311H619V307Z" fill="#7AB9C9"/>
          <path id="Vector_64" opacity="0.3" d="M649 267H629V324H649V267Z" fill="#7AB9C9"/>
          <path id="Vector_65" opacity="0.3" d="M649 276H629V280H649V276Z" fill="#7AB9C9"/>
          <path id="Vector_66" opacity="0.3" d="M649 307H629V311H649V307Z" fill="#7AB9C9"/>
          <path id="Vector_67" opacity="0.3" d="M679 267H659V324H679V267Z" fill="#7AB9C9"/>
          <path id="Vector_68" opacity="0.3" d="M679 276H659V280H679V276Z" fill="#7AB9C9"/>
          <path id="Vector_69" opacity="0.3" d="M679 307H659V311H679V307Z" fill="#7AB9C9"/>
          <path id="Vector_70" opacity="0.3" d="M804 267H784V324H804V267Z" fill="#7AB9C9"/>
          <path id="Vector_71" opacity="0.3" d="M804 276H784V280H804V276Z" fill="#7AB9C9"/>
          <path id="Vector_72" opacity="0.3" d="M804 307H784V311H804V307Z" fill="#7AB9C9"/>
          <path id="Vector_73" opacity="0.3" d="M834 267H814V324H834V267Z" fill="#7AB9C9"/>
          <path id="Vector_74" opacity="0.3" d="M834 276H814V280H834V276Z" fill="#7AB9C9"/>
          <path id="Vector_75" opacity="0.3" d="M834 307H814V311H834V307Z" fill="#7AB9C9"/>
          <path id="Vector_76" opacity="0.3" d="M864 267H844V324H864V267Z" fill="#7AB9C9"/>
          <path id="Vector_77" opacity="0.3" d="M864 276H844V280H864V276Z" fill="#7AB9C9"/>
          <path id="Vector_78" opacity="0.3" d="M864 307H844V311H864V307Z" fill="#7AB9C9"/>
          <path id="Vector_79" opacity="0.3" d="M619 365H599V422H619V365Z" fill="#7AB9C9"/>
          <path id="Vector_80" opacity="0.3" d="M619 374H599V378H619V374Z" fill="#7AB9C9"/>
          <path id="Vector_81" opacity="0.3" d="M619 405H599V409H619V405Z" fill="#7AB9C9"/>
          <path id="Vector_82" opacity="0.3" d="M649 365H629V422H649V365Z" fill="#7AB9C9"/>
          <path id="Vector_83" opacity="0.3" d="M649 374H629V378H649V374Z" fill="#7AB9C9"/>
          <path id="Vector_84" opacity="0.3" d="M649 405H629V409H649V405Z" fill="#7AB9C9"/>
          <path id="Vector_85" opacity="0.3" d="M679 365H659V422H679V365Z" fill="#7AB9C9"/>
          <path id="Vector_86" opacity="0.3" d="M679 374H659V378H679V374Z" fill="#7AB9C9"/>
          <path id="Vector_87" opacity="0.3" d="M679 405H659V409H679V405Z" fill="#7AB9C9"/>
          <path id="Vector_88" opacity="0.3" d="M709 365H689V422H709V365Z" fill="#7AB9C9"/>
          <path id="Vector_89" opacity="0.3" d="M709 374H689V378H709V374Z" fill="#7AB9C9"/>
          <path id="Vector_90" opacity="0.3" d="M709 405H689V409H709V405Z" fill="#7AB9C9"/>
          <path id="Vector_91" opacity="0.3" d="M739 365H719V422H739V365Z" fill="#7AB9C9"/>
          <path id="Vector_92" opacity="0.3" d="M739 374H719V378H739V374Z" fill="#7AB9C9"/>
          <path id="Vector_93" opacity="0.3" d="M739 405H719V409H739V405Z" fill="#7AB9C9"/>
          <path id="Vector_94" opacity="0.3" d="M769 365H749V422H769V365Z" fill="#7AB9C9"/>
          <path id="Vector_95" opacity="0.3" d="M769 374H749V378H769V374Z" fill="#7AB9C9"/>
          <path id="Vector_96" opacity="0.3" d="M769 405H749V409H769V405Z" fill="#7AB9C9"/>
          <path id="Vector_97" opacity="0.3" d="M829 176.07V227.99H809V172.26C815.693 173.44 822.36 174.71 829 176.07Z" fill="#7AB9C9"/>
          <path id="Vector_98" opacity="0.3" d="M829 180H809V184H829V180Z" fill="#7AB9C9"/>
          <path id="Vector_99" opacity="0.3" d="M829 211H809V215H829V211Z" fill="#7AB9C9"/>
          <path id="Vector_100" opacity="0.3" d="M859 183.01V228.01H839V178.21C841.6 178.78 844.19 179.38 846.78 179.99C850.873 180.95 854.947 181.957 859 183.01Z" fill="#7AB9C9"/>
          <path id="Vector_101" opacity="0.3" d="M859 183.01V184.01H839V180.01H846.78C850.873 180.957 854.947 181.957 859 183.01Z" fill="#7AB9C9"/>
          <path id="Vector_102" opacity="0.3" d="M859 211H839V215H859V211Z" fill="#7AB9C9"/>
          <path id="Vector_103" opacity="0.55" d="M146.7 199.08C167.317 199.08 184.03 182.367 184.03 161.75C184.03 141.133 167.317 124.42 146.7 124.42C126.083 124.42 109.37 141.133 109.37 161.75C109.37 182.367 126.083 199.08 146.7 199.08Z" fill="black"/>
          <path id="Vector_104" opacity="0.6" d="M146.7 193.43C164.196 193.43 178.38 179.246 178.38 161.75C178.38 144.254 164.196 130.07 146.7 130.07C129.204 130.07 115.02 144.254 115.02 161.75C115.02 179.246 129.204 193.43 146.7 193.43Z" fill="white"/>
          <path id="Vector_105" d="M146.7 164.01C147.948 164.01 148.96 162.998 148.96 161.75C148.96 160.502 147.948 159.49 146.7 159.49C145.452 159.49 144.44 160.502 144.44 161.75C144.44 162.998 145.452 164.01 146.7 164.01Z" fill="black"/>
          <path id="Vector_106" d="M160.28 138L147.82 159.8" stroke="black" stroke-miterlimit="10"/>
          <path id="Vector_107" d="M160.84 169.11L148.74 162.74" stroke="black" stroke-miterlimit="10"/>
          <path id="Vector_108" d="M579.19 715.48H474.76C471.17 715.48 468.26 718.39 468.26 721.98V725.57C468.26 729.16 471.17 732.07 474.76 732.07H579.19C582.78 732.07 585.69 729.16 585.69 725.57V721.98C585.69 718.39 582.78 715.48 579.19 715.48Z" fill="#535461"/>
          <g id="Group_2" opacity="0.7">
            <path id="Vector_109" opacity="0.7" d="M803.36 530.49H567.95C552.365 530.49 539.73 543.125 539.73 558.71V704.07C539.73 719.655 552.365 732.29 567.95 732.29H803.36C818.945 732.29 831.58 719.655 831.58 704.07V558.71C831.58 543.125 818.945 530.49 803.36 530.49Z" fill="url(#paint0_linear)"/>
          </g>
            <path id="Vector_110" d="M794.57 534.21H571.78C556.957 534.21 544.94 546.227 544.94 561.05V705.44C544.94 720.263 556.957 732.28 571.78 732.28H794.57C809.393 732.28 821.41 720.263 821.41 705.44V561.05C821.41 546.227 809.393 534.21 794.57 534.21Z" fill="#3E3F49"/>
            <path id="Vector_111" d="M798.4 534.21H575.61C560.787 534.21 548.77 546.227 548.77 561.05V705.44C548.77 720.263 560.787 732.28 575.61 732.28H798.4C813.223 732.28 825.24 720.263 825.24 705.44V561.05C825.24 546.227 813.223 534.21 798.4 534.21Z" fill="#535461"/>
            <path id="Vector_112" d="M699.92 640.81C704.852 640.81 708.85 636.812 708.85 631.88C708.85 626.948 704.852 622.95 699.92 622.95C694.988 622.95 690.99 626.948 690.99 631.88C690.99 636.812 694.988 640.81 699.92 640.81Z" fill="#E0E0E0"/>
          <g id="apple">
            <path id="Vector_113" d="M222.56 720.33C222.56 720.33 206.68 714.95 199.04 728.94C197.024 732.733 195.999 736.974 196.058 741.269C196.118 745.564 197.26 749.774 199.38 753.51C204.38 762.58 214.74 774.36 234.38 773.31C251 772.42 256.53 759.74 258.03 747.94C258.605 743.516 258.035 739.018 256.373 734.878C254.712 730.737 252.016 727.092 248.543 724.292C245.069 721.492 240.935 719.631 236.536 718.886C232.138 718.142 227.621 718.539 223.42 720.04L222.56 720.33Z" fill="#81CE89"/>
            <path id="Vector_114" opacity="0.1" d="M202.74 754.77C200.62 751.034 199.478 746.824 199.418 742.529C199.359 738.234 200.384 733.993 202.4 730.2C210.04 716.2 225.92 721.59 225.92 721.59L226.73 721.3C232.785 719.109 239.44 719.259 245.39 721.72C242.106 719.765 238.43 718.563 234.626 718.199C230.822 717.836 226.984 718.321 223.39 719.62L222.58 719.91C222.58 719.91 206.7 714.53 199.06 728.52C197.044 732.313 196.019 736.554 196.078 740.849C196.138 745.144 197.28 749.354 199.4 753.09C202.71 759.09 208.32 766.2 217.4 770.09C211.204 766.421 206.133 761.122 202.74 754.77Z" fill="white"/>
            <path id="Vector_115" opacity="0.2" d="M214.36 727.06C214.36 727.06 220.25 731.69 234.54 727.06H214.36Z" fill="black"/>
            <path id="Vector_116" d="M213.1 693.42C213.1 693.42 223.19 720.75 222.35 727.9L230.35 727.06C230.35 727.06 216.89 703.06 220.26 693.42H213.1Z" fill="#845635"/>
            <path id="Vector_117" opacity="0.2" d="M213.1 693.42C213.1 693.42 223.19 720.75 222.35 727.9L230.35 727.06C230.35 727.06 216.89 703.06 220.26 693.42H213.1Z" fill="black"/>
            <path id="Vector_118" d="M254.29 695.71C254.29 695.71 238.41 687.59 231.29 694.3C224.17 701.01 223.09 718.16 223.09 718.16C223.09 718.16 249 721.72 254.29 695.71Z" fill="#2E5321"/>
            <path id="Vector_119" opacity="0.1" d="M254.29 695.71C254.29 695.71 238.41 687.59 231.29 694.3C224.17 701.01 223.09 718.16 223.09 718.16C223.09 718.16 249 721.72 254.29 695.71Z" fill="white"/>
            <path id="Vector_120" d="M223.1 718.16C223.1 718.16 227.27 698.25 254.29 695.71" stroke="#11220D" stroke-miterlimit="10"/>
          </g>
          <g id="apple_2">
            <path id="Vector_121" d="M730.457 304.236C730.457 304.236 724.791 302.316 722.065 307.308C721.346 308.662 720.98 310.175 721.001 311.707C721.022 313.24 721.43 314.742 722.186 316.075C723.97 319.312 727.667 323.515 734.675 323.141C740.606 322.823 742.579 318.298 743.114 314.088C743.319 312.509 743.116 310.904 742.523 309.427C741.93 307.949 740.968 306.649 739.729 305.65C738.489 304.651 737.014 303.986 735.445 303.721C733.875 303.455 732.263 303.597 730.764 304.132L730.457 304.236Z" fill="#81CE89"/>
            <path id="Vector_122" opacity="0.1" d="M723.385 316.525C722.629 315.192 722.221 313.69 722.2 312.157C722.179 310.624 722.545 309.111 723.264 307.758C725.99 302.762 731.656 304.686 731.656 304.686L731.945 304.582C734.106 303.8 736.481 303.854 738.604 304.732C737.432 304.034 736.12 303.605 734.763 303.476C733.405 303.346 732.036 303.519 730.754 303.983L730.465 304.086C730.465 304.086 724.798 302.166 722.072 307.158C721.353 308.512 720.987 310.025 721.008 311.558C721.029 313.09 721.437 314.593 722.193 315.926C723.374 318.067 725.376 320.604 728.616 321.992C726.405 320.682 724.596 318.792 723.385 316.525Z" fill="white"/>
            <path id="Vector_123" opacity="0.2" d="M727.531 306.637C727.531 306.637 729.633 308.289 734.732 306.637Z" fill="black"/>
            <path id="Vector_124" d="M727.082 294.634C727.082 294.634 730.682 304.386 730.383 306.937L733.237 306.637C733.237 306.637 728.434 298.074 729.637 294.634H727.082Z" fill="#845635"/>
            <path id="Vector_125" opacity="0.2" d="M727.082 294.634C727.082 294.634 730.682 304.386 730.383 306.937L733.237 306.637C733.237 306.637 728.434 298.074 729.637 294.634H727.082Z" fill="black"/>
            <path id="Vector_126" d="M741.78 295.451C741.78 295.451 736.113 292.553 733.573 294.948C731.032 297.342 730.647 303.462 730.647 303.462C730.647 303.462 739.892 304.732 741.78 295.451Z" fill="#2E5321"/>
            <path id="Vector_127" opacity="0.1" d="M741.78 295.451C741.78 295.451 736.113 292.553 733.573 294.948C731.032 297.342 730.647 303.462 730.647 303.462C730.647 303.462 739.892 304.732 741.78 295.451Z" fill="white"/>
            <path id="Vector_128" d="M730.65 303.462C730.65 303.462 732.138 296.357 741.78 295.451" stroke="#11220D" stroke-miterlimit="10"/>
          </g>
        </g>
      </g>
      <defs>
        <linearGradient id="paint0_linear" x1="685.66" y1="732.28" x2="685.66" y2="530.49" gradientUnits="userSpaceOnUse">
          <stop stop-color="#808080" stop-opacity="0.25"/>
          <stop offset="0.54" stop-color="#808080" stop-opacity="0.12"/>
          <stop offset="1" stop-color="#808080" stop-opacity="0.1"/>
        </linearGradient>
        <clipPath id="clip0">
          <rect width="1139.67" height="810.43" fill="white"/>
        </clipPath>
      </defs>
    </svg>
  </div>

<?php get_footer()?>
