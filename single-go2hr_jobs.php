<?php get_header() ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php
            $job_company = get_field('field_5946b72feab10');
        ?>
      <?php $job_application_action_address = get_field('job_application_action_address'); ?>

      <?php
          $isEmail = filter_var($job_application_action_address, FILTER_VALIDATE_EMAIL);
      ?>

      <?php $posted_date = get_the_date(); ?>
      <?php $job_positions = get_field('job_positions'); ?>
      <?php $job_qualifications = get_field('job_qualifications'); ?>
      <?php $job_salary = get_field('job_salary'); ?>
      <?php $job_application_process = get_field('job_application_process'); ?>
      <?php $job_address = get_field('job_address_1'); ?>
      <?php $assessible_employer = get_field('assessible_employer'); ?>
      <?php $is_open_work_permit = get_field('is_open_work_permit'); ?>
      <?php $benefits = get_field('benefits'); ?>
      <?php

            $training = array(
                'zs4t' => 'BSAFE - BC Safety Assured For Everyone',
                '65krb' => 'SuperHost Foundations of Service Quality',
                'qrxud' => 'SuperHost Service For All',
                'kvdrq' => 'Foundations of Workplace Safety (includes WHMIS)',
                'xjld8' => 'FOODSAFE Level 1 by Distance Education',
                'hml25' => 'Serving It Right',
            );

            $suggested_training = get_field('suggested_training');

      ?>

      <main class="inr-page Training-page Recruit-page" id="newsDetail">
         <div class="individual-job-page">
            <!-- section -->
            <section class="EventDetail-sec space">
               <div class="container">
                  <div class="individual-width">
                     <div class="row justify-content-between align-items-center">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                           <div class="EventDetail-content">

                              <h2><?php the_title() ?></h2>

                              <ul>
                                 <?php

                                 if (!empty($job_company->post_title)) : ?>
                                    <li><?php echo esc_html($job_company->post_title); ?> </li>
                                 <?php endif; ?>

                                 <?php
                                 //Level
                                 if (!empty(get_the_terms(get_the_ID(), 'jobs_levels'))) :
                                    foreach (get_the_terms(get_the_ID(), 'jobs_levels') as $jobs_levels) {
                                       echo '<li>' . __($jobs_levels->name) . '</li>';
                                    }
                                 endif;
                                 ?>

                                 <ul class="d-flex m-0">

                                    <?php
                                    //Type
                                    if (!empty(get_the_terms(get_the_ID(), 'jobs_types'))) :
                                       foreach (get_the_terms(get_the_ID(), 'jobs_types') as $jobs_types) {
                                          echo '<li>' . __($jobs_types->name) . '&nbsp;|&nbsp; </li>';
                                       }
                                    endif;

                                    //Status
                                    if (!empty(get_the_terms(get_the_ID(), 'jobs_status'))) :
                                       foreach (get_the_terms(get_the_ID(), 'jobs_status') as $jobs_status) {
                                          echo '<li>' . __($jobs_status->name) . ' </li>';
                                       }
                                    endif;
                                    ?>
                                 </ul>
                                 <?php if ((strtotime($posted_date) - strtotime(date('2023-04-17 17:00:00'))) > 0 && !empty($job_address)) : ?>
                                    <li><?php echo $job_address; ?> </li>
                                 <?php elseif (!empty(get_field('company_locations', $job_company->ID)[0]['company_address'])) : ?>
                                    <li class="m-0"><?php echo get_field('company_locations', $job_company->ID)[0]['company_address'] ?> </li>
                                    <ul class="d-flex m-0">
                                       <li><?php echo get_field('company_locations', $job_company->ID)[0]['company_city'] ?> </li>,&nbsp;
                                       <li><?php echo get_field('company_locations', $job_company->ID)[0]['company_postal_code'] ?> </li>
                                    </ul>
                                 <?php endif; ?>

                                 <?php if (!empty($job_positions)) : ?>
                                    <li> <?php echo $job_positions; ?> position available</li>
                                 <?php endif; ?>

                                 <?php if (!empty(($assessible_employer['label']))) : ?>
                                    <li>Accessible Employer: <?php echo esc_html($assessible_employer['label']) ?></li>
                                 <?php endif; ?>

                                 <?php if (!empty($is_open_work_permit['label'])) : ?>
                                    <li>Open to International applicants with valid Canadian Work permits: <?php echo ($is_open_work_permit['label']); ?></li>
                                 <?php endif; ?>

                              </ul>

                              <?php
                              if (!empty($job_application_action_address)) : ?>
                                <?php if ($isEmail) : ?>
<!--                                    <a href = "mailto: --><?php //echo $job_application_action_address ?><!--" class="green-btn">Apply Now <i class="fa fa-angle-right" aria-hidden="true"></i></a>-->
                                      <a href="/apply-now?email=<?php echo $job_application_action_address; ?>" target="_blank" class="green-btn">Apply Now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <?php else : ?>
                                    <a target="_blank" href="<?php echo $job_application_action_address ?>" class="green-btn"> Apply Now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <?php endif; ?>
                              <?php endif; ?>

                           </div>
                        </div>


                        <?php if (!empty(get_field('company_id', $job_company->ID))) : ?>
                           <div class="col-lg-5 col-md-5 col-sm-6  col-12 Img_Outer">
                              <div class="EventDetail-img">
                                 <img src="<?php echo get_field('company_id', $job_company->ID) ?>" class="w-100" alt="" />
                              </div>
                           </div>
                        <?php else : ?>
                           <div class="col-lg-5 col-md-5 col-sm-6  col-12 Img_Outer">
                              <div class="EventDetail-img">
                                 <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/no-company-logo.png" class="w-100" alt="" />
                              </div>
                           </div>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
            </section>
            <!-- section -->
            <section class="NewsDetail-content space ">
               <div class="container">
                  <div class="NewsContent-box">
                     <div class="sharejob-main post-time">
                        <p class="d-flex align-items-center"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/account/date.png" style="height: 14px; margin-right: 10px;">

                           Posted on <?php echo date("F j, Y", strtotime($posted_date)); ?>

                        </p>
                        <div class="share-job">
                           <ul>
                              <li><a target="_blank" href="https://twitter.com/intent/tweet?url=<?= get_the_permalink(); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                              <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= get_the_permalink(); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                              <li><a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= get_the_permalink(); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>

                              <li><a target="_blank" href="<?php the_permalink() ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                           </ul>
                        </div>
                     </div>



                     <?php if (!empty(get_the_content())) : ?>
                        <h3>Job Description</h3>
                        <?php the_content(); ?>
                     <?php endif; ?>

                     <?php if (!empty($job_qualifications)) :
                        echo '<h3 class="mt-5">Responsibilities & Qualifications</h3>';
                        echo $job_qualifications;
                     endif; ?>


                     <?php if (!empty($job_salary)) :
                        echo '<h3 class="mt-5">Salary/Wage</h3>';
                        echo '<p>' . $job_salary . '</p>';
                     endif; ?>

                     <?php if (!empty($benefits)) :
                        echo '<h3 class="mt-5">Other Perks/Benefits</h3>';
                        echo '<p>' . $benefits . '</p>';
                     endif; ?>

                      <?php if (!empty($suggested_training)) :?>
                        <?php echo '<h3 class="mt-5">Recommended Training</h3>'; ?>
                        <?php $output_training = ''; ?>
                        <?php foreach (explode(",", $suggested_training) as $key => $item) : ?>
                            <?php if ($key !== 0) { $output_training .= ", "; } ?>
                            <?php $output_training .= $training[trim($item)]; ?>
                        <?php endforeach; ?>

                        <?php echo '<p>' . $output_training . '</p>'; ?>
                     <?php endif; ?>

                     <?php if (!empty($job_application_process)) :
                        echo '<h3 class="mt-5">Job Application Process</h3>';
                        echo $job_application_process;
                     endif; ?>

                     <?php
                     if (!empty($job_application_action_address)) : ?>
                        <?php if ($isEmail) : ?>
                            <a href = "mailto: <?php echo $job_application_action_address ?>" class="green-btn">Apply Now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <?php else : ?>
                            <a target="_blank" href="<?php echo $job_application_action_address ?>" class="green-btn"> Apply Now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <?php endif; ?>
                     <?php endif; ?>

                  </div>

               </div>
         </div>
         </section>

         </div>
      </main>

   <?php endwhile;
else : ?>
   <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>


<?php get_footer() ?>
