<?php
// User Post Endpoint
function apiUserPost($request){
    // Get the request parameters
    $email = sanitize_email( $request['email']);
    $username = sanitize_text_field( $request['username']);
    $password = $request['password'];

    // Validate the parameters
    if(empty($email) || empty($username) || empty($password)){
        $response = new WP_Error('error', 'Dados incompletos', ['status' => 406]);
        return rest_ensure_response($response);
    }

    // Check if the email or username already exists
    if(email_exists($email) || username_exists($username)){
        $response = new WP_Error('error', 'Email já existente', ['status' => 403]);
        return rest_ensure_response($response);
    }

    // Create the user
    $response = wp_insert_user([
        'user_email' => $email,
        'user_login' => $username,
        'user_pass' => $password,
        'role' => 'subscriber'
    ]);

    return rest_ensure_response($response);
}

// Register the endpoint
function registerApiUserPost(){
    register_rest_route('api', '/user', [
        'methods' => WP_REST_Server::CREATABLE,
        'callback' => 'apiUserPost'
    ]);
}
add_action('rest_api_init', 'registerApiUserPost');
