<?php 

include_once('vendor/autoload.php');
include_once( 'bap.php' );

$app = new \Slim\Slim();
$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'BAP')));


/* API POST REQUEST Handler or Dispatcher */

$app->post("/on_search", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_search( $body );

  echo $response;
  
});

$app->post("/on_select", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_select( $body );

  echo $response;
  
});

$app->post("/on_init", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_init( $body );

  echo $response;
  
});

$app->post("/on_confirm", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_confirm( $body );

  echo $response;
  
});

$app->post("/on_status", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_status( $body );

  echo $response;
  
});

$app->post("/on_track", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_track( $body );

  echo $response;
  
});

$app->post("/on_cancel", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_track( $body );

  echo $response;
  
});

$app->post("/on_update", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_update( $body );

  echo $response;
  
});

$app->post("/on_rating", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $response = $request->on_rating( $body );

  echo $response;
  
});

/* ------------ END POST REQUESTS --------------- */

$app->post("/search_by_pickup_and_drop_location", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->search_by_pickup_and_drop_location( $body );

  echo $send_request;	

});

$app->post("/select_agency", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->select_agency( $body );

  echo $send_request; 

});

$app->post("/initialize_order", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->initialize_order( $body );

  echo $send_request; 

});

$app->post("/confirm_order", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->confirm_order( $body );

  echo $send_request; 

});

$app->post("/order_status", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->order_status( $body );

  echo $send_request; 

});

$app->post("/cancel_order", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->order_status( $body );

  echo $send_request; 

});

// $app->post("/select_offer", function () use ($app) {   

//   $request = new BAP(); 

//   $body = $app->request->getBody();  

//   $send_request = $request->select_agency( $body );

//   echo $send_request; 

// });

$app->run();

