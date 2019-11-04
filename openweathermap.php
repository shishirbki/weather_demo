<?php 
/**
* OpenWeatherMap class
*/
class Openweathermap {
       
    const URI = 'http://api.openweathermap.org';
     
    private $apiKey;
     
    public function __construct($apiKey) {
         
        if(!isset($apiKey) or trim($apiKey) == '') {
            throw new Exception("You must provide a valid API key!");
        }
         
        $this->apiKey = $apiKey;
    }
     
     
    /**
    * Method for retrieving weather of current city
    */
    public function getWeatherByCity($city=null) {
         return $this->apiCall('/data/2.5/weather?q='.$city.'&APPID='.$this->apiKey);  
    }
     
   
    /**
    * Method for API calls
    * 
    * @param string $url
    * @param array $params
    * @param string $method
    * @returns response data
    */
    private function apiCall($url,$params=array(),$method = 'get') {
        $data = null;
 
        $headers = array();
        $headers[] = "Content-type: application/json";        
        $url = (self::URI . $url);		
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
 
        if ($method == 'get' && !empty($params)) { 
            $url = ($url . '?' . http_build_query($params));
        } else if ($method == 'post') { 
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        }
	 
        curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_VERBOSE, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // make the request		
        $response = curl_exec($curl);
        $responseInfo = curl_getinfo($curl);
		curl_close($curl);
		$data = json_decode($response);
		
       switch($responseInfo['http_code']) {
            case 0:
                throw new Exception('Timeout reached when calling ' . $url);
            break;
            case 200:
                $data = json_decode($response,true);
            break;
            case 401:
                throw new Exception('Unauthorized request to ' . $url . ': '.json_decode($response)->message );
            break;
            case 404;
                $data = null;
            break;
            default:
                throw new Exception('Connect to API failed with response: ' . $responseInfo['http_code']);
            break;
        }
		/* echo "<pre>";
         print_r($data);die;  */
        return $data;    
    }
 }