<?php
    namespace Go2HR\Helpers\MyUsers;

    /**
    * Register AJAX handling actions for jobs form
    */
    add_action( 'wp_ajax_nopriv_g2hruserdelete', array(new \G2hr_User_List(), 'delete') );
    add_action( 'wp_ajax_g2hruserdelete', array(new \G2hr_User_List(), 'delete') );

