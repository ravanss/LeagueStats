<?php 
// functions.php
$direcBasetory = get_template_directory();

remove_action('rest_api_init', 'create_initial_rest_routes', 99);

// Include the user_post.php file
require_once $direcBasetory . '/endpoints/user_post.php';

// Change the REST API prefix to 'json'
function change_api(){
    return 'json';
}
add_filter('rest_url_prefix', 'change_api');
?>