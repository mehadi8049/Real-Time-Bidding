<?php 

namespace App\Controllers;

use App\Controllers\Controller;
use Exception;

class HomeController extends Controller{
	
	public function index($_get){
		try {
			$bidRequestJson = $this->data("bid_requests");
			
			$bid_request_params=$this->handle_bid_request($bidRequestJson);
			$campaigns=$this->data("campaigns");
			$selected_campaign=$this->select_campaign($bid_request_params, $campaigns);
			return json_response([
				'status' => false,
				'message' => null,
				'data' => $this->generate_campaign_response($selected_campaign),
			],200);
		}catch(Exception $e) {
			return json_response([
				'status' => false,
				'errors' => $e->getMessage(),
				'data' => [],
			],$e->getCode());
		}
	}

	protected function handle_bid_request($bid_request_json) {
	    // Parse JSON and extract relevant parameters
	    $bid_request = json_decode($bid_request_json, true);
	
	    if (!$bid_request) {
		    throw new Exception("Invalid JSON format",422);
	    }
	
	    // Validate parameters
	    if (!isset($bid_request['device_info']) || !isset($bid_request['geo_location']) || !isset($bid_request['ad_format']) || !isset($bid_request['bid_floor'])) {
		    throw new Exception("Missing required parameters in bid request",422);
	    }
	
	    // Other validation logic
	
	    return array(
			$bid_request['device_info'],
			$bid_request['geo_location'],
			$bid_request['ad_format'],
			$bid_request['bid_floor']
	    );
	}


	protected function select_campaign($bid_request_params, $campaign_array) {
	    $selected_campaign = null;
	    $highest_bid_price = 0;
	
	    foreach ($campaign_array as $campaign) {
			// Compare campaign parameters with bid request
			if ($campaign['device_compatibility'] == $bid_request_params[0] &&
				$campaign['geo_targeting'] == $bid_request_params[1] &&
				$campaign['ad_format'] == $bid_request_params[2] &&
				$campaign['bid_price'] >= $bid_request_params[3]) {
		
				// Select campaign with highest bid price
				if ($campaign['bid_price'] > $highest_bid_price) {
					$highest_bid_price = $campaign['bid_price'];
					$selected_campaign = $campaign;
				}
			}
	    }
	    return $selected_campaign;
	}

	protected function generate_campaign_response($selected_campaign) {
	    if ($selected_campaign) {
	        return [
				"campaign_name" => $selected_campaign['name'],
	            "advertiser" => $selected_campaign['advertiser'],
	            "creative_type" => $selected_campaign['creative_type'],
	            "image_url" => $selected_campaign['image_url'],
	            "landing_page_url" => $selected_campaign['landing_page_url'],
	            "bid_price" => $selected_campaign['bid_price'],
	            "ad_id" => $selected_campaign['ad_id'],
	            "creative_id" => $selected_campaign['creative_id']
			];
	    } else {
	        return json_encode(array("error" => "No suitable campaign found"));
	    }
	}


	protected function data($key){
		$data=[
			"bid_requests"=>file_get_contents("./Storage/bidding_requests/text.json"),
            // Sample campaigns array
			"campaigns"=>[
				[
					'name' => 'Campaign 1',
					'device_compatibility' => 'mobile',
					'geo_targeting' => 'US',
					'ad_format' => 'banner',
					'bid_price' => 0.7,
					'ad_id' => 1,
					'creative_id' => 101
				],
				[
					'name' => 'Campaign 2',
					'device_compatibility' => 'desktop',
					'geo_targeting' => 'US',
					'ad_format' => 'banner',
					'bid_price' => 0.6,
					'ad_id' => 2,
					'creative_id' => 102
				]
			]
		];
		return $data[$key];
	}

}