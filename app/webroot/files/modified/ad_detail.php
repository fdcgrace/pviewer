<?php

class page extends Its_PageBase{

	function main(){

		$this->t->read("ad_detail.html");

		$prev = Its_Request::getInt('prev', 0);
		$site_cd = Its_Request::getInt('scd', 0);
		$ad_cd = Its_Request::getInt('acd', 0);
		$ucd = Its_Request::get('ucd');
		$param = $_SERVER['QUERY_STRING'];

		//GETで受け取るとデコードされるので、再エンコード
		$ucd = urlencode($ucd);

		// 広告枠情報の取得
		$site = new Model_DSite();
		$site->readById($site_cd);
		if(!$site->isExist()){
			$this->c->alert('不正リクエスト');
		}

		// 広告情報の取得
		$ad = new Model_DAd();
		$ad->readBySql("
			SELECT
				ad.*, count.dl_max_count, count.join_max_count
			FROM d_ad AS ad
				LEFT JOIN d_ad_count AS count ON count.ad_cd = ad.id
				INNER JOIN d_owner ON d_owner.id = ad.owner_cd AND d_owner.user_type = ?
			WHERE ad.id = ?
				AND ((ad.ad_join_flg = 1 AND (count.id IS NULL OR count.join_max_count = 0 OR count.join_count < count.join_max_count))
					OR (ad.ad_dl_flg = 1 AND (count.id IS NULL OR count.dl_max_count = 0 OR count.dl_count < count.dl_max_count)))
							", $site->getValue('user_type') ,$ad_cd);
		if(!$ad->isExist()){
			$this->c->alert('不正リクエスト');
		}

		$user_type = $site->getValue('user_type');
		$point_unit_price = $site->getValue('point_unit_price');
		$point_label = $site->getValue('point_label');
		$this->t->assign('point_label', $point_label);

		//UCD ない場合は？ --> いったん不正アクセス扱い
		if($ucd == '' && $prev != 1){
			$this->c->alert('不正リクエスト');
			return;
		}

		//任意パラムの取得
		$param_array = split('&', $param);
		$other_param = '';
		foreach ($param_array as $value){
			if(!preg_match('/^scd=/', $value)
					&& !preg_match('/^acd=/', $value)
					&& !preg_match('/^ucd=/', $value))
				$other_param .= '&'.$value;
		}

		// ページデザイン情報の取得しスタイルを設定する
		$header_image_url = '';
		$txt_color = G_DFSTYLE_DETAIL_TEXT_COLOR;
		$bg_color1 = G_DFSTYLE_DETAIL_BACK_COLOR;
		$hd_color1 = G_DFSTYLE_DETAIL_HEAD_COLOR;
		$cnt_color1 = G_DFSTYLE_DETAIL_CONT_COLOR;
		$btn_color1 = G_DFSTYLE_DETAIL_BUTTON_COLOR;
		$btn_txt_color = G_DFSTYLE_DETAIL_BUTTON_TEXT_COLOR;

		$site_d = new Model_DSiteD();
		$site_d->readById($site->id);
		if($site_d->isExist()){
			//画像を再読込させる
			$dummy_para = '?ver='.$site_d->getValue('upd_date');

			$header_image_url = $site_d->getValue('detail_header_img') == null ? '' : '../'.$site_d->getValue('detail_header_img').$dummy_para;
			$txt_color = $site_d->getValue('detail_text_color');
			$bg_color1 = $site_d->getValue('detail_background_color');
			$hd_color1 = $site_d->getValue('detail_header_color');
			$cnt_color1 = $site_d->getValue('detail_content_color');
			$btn_color1 = $site_d->getValue('detail_button_color');
			$btn_txt_color = $site_d->getValue('detail_button_text_color');
		}

		if($prev == 1){
			$bg_color1 = $this->setPreViewColor($bg_color1, Its_Request::get('bgcolor'));
			$txt_color = $this->setPreViewColor($txt_color, Its_Request::get('fontcolor'));
			$hd_color1 = $this->setPreViewColor($hd_color1, Its_Request::get('headercolor'));
			$cnt_color1 = $this->setPreViewColor($cnt_color1, Its_Request::get('contentcolor'));
			$btn_color1 = $this->setPreViewColor($btn_color1, Its_Request::get('buttoncolor'));
			$btn_txt_color = $this->setPreViewColor($btn_txt_color, Its_Request::get('buttonfontcolor'));
		}

		if($header_image_url != '') $this->t->assign('header_image', 1);
		$this->t->assign('header_image_url', $header_image_url);
		$this->t->assign('txt_color', $txt_color);
		$this->t->assign('bg_color', $bg_color1);
// 		$this->t->assign('bg_color2', gradient_color($bg_color1));
		$this->t->assign('hd_color1', $hd_color1);
		$this->t->assign('hd_color2', gradient_color($hd_color1));
		$this->t->assign('cnt_color1', $cnt_color1);
		$this->t->assign('cnt_color2', gradient_color($cnt_color1, 3));
		$this->t->assign('btn_color1', $btn_color1);
		$this->t->assign('btn_color2', gradient_color($btn_color1));
		$this->t->assign('btn_txt_color', $btn_txt_color);

		// 広告情報の設定
		$this->t->assign('ad_title', $ad->getValue('ad_title'));

		$add_point = 0;
		if($ad->getValue('ad_join_flg') == 1){
			$this->t->assign('ad_kind', "Web");
			if($ad->getValue('join_max_count') > 0){
				$this->t->assign('ad_limit', $ad->getValue('join_max_count'));
			}
			if($point_unit_price > 0){
				$add_point = $ad->getValue('unit_price_join') / $point_unit_price;
				$this->t->assign('button_label', "登録で{$point_label}ゲット");
			}else{
				$add_point = 0;
				$this->t->assign('button_label', "登録");
			}
			$this->t->assign('first_method', "登録");
		}else{
			$this->t->assign('ad_kind', "APP");
			if($ad->getValue('dl_max_count') > 0){
				$this->t->assign('ad_limit', $ad->getValue('dl_max_count'));
			}
			if($point_unit_price > 0){
				$add_point = $ad->getValue('unit_price_dl') / $point_unit_price;
				$this->t->assign('button_label', "ダウンロードで{$point_label}ゲット");
			}else{
				$add_point = 0;
				$this->t->assign('button_label', "ダウンロード");
			}
			$this->t->assign('first_method', "インストール");
		}

		$this->t->assign('ad_detail', nl2br($ad->getValue('ad_detail')));

		if($add_point > 0){
			// 20140730 丸め処理を削除
			//$this->t->assign('ad_point', round($add_point) . '&nbsp;' . $point_label);
			//$this->t->assign('ad_point', $add_point . '&nbsp;' . $point_label);
			// 20141030 小数点第1位まで。(切り捨て)
			$this->t->assign('ad_point', (floor($add_point*10)/10) . '&nbsp;' . $point_label);
		}

		$price = $ad->getValue('ad_price') == 0 ? '無料' : $ad->getValue('ad_price') . '円';
		$this->t->assign('ad_price', $price);

		if(strlen($ad->getValue('syonin_uri_joken_text'))){
			$this->t->assign('syonin_uri_joken_text', nl2br($ad->getValue('syonin_uri_joken_text')));
		}

		// アイコン画像
		$link = $this->db->getValue("SELECT link FROM d_banner WHERE ad_cd = ? AND del_flg = 0 ORDER BY banner_size_cd ASC LIMIT 1", $ad->id);
		if($link){
			$this->t->assign('image_url', G_HTTP_ROOT . $link);
		}else{
			$this->t->assign('image_url', G_HTTP_ROOT . 'files/banner/deadlink.gif');
		}

		$af = sha1(uniqid(mt_rand(), true));
		// afの重複チェックはしない。クリックログとの紐付けに使うのみ。

		// インプレッションURL
		// http://{hostname}/api/imgt.php?acd=3000200&scd=6000216&sid=ee8d7a9bc46168ec72d34d284db9dd7c
		$impr_url = G_HTTP_ROOT_API . "api/imgt.php?acd={$ad->id}&scd={$site->id}&sid={$site->getValue('sid')}&af={$af}";
		if($prev == 1){
			$impr_url = "#";
		}
		$this->t->assign('impr_url', $impr_url);

		// クリックURL
		// http://{hostname}/api/click.php?acd=3000200&scd=6000216
		$click_url = G_HTTP_ROOT_API . "api/click.php?acd={$ad->id}&scd={$site->id}&af={$af}&ucd={$ucd}{$other_param}";
		if($prev == 1){
			$click_url = '#';
			$target_blank = '';
		}else{
			if($ad->getValue('ad_join_flg') == 1){
				$target_blank = 'target="_blank"';
			}else{
				// アプリの場合はtarget="_blank"があるとSafariとかでAppstoreがうまく開かない。
				$target_blank = '';
			}
		}
		$this->t->assign('click_url', $click_url);
		$this->t->assign('target_blank', $target_blank);

		$this->t->flush();
	}

	/**
	 * カラーチェック
	 * @param unknown_type $v
	 * @param unknown_type $name
	 * @param unknown_type $label
	 */
	private function setPreViewColor($beforColor, $previewColor){

		$setColor = $beforColor;

		if($previewColor != ''
				&& mb_strlen($previewColor, 'utf-8') == 6
				&& preg_match('/^[0-9a-fA-F]{6}$/', $previewColor)
		){
			$setColor = '#'.$previewColor;
		}

		return $setColor;
	}
}
$pageobj = new App_AdController(new page());
$pageobj->execute();
