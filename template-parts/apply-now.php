<?php
/**
 * Template Name: Apply Now
 *
  */

get_header();?>

<main class="inr-page Training-page Recruit-page" id="newsDetail">
    <div class="individual-job-page">
        <section class="EventSearch space bg-blue">
            <div class="container">
                <div class="individual-width page404">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading-pnel fff text-left">
                                <h2>Apply Now</h2>
                            </div>
                        </div>

                        <div class="col-12 mx-auto">
                            <div class="heading-pnel fff text-left">
                                <p>
                                    <?php echo "Thank you for your interest in this position. To apply, please email your resume and cover letter to <a href = 'mailto:". htmlspecialchars($_GET['email'], ENT_QUOTES)  ."' style='color: white !important;'>". htmlspecialchars($_GET['email'], ENT_QUOTES) ."</a>"; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>



<?php get_footer(); ?>

