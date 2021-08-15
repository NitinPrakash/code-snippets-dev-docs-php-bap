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

/* ------------ Client POST Request Handlers or Dispatchers --------------- */

$app->get("/save_db", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->save_db( 'Hello' );  

});

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

$app->post("/rate", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->rate( $body );

  echo $send_request; 

});

$app->post("/get_support", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->get_support( $body );

  echo $send_request; 

});

$app->post("/track_order", function () use ($app) {   

  $request = new BAP(); 

  $body = $app->request->getBody();  

  $send_request = $request->track_order( $body );

  echo $send_request; 

});

// GET Requests to poll message ids

// Create A Poll Request for On Search

$app->get("/on_search", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});

// Create A Poll Request for On Select

$app->get("/on_select", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});

// Create A Poll Request for On Initialize Order

$app->get("/on_initialize_order", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});

// Create A Poll Request for On Confirm

$app->get("/on_confirm", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});

// Create A Poll Request for On Order Status

$app->get("/on_order_status", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});

// Create A Poll Request for On Track Order

$app->get("/on_track_order", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});

// Create A Poll Request for On Cancel Order

$app->get("/on_cancel_order", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});

// Create A Poll Request for On Get Support

$app->get("/on_get_support", function () use ($app) {   

  $request = new BAP(); 

  // Fetch Message Id
  $msg_id = empty( $_REQUEST['message_id'] ) ? 0 : trim( $_REQUEST['message_id'] );
  // Create Poll Request for Message Id
  $poll_request = $request->poll_db( $msg_id );
  // Print Poll Response
  echo $poll_request; 

});



// $app->post("/select_offer", function () use ($app) {   

//   $request = new BAP(); 

//   $body = $app->request->getBody();  

//   $send_request = $request->select_agency( $body );

//   echo $send_request; 

// });

$app->run();

