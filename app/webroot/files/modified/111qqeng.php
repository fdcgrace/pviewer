<?php
header('Content-Type: text/html; charset=utf-8');

## set execution time limit
set_time_limit(0);



$crawlUrl = 'http://www.qqeng.com/q/teachers/?page=';
$host = 'http://www.qqeng.com/';

if(isset($_GET['host']) && $_GET['host'] == 'true') {
	echo $host;
}
//if(isset($_GET['data'])&& $_GET['data']=='true') {
	$runLoop = true;
	$page = 1;
	$c = 1;
	$value = '';
	$data = array();
	while ($runLoop) {
		
		$top = exeCurl($crawlUrl.$page);


		echo $crawlUrl.$page;

	// 	$teachers = $top->query('//ul[@class="results"]//dt//a[starts-with(@href, "/")]');

	// //   if($teachers->length == 0) break;
		
	// 	foreach($teachers as $link) {
	// 		$detailUrl = $host.$link->getAttribute('href');
			
	// 		  $detailData = getDetailData($detailUrl, $host);
			 
			 
	// 		$data[] = $detailData;
	// 		$c++;
	// 	}
		 $page++;

	}
	echo json_encode($data);
//}


function getDetailData($detailUrl, $host){
	$data = exeCurl($detailUrl);
	$detail = array();
	//teacher url
	$detail['instructor_url'] = $detailUrl;

	
	$image = $data->query('//div[@class="profilebox teacher mb15"]//a/img/@src')->item(0)->nodeValue;
	$detail['site_image'] = trim($host.$image);	


	return $detail;
}

function exeCurl($sourceUrl){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $sourceUrl);
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
?>
