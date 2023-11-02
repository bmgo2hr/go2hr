
<?php
$job_board_heading = get_field('job_board_heading', 'option');
$job_board_description = get_field('job_board_description', 'option');
?>

<section class="EventSearch space bg-blue">
                    <div class="container">
                        <div class="individual-width">
                            <div class="row">

                                <?php if(!empty($job_board_heading)):?>
                                    <div class="col-6 mx-auto">
                                        <div class="heading-pnel fff text-left">
                                            <h2><?=$job_board_heading ?></h2>
                                        </div>
                                    </div>
                                <?php endif;?>

                                <div class="col-6 mx-auto">
                                    <div class="heading-pnel fff text-right">
                                        <a href="<?php echo home_url('/dashboard/my-jobs/add-job') ?>" class="btn-border">Post a Job</a>

                                    </div>
                                </div>

                                <?php if(!empty($job_board_description)):?>
                                    <div class="col-12 mx-auto">
                                        <div class="heading-pnel fff text-left">
                                            <p>
                                                <?=$job_board_description ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif;?>

                            </div>

                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="resource-search-form">

                                        <form action="<?php echo home_url( '/' ); ?>" class="searchform" role="search" method="get" id="searchform">
                                            <div class="form-group col">
                                                <div class="input-icon">
                                                    <input type="hidden" name="post_type" value="go2hr_jobs" />
                                                    <input  type="search" class="form-control" id="s" name="search_word" value="<?php get_search_query() ?>" placeholder="Job Title or Keyword" />
                                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/search.png" />
                                                </div>
                                            </div>
                                            <div class="form-group col">
                                                <input class="form-control" name="search_city" value="" placeholder="City/Town" />
                                            </div>
<!--                                            <div class="form-group col d-flex align-items-center">-->
<!--                                                <input class="form-control" name="" value="" placeholder="25" />-->
<!--                                                <p class="fff">Km</p>-->
<!--                                            </div>-->
                                            <div class="EventSearch-btn">
                                                <input type="Submit" value="Search" class="green-btn" id="searchsubmit" />
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
