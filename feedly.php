<?php
//ini_set('display_errors','on');
//error_reporting(E_ALL);
class Feedly {

	protected $api = 'http://cloud.feedly.com/v3/feeds/feed%2F';

	function __construct(){
		$callback = "callback";
		if(isset($_GET['callback'])){
		    $callback=$_GET['callback'];
		}
if(!$_POST['url']){
	$_POST['url'] = 'http://www.naenote.net/feed';
}

		$url = str_replace('?callback=jsoncallback','', $_POST['url']);

		if($_POST['url']){
			if(!$json = $this->request($this->api.urlencode($url))){
				if(!$json = $this->request($this->api.urlencode($url))){
					if(!$json = $this->request($this->api.urlencode($url))){
						die('取得エラー');
					}
				}
			}
			//print $json;
			//jsonではなくjavascript指定です。
header("Access-Control-Allow-Origin: *");
header("Content-type: application/x-javascript");
print $callback."(".$json.")";
			exit;
		} 
	}

	public function request($query, $option=null, $info=false){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $query);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		if(!is_null($option)){
			curl_setopt($ch, CURLOPT_POSTFIELDS,$option);
			curl_setopt ($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		}

		
		$res = curl_exec($ch);

		if($info != false){
			$pageinfo = curl_getinfo($ch);
			return $pageinfo;
		}

		if(curl_errno($ch)){
			return false;
		}
		
		return $res;
	}
}

new Feedly();