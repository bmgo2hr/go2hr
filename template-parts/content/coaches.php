 <?php
		  $coach = new WP_Query(array('post_type' => 'our-coaches','post_status' =>'publish','posts_per_page' => 4,'orderby' => 'date','order' => 'DESC'));
		  if ( $coach -> have_posts() ) {
		   while ( $coach -> have_posts() ) { $coach -> the_post();

			$coachTitle = get_the_title();
         $id = get_the_id();
			$coachShortDesc = get_the_excerpt();
			$img = get_the_post_thumbnail_url();
         $email_id = get_field('my_email_id',$id);
         $pdf_link = get_field('biodata_link_pdf',$id);
         if(!empty($email_id)){
            $mailto = "mailto:".$email_id;
         }else{
            $mailto = "#";
         }
         if(!empty($pdf_link)){
            $link = $pdf_link;
         }else{
            $link = "#";
         }
			?>
         <div class="col-md-6 col-sm-6 col-12 pr-0">
            <div class="team-box D-radius">
               <?php if($img){ ?><figure>
                  <img src="<?=$img;?>">
               </figure><?php } ?>
               <figcaption>
                  <?php if($coachTitle){ ?><h4><?=$coachTitle;?></h4><?php } ?>
                  <?php if($coachShortDesc){ ?><p><?=$coachShortDesc;?></p><?php } ?>
                  <div class="member-conct">
                  <?php if(!empty($email_id)){ ?>
                     <p><a href="<?= $mailto ?>"><i class="fa fa-envelope" aria-hidden="true"></i>Connect With <?= $coachTitle ;?></a></p>
                  <?php } if(!empty($pdf_link)){ ?>
                     <p><a href="<?= $pdf_link ?>" target="_blank"><i class="fa fa-search" aria-hidden="true"></i>Find Out What <?= $coachTitle ;?> <br>Can Do for You</a></p>
                  <?php } ?>
                  </div>
               </figcaption>
            </div>
         </div>
		 <?php } } wp_reset_postdata();?>
