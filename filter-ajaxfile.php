<?php
 require_once("./../../../wp-load.php");

global $wp;
$type = $_REQUEST['type'];
$cats = $_REQUEST['type1'];

?>


 <?php 
 if($type){
		$rs = new WP_Query(array('post_type' => 'go2hr_resources','post_status' =>'publish','tax_query' => (
        (
            'taxonomy' => $cats,
            'field' => 'term_id',
            'terms' => $type,
        ),
    ),'posts_per_page' => 10,'orderby' => 'date','order' => 'DESC'));
		if ( $rs -> have_posts() ) {
		while ( $rs -> have_posts() ) { $rs -> the_post();
		  
		  $rsName = get_the_title();
		  $post_id = get_the_ID();
		  $rsShortDesc = get_the_excerpt();
		  $term_name = get_the_term_list( $post_id, 'resource_type', '', ', ' );
		?>
	  <div class="training-prog-box">
		 <?php if(!empty($term_name)){ ?><span class="P-label"><?=$term_name;?></span><?php } ?>
		 <h4><?=$rsName;?></h4>
		 <p><?=$rsShortDesc;?></p>
	  </div>
	  
 <?php } } } wp_reset_postdata(); ?>	



<script>
function get_sortData(id, cat){
var type = id;
var type1 = cat;
if(type!=""){
	$.ajax({
	type:'POST',
	url:'<?=get_template_directory_uri()?>/filter-ajaxfile.php?type='+type&'type1='+cat,
	success:function(response){
		$("#ajaxData").html(response);
	}	
});
}
 	
 }
</script>