<!-- Section Tab -->
<section class="CanHelp-sec space pt-0">

 <div class="container">
 <?php
    $section3Heading = get_field('section_3_heading');
    $section3Desc = get_field('section_3_description');
    ?>
    <div class="row">
       <div class="col-lg-6 col-12">
          <div class="heading-pnel line-head">
             <?php if($section3Heading): ?><h2><?=$section3Heading;?></h2><?php endif;?>
             <?php if($section3Desc): ?><p><?=$section3Desc;?></p><?php endif; ?>
          </div>
       </div>
    </div>


    <div class="theme-tabs">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mx-auto">

                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                        if(have_rows('hr_accordian')){
                            $flg = 0;
                            while( have_rows('hr_accordian') ){ the_row();
                            $accordianTitle = get_sub_field('accordian_name');
                            if(!empty($accordianTitle)){    $flg++;
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($flg == 1)? 'active':'';?>" data-toggle="tab" href="#Accordian<?=$flg;?>" role="tab"><?=$accordianTitle;?></a>
                            </li><?php } } } ?>

                        </ul><!-- Tab panes -->

                </div>
            </div>

            <!-- tab content -->
            <div class="tab-content">

                <!-- tab one -->
                <?php
                if(have_rows('hr_accordian')){
                    $flag = 0;
                    while( have_rows('hr_accordian') ){ the_row();
                    $accordianImg = get_sub_field('accordian_image');
                    $accordianHeading = get_sub_field('accordian_heading');
                    $flag++;
                    ?>
                <div class="tab-pane fade <?php echo ($flag == 1)? 'active':'';?>" id="Accordian<?=$flag;?>" role="tabpanel">
                <div class="row">
                    <?php if(!empty($accordianImg)){ ?><div class="col-lg-6 col-md-12 col-12 Img_Outer">
                            <div class="tab-grid-img">
                                <img src="<?=$accordianImg;?>" alt="" class="w-100">
                            </div>
                    </div><?php } ?>
                        <div class="col-lg-6 col-md-12 col-12">
                        <div class="tab-grid-content pr-5">

                            <?php if(!empty($accordianHeading)){ ?><h4 class="ml-5 pl-3"><?=$accordianHeading;?></h4><?php } ?>

                            <?php ?>
                            <div class="Recruit-list">
                            <?php
                            if(have_rows('accordian_description')){
                            while( have_rows('accordian_description') ){ the_row();
                                $section1tab1Tittle = get_sub_field('accordian_description_text');
                                $section1tab1Link = get_sub_field('accordian_description_link');

                                if(!empty($section1tab1Tittle)){
                            ?>
                                <div class="Recruit-list-item">
                                    <h3>
                                    <?php $isExternal = strpos($section1tab1Link, str_replace("www.", "", $_SERVER["HTTP_HOST"])) === false; ?>
                                    <a href="<?php echo ($section1tab1Link)? $section1tab1Link : '#';?>" <?php if ($isExternal) echo " target=_blank"; ?>><p><?=$section1tab1Tittle;?> </p>
                                    <span class="icon-light"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow-light.svg"></span>
                                    <span class="icon-dark"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow.svg"></span>
                                    </a></h3>
                                </div>
                            <?php } } } ?>
                                </div>
                        </div>
                    </div>

                    </div>
                </div>
                <?php } } ?>

            </div>

    </div>

 </div>

</section>
