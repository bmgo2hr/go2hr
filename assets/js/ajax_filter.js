function get_sortData(id,cat) {
 
 alert(id, cat);
	$.ajax({
	type:'POST',
	dataType : "html",
	url : <?php echo site_url(); ?>"/wp-admin/admin-ajax.php",
	data : {action: "myfilter",
	        slug  : id,
			category_slug : cat,
		  },
        success:function(data){
	    //success:function(response){
		$('#ajaxData').html(data); 
		//$("#ajaxData").html(response);
	}	
});
return false;

}
