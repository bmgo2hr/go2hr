<section class="search-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="search-box">
                    <form method="get" action="<?php echo home_url(); ?>">
                        <div class="input-box">
                            <input type="text" name="s" class="input" placeholder="What kind of resources are you looking for?" value="<?php echo $args['s'] ?? ""; ?>">
                        </div>
                        <div class="input-btn-box">
                            <button type="submit" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i>
                                <span>Search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
