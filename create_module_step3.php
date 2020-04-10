<?php /* Template Name: Create Module Etape 3 */ get_header();?>
<h2 class="h2"><?php echo $_SESSION['moduleData']['module']['title']; ?></h2>
<?php 
echo '<pre>';print_r($_SESSION);echo '</pre>';?>
<div class="step3">

  <img src="<?php echo get_template_directory_uri(); ?>/img/modules/<?php echo $_SESSION['moduleData']['module']['title'].'/'.$_SESSION['moduleData']['module']['img']?>" alt="votre image">

  <h3>Étape 3: Confirmation</h3>

  <div class="steps">
      <div class="step">1</div>
      <div class="step">2</div>
      <div class="step stepInto">3</div>
      <div class="stick"></div>
  </div>


  <div class="recap">
      <?php 
      $img = get_template_directory_uri();
      $num = 0;
      foreach($_SESSION['moduleData']['pages'] as $q)
      {
        $num ++;
        echo '
          <div class="pages">
          ';
          if($_SESSION['moduleData']['module']['img'])
          {
            echo ' 
            <div class="medias">
              <img src="'.$img.'/img/modules/'.$_SESSION['moduleData']['module']['title'].'/questions/tonimage" alt="votre image">
            </div>
            <span class="numP">'.$num.'</span>
            <div class="content">
              <h2>'.$q['info']['title'].'</h2>
              <p>'.$q['info']['content'].'</p>
            </div>
            ';
          }
          else
          {
            echo '
                <span class="numP">'.$num.'</span>
                <div class="contentFull content">
                  <h2>'.$q['info']['title'].'</h2>
                  <p>'.$q['info']['content'].'</p>
                </div>
              ';
          }
          echo '</div>';
      };
      ?>
      <!-- <div class="pages">
        <div class="medias">
          <img src="<?php echo get_template_directory_uri(); ?>/img/fall.jpg; ?>" alt="votre image">
        </div>
        <span class="numP">1</span>
        <div class="content">
          <h2>Chapitre 1</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel qui ullam hic earum eum dolore corporis minima, iusto asperiores illum eligendi! Autem nostrum eius molestias omnis pariatur architecto facilis at error corrupti incidunt non exercitationem perspiciatis doloribus accusamus nisi consectetur quae quasi mollitia temporibus nobis, aut excepturi totam aliquid! Error maxime ut placeat veritatis sunt libero natus, corrupti repudiandae quod iure ipsa nam dolor, esse tempore ducimus praesentium autem itaque dolore quos quo reprehenderit blanditiis harum? Eos nesciunt quaerat, amet, earum quis aut quo inventore doloremque suscipit placeat, natus tempora eligendi vel quod veritatis quisquam quasi accusamus animi quidem laboriosam expedita cum rem dolor mollitia. Aspernatur est ab odit cupiditate consequatur, mollitia iusto quo fugit optio molestiae facere architecto quam, illum voluptate nemo a quas voluptatum! Sit facilis voluptatum odio repellendus ratione ipsam earum tempora distinctio. Iusto fugiat unde reiciendis tempore? Libero illo tempora accusamus totam quae. Nemo illum exercitationem, magni recusandae sed nam vel.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur consectetur fugit nostrum magnam aliquam laborum eos ipsa earum. Culpa reiciendis recusandae modi facere iusto vero aspernatur nemo. Officia, velit suscipit!
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil inventore placeat ipsa velit dolores. Officia voluptate amet sunt labore, consequuntur, illo quibusdam ex sed sequi quo odit maiores deleniti animi at doloribus assumenda dolor iure nemo maxime reiciendis repudiandae reprehenderit autem? Asperiores culpa voluptates placeat ducimus maxime dolorem atque, ullam temporibus nobis impedit, ipsam laudantium voluptatibus aspernatur quae est ad fugiat fugit id delectus et minus, explicabo officiis animi dolor. Aliquid, voluptates doloribus! Veniam, eius esse nisi in quam blanditiis aliquam! Et a voluptates autem ratione voluptatem culpa ipsam iure provident explicabo soluta temporibus facere, dicta voluptatum quaerat quae quam dolorum architecto dolorem? Inventore vitae repellat laudantium placeat ipsa, aut reiciendis animi numquam iure odit doloribus cumque ipsum quos non pariatur at perspiciatis aspernatur voluptatibus quam nobis rem? Natus delectus id quos ipsa qui fugit vitae incidunt. Minima repellendus dolore sed, ipsum voluptatum incidunt iure, ab eveniet obcaecati numquam odio cumque reiciendis nesciunt quidem explicabo nisi quo animi sequi? Dolores minus ab voluptatem facilis, perspiciatis at velit sapiente enim, porro perferendis maxime vel. Numquam praesentium porro amet neque earum nesciunt hic consequatur perspiciatis cupiditate fugit, mollitia architecto. Dicta nulla error sint quam sit obcaecati voluptates dolorum repudiandae! Optio magnam ducimus libero magni eligendi quia sapiente voluptatum, doloribus placeat, soluta dolore velit voluptas aspernatur impedit distinctio sit sed totam eveniet. Nihil iure consequatur tempora voluptatibus cum debitis assumenda maiores reprehenderit impedit error harum aspernatur quia eveniet, ducimus vero, ab autem eius praesentium, optio voluptates corporis aliquid amet libero! Dolor nesciunt iusto vel sunt provident. Totam reprehenderit recusandae dolores suscipit officiis nam autem magnam excepturi? Minus at ullam repellendus natus consequatur voluptatum repellat distinctio dolor? Nihil est beatae, sapiente amet tempore repellat, molestiae impedit blanditiis, nemo unde non! Tempora saepe deleniti neque nam sit. Debitis, atque porro? Maiores numquam ipsa possimus architecto sequi laborum veniam et velit magnam ipsam temporibus similique, quae vitae consequatur cumque soluta recusandae est quibusdam quidem suscipit quisquam aliquam placeat earum veritatis? Consequuntur dolores ex omnis sunt maiores, dolore expedita vero minus labore dolorum ad unde eum adipisci culpa dolorem placeat earum eaque a dicta at aut similique. Incidunt consequatur iure facere ipsum alias. Libero optio excepturi et, quae iure provident dolorem dolor voluptatem sapiente similique maxime in beatae facilis eaque consequatur ab, expedita, impedit eveniet voluptate culpa. Velit quam, aperiam optio reprehenderit repudiandae, provident cupiditate ex dolores voluptatibus, nobis ipsum beatae quibusdam. Repudiandae ex quaerat saepe id soluta voluptatum necessitatibus quae, eius ea perspiciatis fugiat minima dignissimos magni vitae vel ipsum quis corrupti ad ab incidunt officiis optio placeat exercitationem? Voluptates omnis ad vitae saepe nam praesentium nobis tenetur unde est quas quae vero dolorem, voluptatum dicta fugiat magnam harum. Dicta ab velit corporis ullam atque totam?
          </p>
        </div>
      </div> -->
  </div>

  <a href="<?php echo get_template_directory_uri(); ?>/app/create_module_3.php">Confirmez la création de votre module</a>

</div>

<?php get_footer();?>