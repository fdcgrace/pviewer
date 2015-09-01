<?php
//check HTTP_USER_AGENT
//echo $_SERVER['HTTP_USER_AGENT'];
$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
$isiPhone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
$IE = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Trident'); //IE
$moz = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Firefox'); //Firefox
$chrome = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Chrome'); //Chrome
$viewPort = '<meta name="viewport" content="width=device-width, initial-scale=0.4, maximum-scale=0.8">';
$isMobile = 'default';
if ($isiPad) {
  $viewPort = '<meta name="viewport" content="width=1200, minimum-scale=0.1, maximum-scale=0.8">';
  $isMobile = 'mob';
}
if ($isiPhone) {
  $viewPort = '<meta name="viewport" content="width=device-width, initial-scale=0.2, minimum-scale=0.1, maximum-scale=0.8">';
  $isMobile = 'mob';
}

$style = 'style="max-width:244px;"';
$addClass = 'class="forMobile"';
$li5p1 = 'class="pMobile"';
$li5Arrow = 'style="margin-top: -15px; margin-left: 64px;"';


if ($IE) {
  $style = 'style="max-width:260px;"';
  $addClass = 'class="forIE"';
  $li5p1 = 'class="pIE"';
  $li5Arrow = 'style="margin-top: -8px; margin-right:-3px;"';
  $css = '<style type="text/css">
					#navi ul#default li a {
						margin-left:3px;
						padding: 0.7em;
					}
				</style>';
}
if ($moz) {
  $style = 'style="max-width:244px;"';
  $addClass = 'class="forMoz"';
  $li5p1 = 'class="pMoz"';
  $li5Arrow = 'style="margin-top: -15px; margin-left: 67px;"';
  $css = '<style type="text/css">
					#navi ul#default li a {
						margin-left: -4px;
						padding: 1em;
					}
				</style>';
}
if ($chrome) {
  $style = 'style="max-width:244px;"';
  $addClass = 'class="forChrome"';
  $li5p1 = 'class="pChrome"';
  $li5Arrow = 'style="margin-top: -15px; margin-left: 68px;"';
  $css = '<style type="text/css">
					#navi ul#default li a {
						margin-left:-4px;
						padding: 1em;
					}
				</style>';
}