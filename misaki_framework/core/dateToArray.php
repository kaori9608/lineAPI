<?php	
	class dateToArray{
		function dateArray($this_year = null , $this_month = null){
			$target_date = $this_year . $this_month . "01";
			//月初を取得する
			$month_start = date("Y-m-01", strtotime($target_date));
			//月末を取得する
			$month_end = date("Y-m-t", strtotime($target_date));
			//日付を配列に格納する
			$start = strtotime($month_start);
			$end = strtotime($month_end);
			// 1日の秒数
			$sec = 60 * 60 * 24;// 60秒 × 60分 × 24時間
			// 日付取得
			$key = 0;
			//曜日を表示
			$week = array("日", "月", "火", "水", "木", "金", "土");
			//日付を一行ずつ配列に格納
			for ($i = $start ; $i <= $end ; $i += $sec) {
			    $dates[$key]['date'] = date("Y-m-d", $i);
			    $w = date("w", $i);
			    $dates[$key]['week'] = $week[$w];
			    $key ++;
			}
			return $dates;
		}
		
		function getPublicHolliday($dateTarget){
			if($dateTarget){
				$year = date('Y',strtotime($dateTarget));
				$month= date('m',strtotime($dateTarget));
				
				// 月初日
				$first_day = mktime(0, 0, 0, intval($month), 1, intval($year));
				// 月末日
				$last_day = strtotime('-1 day', mktime(0, 0, 0, intval($month) + 1, 1, intval($year)));
				$api_key = 'AIzaSyD_5Uh86FZF-wn8ymAZVu3JtELbwRuTSgs';
				$holidays_id = 'japanese__ja@holiday.calendar.google.com';  // Google 公式版日本語
				$holidays_url = sprintf(
					'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
					'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
					$holidays_id,
					$api_key,
					date('Y-m-d', $first_day).'T00:00:00Z' ,  // 取得開始日
					date('Y-m-d', $last_day).'T00:00:00Z' ,   // 取得終了日
					31            // 最大取得数
				);
				if ( $results = file_get_contents($holidays_url) ) {
					$results = json_decode($results);
					$holidays = array();
					foreach ($results->items as $item ) {
						$date  = strtotime((string) $item->start->date);
						$title = (string) $item->summary;
						$holidays[date('Y-m-d', $date)] = $title;
					}
					ksort($holidays);
				}
		
				$holiday = "";
				foreach ($holidays as $key => $holiday_item) {
					if($key==date('Y-m-d',strtotime($dateTarget))){
						$holiday = $holiday_item;
					}else{
					}
				}
			
				return $holiday;
			}
		}
	
	}


?>