<?php
header('Content-Type: text/html; charset=utf-8');

## set execution time limit
set_time_limit(0);



$crawlurl = 'http://www.best-teacher-inc.com/tutors?page=';
$host = 'http://www.best-teacher-inc.com/';

if (isset($_GET['host']) && $_GET['host'] =='true') {
	echo $host;
}
	$host = 'http://www.best-teacher-inc.com';
	$runLoop = true;
	$page = 1;
	$c = 1;
	$value = '';
	$data = array();
	while ($runLoop) {

		$top = exeCurl($crawlurl.$page);

		$teachers = $top->query('//div[@class="row-fluid"]//div[@class="span5"]//a[starts-with(@href, "/")]');

	    if($teachers->length == 0) break;
		
			foreach($teachers as $link) {
				$detail_url = $host.$link->getAttribute('href');
				$detail_data = getdetail_data($detail_url);
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
		$image = $data->query('//div[@class="tutor-detail"]//table/tr[1]//td[2]//img/@src')->item(0)->nodeValue;
		$detail['site_image'] = $image; 
		

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
