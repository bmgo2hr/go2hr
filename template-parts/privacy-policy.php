<?php
/**
 * Template Name: PP-template 
 *
  */

get_header();
?>


<main class="inr-page Training-page Recruit-page" id="newsDetail">
         <div class="individual-job-page">
        
         <section class="NewsDetail-content space policy-page">
            <div class="container"> 
               <div class="NewsContent-box">
                  <div class="sharejob-main post-time">
                     <h3><?php echo $title = get_the_title(); ?></h3>
                     <div class="share-job">
                        <ul>
                           <li>Share</li>
                           <li><a target="_blank" href="https://twitter.com/share?url=<?=get_the_permalink();?>&text=<?=$title;?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								  <li><a target="_blank" href="https://www.facebook.com/sharer.php?u=<?=get_the_permalink();?>&t=<?=$title;?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								  <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?=get_the_permalink();?>&t=<?=$title;?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								  <li><a onclick="copyToClipboard('#copy_link')"href="javascript:void(0)"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                        </ul>
                     </div>
                  </div>
                   <?php the_content(); ?>     
                        
                  
               </div>
                   
            </div>
         </section>
          
      </div>
      </main>
      <!-- footer -->



<?php get_footer();
