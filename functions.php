<?php 
// functions.php
$direcBasetory = get_template_directory();

remove_action('rest_api_init', 'create_initial_rest_routes', 99);

// require the endpoint files
require_once $direcBasetory . '/endpoints/user_post.php';
require_once $direcBasetory . '/endpoints/user_get.php';

// Change the REST API prefix to 'json'
function change_api(){
    return 'json';
}
add_filter('rest_url_prefix', 'change_api');

/*function expireToker(){
    return time() + (60 * 60 * 24); // 1 day
}
add_action('jwt_auth_expire', 'expireToker');*/