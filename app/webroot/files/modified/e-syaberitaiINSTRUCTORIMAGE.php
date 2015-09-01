<?php
header('Content-Type: text/html; charset=utf-8');

## set execution time limit
set_time_limit(0);

$crawlurl = 'http://e-syaberitai.com/student/teacher_search.php?init=1';
$host = 'http://e-syaberitai.com/';
if(isset($_GET['host']) && $_GET['host'] == 'true') {
	echo $host;
}

//if(isset($_GET['data'])&& $_GET['data']=='true') {
	$host = 'http://e-syaberitai.com';
	$runLoop = true;
	$page = 1;
	$c = 1;
	$value = '';
	$data = array();
	while ($runLoop) {
		
		$top = exeCurl($crawlurl);

		$teachers = $top->query('//table[@class="thumb_table"]//div//a[contains(@href,"teacher")][1]');

	    if($teachers->length == 0) break;
		
		foreach($teachers as $link) {

			$detail_url = $host.'student/'.$link->getAttribute('href');
			$detail_url = str_replace("_schedule","_profile",$detail_url);
			$detail_data = getdetail_data($detail_url, $host);
			$data[] = $detail_data;
			$c++;
			//break;
		}
		break;
		$page++;	
		
	}
	echo json_encode($data);
	
//}


function getdetail_data($detail_url, $host){
	$data = exeCurl($detail_url);
	$detail = array();

	$detail['instructor_url'] = $detail_url;

	//get image
	$image = $data->query('//img/@src')->item(21)->nodeValue;
	$detail['site_image'] = $host.trim($image);

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
