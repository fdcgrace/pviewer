<?php

class page extends Its_PageBase{

	function main(){
		$this->c->alert('この広告は表示できません。');
	}
}
$pageobj = new App_AdController(new page());
$pageobj->execute();
