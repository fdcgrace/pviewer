<?php
header('Content-Type: text/html; charset=utf-8');
## set execution time limit
set_time_limit(0);

$host = 'http://eikaiwa.dmm.com/';
if(isset($_GET['host']) && $_GET['host'] == 'true') {
	echo $host;
}

//if(isset($_GET['data'])&& $_GET['data']=='true') {
	$runLoop = true;
	$page = 1;
	$c = 1;
	$data = array();
	$crawlurl = 'http://eikaiwa.dmm.com/list/';
	while ($runLoop) {
		
		
		$top = exeCurl($crawlurl);

		$teachers = $top->query('//div[@class="portrait"]//a[starts-with(@href, "/")]');
 
	    if($teachers->length == 0) {
	    	$data = ' No teacher links retrieved in '.(__FILE__).' on line '.(__LINE__); 
	    	break;
	    } else {		
			foreach($teachers as $link) {
				$detail_url = $host.$link->getAttribute('href');
				if (isset($_GET['get_video']) && $_GET['get_video']=='true') {
					$detail_data = getInstructorVideo($detail_url);
				} else {
					$detail_data = getdetail_data($detail_url, $host);	
				}
				$data[] = $detail_data;
				$c++;
			}
		}
		$page++; 
	}
	if (json_encode($data) == null) { //return json error message if not encoded successfully
		echo json_last_error_msg();
	} else { echo json_encode($data); }
//}

function getdetail_data($detail_url){
	$data = exeCurl($detail_url);
	$detail = array();
	

	//get instructor url
	$detail['instructor_url'] = $detail_url;

	//get name
	$name = $data->query('//div[@class="area-detail"]//h1')->item(0)->nodeValue;
	$name1= explode('（',$name);
	$detail['e_name'] = trim($name1[0]);

	//get katakana name 
	preg_match('#\（(.*?)\）#', $name, $katakana_name);
	$detail['k_name'] = $katakana_name[1];

	//get address
	$address = $data->query('//div[@class="confirm low"]/dl[1]//dd');
	$detail['address'] = ($address->length > 0)?trim($address->item(0)->nodeValue):null;

	//get gender
	$gender = $data->query('//div[@class="confirm low"]/dl[3]//dd');
	$detail['gender'] = ($gender->length > 0)?trim($gender->item(0)->nodeValue):null;

	//get birthdate
	$birthdate = $data->query('//div[@class="confirm low"]/dl[2]//dd');
	$detail['birthdate'] = ($birthdate->length > 0)?trim($birthdate->item(0)->nodeValue):null;

	//get image
	/*$image = $data->query('//div[@class="profile float-l"]//img/@src')->item(0)->nodeValue;
	$detail['image'] = trim($image);	*/

	//get education
	$education = $data->query('//div[@class="confirm low"]/dl[6]//dd');
	$detail['education'] = ($education->length > 0)?trim($education->item(0)->nodeValue):null;

	//get hobby
	$hobby = $data->query('//div[@class="confirm low"]/dl[7]//dd');
	$detail['hobby'] = ($hobby->length > 0)?trim($hobby->item(0)->nodeValue):null;
	
	//get favorite_movie
	$favorite_movie = $data->query('//div[@class="confirm low"]/dl[8]//dd');
	$detail['favorite_movie'] = ($favorite_movie->length > 0)?trim($favorite_movie->item(0)->nodeValue):null;

	//get work_place
	$work_place = $data->query('//div[@class="confirm low"]/dl[9]//dd');
	$detail['work_place'] = ($work_place->length > 0)?trim($work_place->item(0)->nodeValue):null;

	//get message
	$message = $data->query('//div[@class="area-staffcomment"]');
	$detail['message'] = ($message->length > 0)?trim($message->item(0)->nodeValue):null;

	return $detail;
}

function getInstructorVideo($detail_url) {
	$data = exeCurl($detail_url);
	$detail = array();
	$detail['instructor_url'] = $detail_url;
	$introduction_video = $data->query('//div[@class="profile float-l"]/iframe/@src');
	$detail['introduction_video'] = ($introduction_video->length > 0)?trim($introduction_video->item(0)->nodeValue):null;
	return $detail;
}

function exeCurl($source_url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $source_url);
	curl_setopt($ch, CURLOPT_USERAGENT, '');
	curl_setopt($ch, CURLOPT_REFERER, '');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$curlResults= curl_exec($ch);
	curl_close($ch);

	$dom = new DOMDocument();
	@$dom->loadHTML($curlResults);

	$xpath = new DOMXPath($dom);
	return $xpath;
}
