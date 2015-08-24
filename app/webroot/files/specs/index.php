<?php


class page extends Its_PageBase{

	function main(){

		// Ajax通信の場合はテンプレートを切り替える
		if(is_ajax()){
			$this->t->read("index_ajax.html");
		}else{
			$this->t->read("index.html");
		}

		$sid = Its_Request::get('sid');
		$ucd = Its_Request::get('ucd');
		$param = $_SERVER['QUERY_STRING'];
		$prev = Its_Request::getInt('prev', 0);
		$uid = isset($_COOKIE['uid']) ? $_COOKIE['uid'] : "";

		$this->t->assign('sid', $sid);
		if($prev == 1){
			$this->t->assign('prev', '&prev=1');
		}else{
			$this->t->assign('prev', '');
		}

		//広告枠情報の取得
		$site = new Model_DSite();
		$site->readBySIdForSmartPhoneApp($sid);
		if(!$site->isExist()){
			$this->c->alert('不正アクセス');
			return;
		}
		$this->t->assign('site_cd', $site->id);
		$site_cd = $site->id;
		$user_type = $site->getValue('user_type');
		$point_unit_price = $site->getValue('point_unit_price');
		$point_label = $site->getValue('point_label');
		$media_category_cd = $site->getValue('media_category_cd');
		
		//UCD ない場合は？ --> いったん不正アクセス扱い
		if($ucd == '' && $prev != 1){
			$this->c->alert('不正アクセス');
			return;
		}

		//任意パラムの取得
		$param_array = split('&', $param);
		$other_param = '';
		foreach ($param_array as $value){
			if(!preg_match('/^sid=/', $value)
				&& !preg_match('/^prev=/', $value)
				&& !preg_match('/^ucd=/', $value))
			$other_param .= '&'.$value;
		}
		$this->t->assign('other_param', $other_param);

		// ページデザイン情報の取得しスタイルを設定する
		$header_image_url = '';
		$header_html = '';
		$bg_color1 = G_DFSTYLE_LIST_BACK_COLOR;
		$txt_color = G_DFSTYLE_LIST_TEXT_COLOR;

		$site_d = new Model_DSiteD();
		$site_d->readById($site->id);
		if($site_d->isExist()){
			//画像を再読込させる
			$dummy_para = '?ver='.$site_d->getValue('upd_date');

			$header_image_url = $site_d->getValue('list_header_img') == null ? '' : '../'.$site_d->getValue('list_header_img').$dummy_para;
			$header_html = $site_d->getValue('list_header_html');
			$bg_color1 = $site_d->getValue('list_background_color');
			$txt_color = $site_d->getValue('list_text_color');
		}

		if($prev == 1){
			$bg_color1 = $this->setPreViewColor($bg_color1, Its_Request::get('bgcolor'));
			$txt_color = $this->setPreViewColor($txt_color, Its_Request::get('fontcolor'));
		}

		if($header_image_url != '') $this->t->assign('header_image', 1);
		$this->t->assign('header_image_url', $header_image_url);
		$this->t->assign('bg_color1', $bg_color1);
		$this->t->assign('bg_color2', gradient_color($bg_color1, 4));
		$this->t->assign('txt_color', $txt_color);
		
		if (strlen($header_html) && $site->getValue('platform_type') == G_PLATFORM_TYPE_WEB) {
			$header_html = htmlspecialchars_decode($header_html);
			$header_html = preg_replace('@<script[^>]*?>.*?</script>@si', "", $header_html) ;
			// $header_html = strip_tags($header_html, '<a><span><div><font>');
			$this->t->assign('header_html', $header_html);
		}

		// OSチェック AndroidかiOSか
		$car = new Its_CarCheck();
		$osType = G_OS_TYPE_NONE;
		if($car->is_iPhone()){
			$osType = G_OS_TYPE_IOS;
		}else if($car->is_Android()){
			$osType = G_OS_TYPE_ANDROID;
		}else if(!$prev){
			$this->c->alert("お使いの端末ではこのページを表示できません。");
			return;
		}

		// uidがない場合はここで生成しCookieに設定しておく
		if(!strlen($uid)){
			$uid = sha1(uniqid(mt_rand(), true));
			// uidの重複チェックをしておく。
			for($i = 0; $i < 100; $i++){
				if($i == 99){
					// ここまでくることはないはず。来てしまったら終了。
					$this->c->alert('システムエラー.');
					exit;
				}
				$ret = $this->db->getValue("SELECT uid FROM d_uid WHERE uid = ? AND del_flg = 0", $uid);
				if($ret){
					$uid = sha1(uniqid(mt_rand(), true));
					continue;
				}else{
					$this->db->insert(array('uid' => $uid), 'd_uid', G_OPID_API);
					break;
				}
			}
		}

		if(strlen($uid)){
			setcookie('uid', $uid, time() + G_UID_COOKIE_EXPIRE);
		}

		// ===== ページング =====
		$page_num = 20;
		$pos = Its_Request::getInt('pos', 0);

		$searchSql = new Its_SearchSql();

		$searchSql->setLimitOffset($page_num, $pos);

		// プレビューモードでなければアプリのOSをチェックする
		$ossql = "";
		if($prev == 1){
			$ossql = "OR d_ad.ad_dl_flg =1";
		}else{
			$ossql = "OR (d_ad.ad_dl_flg =1 AND d_ad.os_type = {$osType})";
		}

		// キャリア判定
		$ip = @$_SERVER["REMOTE_ADDR"];
		$smcar = new App_MobileCarrier();
		$smcartype = $smcar->SmartPhoneCarrierChk($ip);

// 		$smcartype = G_DOCOMO;

		$carsql = "";
		if($prev != 1){
			switch ($smcartype) {
				case G_DOCOMO:
					$carsql = " AND d_ad.do_delivery_flg = 1 ";
					break;
				case G_AU:
					$carsql = " AND d_ad.au_delivery_flg = 1 ";
					break;
				case G_SOFTBANK:
					$carsql = " AND d_ad.sb_delivery_flg = 1 ";
					break;
				default:
					$carsql = " AND d_ad.do_delivery_flg = 1 AND d_ad.au_delivery_flg = 1 AND d_ad.sb_delivery_flg = 1 ";
					break;
			}
		}

		$sql = "
			SELECT
				d_ad.*
			FROM
				(SELECT
					d_ad.id
				FROM d_ad
				WHERE
					d_ad.del_flg = 0
				AND d_ad.ad_status = " . G_AD_STATUS_KEISAI . "
				AND d_ad.syonin_status = " . G_SYONIN_STATUS_ZUMI . "
				AND d_ad.start_date <= CURRENT_DATE AND (d_ad.end_date >= CURRENT_DATE OR d_ad.end_date IS NULL)
				AND d_ad.site_type = " . G_SITE_TYPE_WEB_SM . "
				AND (d_ad.ad_join_flg = 1 {$ossql})
				AND d_ad.stop_flg = 0
				{$carsql}
				AND NOT EXISTS (SELECT 'K' FROM t_access4dl AS accessDl WHERE accessDl.ad_cd = d_ad.id AND accessDl.site_cd = ? AND accessDl.ucd = ?)
				AND NOT EXISTS (SELECT 'L' FROM t_access4join AS accessJoin WHERE accessJoin.ad_cd = d_ad.id AND accessJoin.site_cd = ? AND accessJoin.ucd = ?)
				ORDER BY d_ad.cre_date DESC
				) ad
			INNER JOIN d_ad ON d_ad.id = ad.id
			LEFT JOIN d_ad_deny_filter AS afilter ON afilter.ad_cd = ad.id AND afilter.site_cd = ?
			LEFT JOIN d_media_category_allow_filter AS cfilter ON cfilter.ad_cd = ad.id AND cfilter.media_category_cd = ?
			LEFT JOIN d_owner AS owner ON owner.id = d_ad.owner_cd
			LEFT JOIN d_ad_count AS count ON count.ad_cd = ad.id
			WHERE
				afilter.id IS NULL
			AND cfilter.id IS NOT NULL
			AND owner.user_type = ?
			AND ((d_ad.ad_join_flg = 1 AND (count.id IS NULL OR count.join_max_count = 0 OR count.join_count < count.join_max_count))
			OR (d_ad.ad_dl_flg = 1 AND (count.id IS NULL OR count.dl_max_count = 0 OR count.dl_count < count.dl_max_count)))
			ORDER BY d_ad.cre_date DESC
			{$searchSql->getLimitOffset()}
		";

// 		$sql = "
// 			SELECT
// 				ad.*
// 			FROM d_ad as ad
// 				LEFT JOIN d_ad_deny_filter AS afilter ON afilter.ad_cd = ad.id AND afilter.site_cd = ?
// 				LEFT JOIN d_media_category_allow_filter AS cfilter ON cfilter.ad_cd = ad.id AND cfilter.media_category_cd = ?
// 				LEFT JOIN d_owner AS owner ON owner.id = ad.owner_cd
// 				LEFT JOIN d_ad_count AS count ON count.ad_cd = ad.id
// 			WHERE
// 				ad.del_flg = 0
// 				AND afilter.id IS NULL
// 				AND cfilter.id IS NOT NULL
// 				AND ad.ad_status = " . G_AD_STATUS_KEISAI . "
// 				AND ad.syonin_status = " . G_SYONIN_STATUS_ZUMI . "
// 				AND ad.start_date <= CURRENT_DATE AND (ad.end_date >= CURRENT_DATE OR ad.end_date IS NULL)
// 				AND NOT EXISTS (SELECT 'K' FROM t_access4dl AS accessDl WHERE accessDl.ad_cd = ad.id AND accessDl.site_cd = ? AND accessDl.ucd = ?)
// 				AND NOT EXISTS (SELECT 'L' FROM t_access4join AS accessJoin WHERE accessJoin.ad_cd = ad.id AND accessJoin.site_cd = ? AND accessJoin.ucd = ?)
// 				AND ad.site_type = " . G_SITE_TYPE_WEB_SM . "
// 				AND (ad.ad_join_flg = 1 {$ossql})
// 				AND ad.stop_flg = 0
// 				AND owner.user_type = ?
// 				{$carsql}
// 				AND ((ad.ad_join_flg = 1 AND (count.id IS NULL OR count.join_max_count = 0 OR count.join_count < count.join_max_count))
// 					OR (ad.ad_dl_flg = 1 AND (count.id IS NULL OR count.dl_max_count = 0 OR count.dl_count < count.dl_max_count)))
// 			ORDER BY ad.upd_date DESC
// 			{$searchSql->getLimitOffset()}
// 		";

		$result = $this->db->getRowsNoCount($sql, array($site_cd, $ucd, $site_cd, $ucd, $site->id, $media_category_cd, $user_type));

		/**
		 * 広告一覧に表示できる件数を取得
		 * ただし、設定最大件数内での件数 ==> 全体取得すると無駄に遅いので
		 */
		$sql = "
			SELECT
				count(main_tb.id) AS d_count
			FROM
				(SELECT
					ad.id
				FROM
					(SELECT
						d_ad.id,
						d_ad.owner_cd,
						d_ad.ad_join_flg,
						d_ad.ad_dl_flg
					FROM d_ad
					WHERE
						d_ad.del_flg = 0
					AND d_ad.ad_status = " . G_AD_STATUS_KEISAI . "
					AND d_ad.syonin_status = " . G_SYONIN_STATUS_ZUMI . "
					AND d_ad.start_date <= CURRENT_DATE AND (d_ad.end_date >= CURRENT_DATE OR d_ad.end_date IS NULL)
					AND d_ad.site_type = " . G_SITE_TYPE_WEB_SM . "
					AND (d_ad.ad_join_flg = 1 {$ossql})
					AND d_ad.stop_flg = 0
					{$carsql}
					AND NOT EXISTS (SELECT 'K' FROM t_access4dl AS accessDl WHERE accessDl.ad_cd = d_ad.id AND accessDl.site_cd = ? AND accessDl.ucd = ?)
					AND NOT EXISTS (SELECT 'L' FROM t_access4join AS accessJoin WHERE accessJoin.ad_cd = d_ad.id AND accessJoin.site_cd = ? AND accessJoin.ucd = ?)
				) ad
				LEFT JOIN d_ad_deny_filter AS afilter ON afilter.ad_cd = ad.id AND afilter.site_cd = ?
				LEFT JOIN d_media_category_allow_filter AS cfilter ON cfilter.ad_cd = ad.id AND cfilter.media_category_cd = ?
				LEFT JOIN d_owner AS owner ON owner.id = ad.owner_cd
				LEFT JOIN d_ad_count AS count ON count.ad_cd = ad.id
				WHERE
					afilter.id IS NULL
				AND cfilter.id IS NOT NULL
				AND owner.user_type = ?
				AND ((ad.ad_join_flg = 1 AND (count.id IS NULL OR count.join_max_count = 0 OR count.join_count < count.join_max_count))
				OR (ad.ad_dl_flg = 1 AND (count.id IS NULL OR count.dl_max_count = 0 OR count.dl_count < count.dl_max_count)))
				LIMIT ". G_AD_DISPLAY_MAX ."
				) AS main_tb
		";

		$num_rslt = $this->db->getRow($sql, array($site_cd, $ucd, $site_cd, $ucd, $site->id, $media_category_cd, $user_type));
		$num = $num_rslt['d_count'];

		if($num + $pos == 0){
			$this->t->assign('no_ad', 'style="height: 100%;"');
		}else{
			$this->t->assign('ad_exists', 1);
		}

		if($pos + $page_num < $num && $pos + $page_num < G_AD_DISPLAY_MAX){
			$this->t->assign('exists_more', 1);
			$this->t->assign('pos', $pos + $page_num);
		}

		//GETで受け取るとデコードされるので、再エンコード
		//検索までは、デコードされた状態でOK
		$ucd = urlencode($ucd);

		$this->t->assign('ucd', $ucd);

		$this->t->loopset("app_loop");
		while($row = $result->fetchRow()){

			$this->t->assign('id', $row['id']);
			$this->t->assign('ad_title', $row['ad_title']);

			$add_point = 0;
			if($row['ad_join_flg'] == 1){
				$this->t->assign('ad_kind', "Web");
				if($point_unit_price > 0){
					$add_point = $row['unit_price_join'] / $point_unit_price;
				}else{
					$add_point = 0;
				}
			}else{
				$this->t->assign('ad_kind', "APP");
				if($point_unit_price > 0){
					$add_point = $row['unit_price_dl'] / $point_unit_price;
				}else{
					$add_point = 0;
				}
			}
			$this->t->assign('ad_detail', $row['ad_detail']);

			if($add_point > 0){
				// 20140730 丸め処理を削除
				//$this->t->assign('ad_point', round($add_point) . '&nbsp;' . $point_label);
				//$this->t->assign('ad_point', $add_point . '&nbsp;' . $point_label);
				// 20141030 小数点第1位まで。(切り捨て)
				$this->t->assign('ad_point', (floor($add_point*10)/10) . '&nbsp;' . $point_label);
			}

			$price = $row['ad_price'] == 0 ? '無料' : $row['ad_price'] . '円';
			$this->t->assign('ad_price', $price);

			// アイコン画像のパスを取得する
			$link = $this->db->getValue("SELECT link FROM d_banner WHERE ad_cd = ? AND del_flg = 0 ORDER BY banner_size_cd ASC LIMIT 1", $row['id']);
			if($link){
				$this->t->assign('image_url', G_HTTP_ROOT . $link);
			}else{
				$this->t->assign('image_url', G_HTTP_ROOT . 'files/banner/deadlink.gif');
			}

			// 詳細ページのURL
			// ad_detail.php?acd=%--id--%&scd=%--&site_cd--%
			$detail_url = "ad_detail.php?acd={$row['id']}&scd={$site->id}&ucd={$ucd}{$other_param}";
			if($prev == 1){
				$detail_url = '#';
				//$detail_url .= "&prev=1";
			}
			$this->t->assign('detail_url', $detail_url);

			$this->t->loopnext();
		}
		$this->t->loopend();

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
