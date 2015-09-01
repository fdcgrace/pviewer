<?php
header('Content-Type: text/html; charset=utf-8');

## set execution time limit
set_time_limit(0);


$host = 'http://eikaiwa.dmm.com/';
if(isset($_GET['host']) && $_GET['host'] == 'true') {
	echo $host;
}

	$host = 'http://eikaiwa.dmm.com';
	$runLoop = true;
	$page = 1;
	$c = 1;
	$data = array();
	while ($runLoop) {
		
		if($page == 1) {
			$crawlurl = 'http://eikaiwa.dmm.com/list/';
		} else {
			$href = exeCurl($crawlurl);
			$counter = $page;
			$x = $href->query("//div[@class='list-boxpagenation']//ul//a[$page]");
			
			$a = trim($x->item(0)->getAttribute('href'));
			$crawlurl = trim('http://eikaiwa.dmm.com'.$a);
		}
		$top = exeCurl($crawlurl);

		$teachers = $top->query('//div[@class="portrait"]//a[starts-with(@href, "/")]');

	    if($teachers->length == 0) break;
		
		foreach($teachers as $link) {
			$detail_url = $host.$link->getAttribute('href');
			
			$detail_data = getdetail_data($detail_url, $host);	
			
			$data[] = $detail_data;
			$c++;
		}break;
		// $page++; 
	}
	
	echo json_encode($data);



function getdetail_data($detail_url){
	$data = exeCurl($detail_url);
	$detail = array();
	

	//get instructor url
	$detail['instructor_url'] = $detail_url;


	//get image
	$image = $data->query('//div[@class="profile float-l"]//img/@src')->item(0)->nodeValue;
	$detail['site_image'] = trim($image);	

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
