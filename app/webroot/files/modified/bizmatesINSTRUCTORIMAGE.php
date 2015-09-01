<?php
header('Content-Type: text/html; charset=utf-8');

## set execution time limit
set_time_limit(0);


$host = 'http://www.bizmates.jp/';
if (isset($_GET['host']) && $_GET['host'] =='true') {
	echo $host;
}

//if(isset($_GET['data']) && $_GET['data']=='true') {
	$runLoop = true;
	$page = 1;
	$c = 1;
	$value = '';
	$data = array();
	while ($runLoop) {
		$crawlurl = 'http://www.bizmates.jp/trainer/';
		if($page == 1){
			$crawlurl = $crawlurl;
		}else{
			$crawlurl = $crawlurl."index".$page.".html"; 
		}
		$top = exeCurl($crawlurl);

		$teachers = $top->query('//div[@class="tra_item_media"]//a[starts-with(@href, "/")]');

	    if($teachers->length == 0) break;
		
		foreach($teachers as $link) {

			
			$detail_url = $host.$link->getAttribute('href');
			$detail_data = getdetail_data($detail_url, $host);
			$data[] = $detail_data;
			$c++;
		}
		$page++;
		$crawlurl = '';	 
		break;
	}
	echo json_encode($data);
//}


function getdetail_data($detail_url, $host){
	$data = exeCurl($detail_url);
	$detail = array();

	$detail['instructor_url'] = $detail_url; 


	//get image
	$image = $data->query('//p[@class="tra_detail_avar"]//img/@src')->item(0)->nodeValue;
	$detail['site_image'] = $host.$image; 

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
