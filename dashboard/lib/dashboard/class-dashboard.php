<?php
    class G2hr_Dashboard {


        function logout() {
            check_ajax_referer( 'g2hr_dashboard', 'nonce' );
            wp_logout();

            ob_clean();

            wp_send_json_success(
                array(
                  'title'            =>    __( 'Done!', 'go2hr' ),
                  'message'        =>    __( 'You have successfully logged out', 'go2hr' ),
                ),
                200
            );
            die();

        }

    }
