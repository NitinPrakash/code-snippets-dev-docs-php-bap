<?php class BAP{

	// Initialize constructor

	function __construct(){
		// do nothing as of now
	}

	/* ----- Start On Search BAP ----- */	

	function on_search( $request ){		
		
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

	function do_curl( $endpoint,$payload, $debug = 0 ){

		$curl = new Curl\Curl();
		$curl->post($endpoint,$payload);

		// If debug = 1, will print the request payload sent to server
		//$debug = 1;

		if( $debug ){
			echo '<br/><br> Debug POST Request</br>';
			$this->debug( $payload,0 );
			echo '<br> Debug Response</br>';
			$this->debug( $curl->response );
		}

	} 
    
}