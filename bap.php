<?php class BAP{

	// Initialize constructor
	private $core_version;
	private $bap_uri;
	private $bap_id;

	// Initialize Constructor //

	function __construct(){
		// do nothing as of now
		$this->core_version = '0.9.1';
		$this->bap_id = $this->bap_uri = 'http://localhost/git-repos/code-snippets-dev-docs-php-bap';
	}

	/* Function for Registry Lookup */

	function registry_lookup( $headers = NULL ){
		$uri = 'http://localhost/git-repos/code-snippets-dev-docs-php-bpp';
		return $uri;
	}

	// Build Authentication Header
	function build_auth_headers (){
		// Mock Auth headers as of now
		return [];
	}

	function build_context( $txn_id = '' ){
		$time = new DateTime;	
		$atomic_timestamp = $time->format(DateTime::ATOM);

		$transaction_id = empty( $txn_id ) ? $this->guidv4() : trim( $txn_id );

		$context = array(
	    "domain"=> "mobility",
	    "country"=> "IND",
	    "city"=> "std:080",
	    "core_version"=> "0.9.1",
	    "bap_id"=> $this->bap_id,
	    "bap_uri"=> $this->bap_uri,	    
	    "timestamp"=> $atomic_timestamp,
	    "message_id" => $this->guidv4(),  
	    "transaction_id" => $transaction_id,
		);

		return $context;

	}	

	function build_request( $context,$message,$params = NULL ){
		$request = ['context'=>$context,'message'=>$message];
		return $request;
	}	

	function search_by_pickup_and_drop_location( $request,$headers = NULL ){

		// Pass auth headers in Lookup

		$request_uri = $this->registry_lookup( $headers ).'/search';

		$request_data = json_decode( $request );

		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'search';		

		// Creating search request				

		if( !empty( $request_data->start_loc ) && !empty( $request_data->start_loc )  ){

			$message = [
			  'intent' => [
			    'fulfillment' => [
			      'start' => [
			        'location' => [
			          'gps' => $request_data->start_loc,
			        ],
			      ],
			    ],
			    'end' => [
			      'location' => [
			        'gps' => $request_data->start_loc,
			      ],
			    ],
			  ],
			];

		$build_request = json_encode ( $this->build_request( $context, $message ) );

		// Building Auth Headers
		$auth_headers = $this->build_auth_headers();

		$response = $this->do_curl( $request_uri, $build_request, $auth_headers );			

		}else{
			http_response_code(400);
		}		

	}	

	function select_agency( $request,$headers = NULL ){

		$request_uri = $this->registry_lookup( $headers ).'/select';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );
		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'select';						

		if( !empty( $request_data->items ) && is_array( $request_data->items )  ){

			$message = ['order'=>$request_data->items];

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );						

		}else{
			http_response_code(400);
		}

	}

	function select_offer(){
	}	

	function set_billing_details(){
	}

	function set_fulfillment_details(){
	}

	function set_pickup_instructions(){
	}

	function set_drop_instructions(){
	}

	function initialize_order( $request,$headers = NULL ){
		
		$request_uri = $this->registry_lookup( $headers ).'/init';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );
		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'init';						

		if( !empty( $request_data )  ){			

			$message = [
					  'order' => [
					    'billing' => $request_data->userBillingDetails,
					    'fulfillment' => [
					      'start' => [
					        'location' => $request_data->locationDetails->start,
					        'instructions' => $request_data->pickupInstructions,
					      ],
					      'end' => [
					        'location' => $request_data->locationDetails->end,
					        'instructions' => $request_data->dropInstructions,
					      ],
					    ],
					  ],
					];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );						

		}else{
			http_response_code(400);
		}

	}

	function confirm_order( $request,$headers = NULL ){

		$request_uri = $this->registry_lookup( $headers ).'/confirm';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );
		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'confirm';						

		if( !empty( $request_data->transactionId )  ){			

			$message = [
					  'order' => '',
					  'paymentTransactionId' => ''					      
					];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );							

		}else{
			http_response_code(400);
		}

	}

	function order_status( $request,$headers = NULL ){

		$request_uri = $this->registry_lookup( $headers ).'/status';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );

		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'status';						

		if( !empty( $request_data->order_id )  ){			

			$message = ['order_id' => $request_data->order_id];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );

			// $this->debug( $response );						

		}else{
			http_response_code(400);
		}

	}	

	function cancel_order( $request,$headers = NULL ){

		$request_uri = $this->registry_lookup( $headers ).'/status';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );
		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'status';						

		if( !empty( $request_data->order_id ) ){			

			$message = ['order_id' => $request_data->order_id,'cancellation_reason_id' => $request_data->cancellation_reason_id ];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );						

		}else{
			http_response_code(400);
		}

	}

	function update_order( $request,$headers = NULL ){
		
		$request_uri = $this->registry_lookup( $headers ).'/update';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );

		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'update';						

		if( !empty( $request_data )  ){			

			$message = [
					  'order' => [
					  	'id'=> $request_data->orderId,
					    'billing' => $request_data->userBillingDetails,
					    'fulfillment' => [
					      'start' => [
					        'location' => $request_data->locationDetails->start,
					        'instructions' => $request_data->pickupInstructions,
					      ],
					      'end' => [
					        'location' => $request_data->locationDetails->end,
					        'instructions' => $request_data->dropInstructions,
					      ],
					    ],
					  ],
					];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );						

		}else{
			http_response_code(400);
		}

	}

	function rate( $request,$headers = NULL ){

		$request_uri = $this->registry_lookup( $headers ).'/rate';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );

		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'rate';						

		if( !empty( $request_data->orderId ) && !empty( $request_data->rating )   ){			

			$message = [					  
					  	'id'=> $request_data->orderId,
					    'value' => $request_data->rating,
					   ];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );						

		}else{
			http_response_code(400);
		}

	}

	function track_order( $request,$headers = NULL ){

		$request_uri = $this->registry_lookup( $headers ).'/track';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );

		$order_id = empty( $request_data->order_id ) ? '' : $request_data->order_id;
		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'track';
		$callback_url = "http://localhost/bap/track_order?$order_id";						

		if( !empty( $request_data->orderId ) && !empty( $request_data->rating )   ){			

			$message = [					  
					  	'order_id'=> $request_data->orderId,
					  	'callback_url' =>$callback_url 					    
					   ];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );						

		}else{
			http_response_code(400);
		}
	}

	function get_support( $request,$headers = NULL ){

		$request_uri = $this->registry_lookup( $headers ).'/support';
		$auth_headers = $this->build_auth_headers();

		$request_data = json_decode( $request );

		$transaction_id = empty( $request_data->transactionId ) ? '' : $request_data->transactionId;
		$context = $this->build_context( $transaction_id );

		$context['action'] = 'support';						

		if( !empty( $request_data->orderId ) && !empty( $request_data->rating )   ){			

			$message = [					  
					  	'ref_id'=> $request_data->orderId,					    
					   ];											

			$build_request = json_encode ( $this->build_request( $context, $message ) );

			$response = $this->do_curl( $request_uri, $build_request, $auth_headers );						

		}else{
			http_response_code(400);
		}
	}

	/* ----- Start On Search BAP ----- */	

	// GET on search end point.
	// GET FROM DB

	function on_search( $request ){		
		
		//$response['message']['error']['code'] = 100;
		//$response['message']['error']['description'] = 'Invalid request';			
		// Save to DB

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );
			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- End Search BAP ----- */

	/* ----- Start On Select BAP ----- */	

	function on_select( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );
			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- End Select BAP ----- */

	/* ----- Start On Init BAP ----- */	

	function on_init( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- End Init BAP ----- */

	/* ----- Start On Confirm BAP ----- */

	function on_confirm( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- End Init BAP ----- */

	/* ----- Start On Status BAP ----- */	

	function on_status( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- END Status BAP ----- */

	/* ----- Start On Track BAP ----- */

	function on_track( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- End Track BAP ----- */

	/* ----- Start On Cancel BAP ----- */

	function on_cancel( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- END Cancel BAP ----- */

	/* ----- Start On Update BAP ----- */	

	function on_update( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- END Update BAP ----- */

	/* ----- Start On Rating BAP ----- */	

	function on_rating( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- END Rating BAP ----- */

	/* ----- Start On Support BAP ----- */	

	function on_support( $request ){		
		
		$response['message']['error']['code'] = 100;
		$response['message']['error']['description'] = 'Invalid request';			

		$params = json_decode( $request,1 );			

		if( !empty( $params ) ){

			if( empty( $params['context'] ) || empty( $params['message'] ) ){
				// Return Error cause by Invalid parameters
				return $response;
			}else{
				// Process the data in Request				
				$response['message']['ack']['status'] = 'ACK';
				unset( $response['message']['error'] );

			}			

		}		

		return json_encode( $response ) ;

	}

	/* ----- END Support BAP ----- */

	// Function to debug array

	function debug( $data,$halt = 1 ){

		echo '<pre>';print_r( $data ); echo '</pre>';
		if( $halt ){
			exit;
		}

	}

	// Function to make a CURL Call

	function do_curl( $endpoint,$payload,$headers, $debug = 0 ){

		$curl = new Curl\Curl();
		$curl->post($endpoint,$payload);

		// If debug = 1, will print the request payload sent to server
		//$debug = 1;

		if( $debug ){
			echo '<br/><br> Debug POST Request</br>';
			$this->debug( $payload,0 );
			echo '<br> Debug Response</br>';
			$this->debug( $curl->response,0 );
		}

		return $curl->response;

	}

	function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
	    $data = $data ?? random_bytes(16);
	    assert(strlen($data) == 16);

	    // Set version to 0100
	    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
	    // Set bits 6-7 to 10
	    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

	    // Output the 36 character UUID.
	    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	} 

	// Save Response to DB
	function save_db( $response ){

		$pdo = new PDO("mysql:host=localhost;dbname=bap", 'root', '');
		$db = new NotORM($pdo); 

		$time = date('Y-m-d H:i:s');

		$data = ['message_id' => rand(1,100),'transaction_id' => rand(1,100),'response_data' => 'Hello World',
		'created'=> $time, 'updated' => $time  ];
		$db->responses()->insert( $data );	   

	}

	// Fetch Response from DB
	function poll_db( $msg_id ){

		$pdo = new PDO("mysql:host=localhost;dbname=bap", 'root', '');
		$db = new NotORM($pdo); 

		$time = date('Y-m-d H:i:s');	

		if( $db->responses()->where( 'message_id',$msg_id )->count( '*' ) ){
			return json_encode( ['error'=>0,'data'=>$db->responses()->where( 'message_id',$msg_id ),'message'=>'Poll Success!']);
		}else{
			return json_encode(['error'=>1,'data'=>NULL,'message'=>'Poll Failed!']);
		}	   

	}
    
}