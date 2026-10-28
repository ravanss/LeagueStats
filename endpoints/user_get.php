<?php
// User Get Endpoint
function apiUserGet($request){
    $user  = wp_get_current_user();
    $user_id = $user->ID;

    if($user_id === 0){
        $response = new WP_Error('error', 'Usuário sem permissão', ['status' => 401]);
        return rest_ensure_response($response);
    }

    $response = [
        'id' => $user_id,
        'username' => $user->user_login,
        'nome' => $user->display_name,
        'email' => $user->user_email
    ];

    return rest_ensure_response($response);
}

// Register the endpoint
function registerApiUserGet(){
    register_rest_route('api', '/user', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'apiUserGet'
    ]);
}
add_action('rest_api_init', 'registerApiUserGet');
