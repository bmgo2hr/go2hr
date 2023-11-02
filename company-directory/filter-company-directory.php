<div class="col-12 mb-4 desktop-none">
    <div class="filter-mobile-btn text-right">
        <button class="green-btn filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filters</button>
    </div>
</div>

<div class="col-lg-3 col-md-12 col-12 pr-0">
    <div class="ResourceFilter D-radius">
        <div class="close-filter desktop-none">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>

        <div id="accordion" class="filter-accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Region</a>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                    <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
                        <div class="card-body">
                            <div class="child-checkboxes">
                            <?php if ($terms = get_terms(array('taxonomy' => 'company_region', 'orderby' => 'name', 'hide_empty' => false))) : ?>
                                <?php foreach ($terms as $term) : ?>
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="company_region_filter" value="<?php echo $term->term_id ; ?>" <?php if (in_array($term->term_id, $args['selected_items'] ?? array())) echo " checked"; ?> onclick="formUrl();" id="<?php echo $term->term_id ; ?>">
                                            <?php echo $term->name; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif;?>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="myfilter_company_region">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
