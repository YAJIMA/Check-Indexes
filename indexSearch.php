<?php
/**
 * Check Indexes - IndexSearch.php
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     Check Indexes
 * @author      Y.Yajima <yajima@hatchbit.jp>
 * @copyright   2014, HatchBit & Co.
 * @license     This software is released under the MIT License.
 *              http://opensource.org/licenses/mit-license.php
 * @link        http://www.hatchbit.jp
 * @since       Version 1.0
 * @filesource
 */

// ex.    http://your.domain/indexSearch.php?q=site%3Ahttp%3A%2F%2Fwww.ocn.ne.jp&u=aol

/*====================
  DEFINE
  ====================*/
// スタートスクリプト
require dirname(__FILE__).'/includes/start.php';
// 必要モジュールを読み込み
include dirname(__FILE__).'/includes/simple_html_dom.php';

// 検索URL
$hosts = parse_ini_file(dirname(__FILE__).'/indexSearchHosts.ini',true);

/*====================
  BEFORE ACTIONS
  ====================*/

// リクエストパラメータ
$query = strval($_GET['q']);
$host = strval($_GET['u']);
if(isset($_GET['debug']) && $_GET['debug'] == '1'){
    $debug = true;
}else{
    $debug = false;
}

/*====================
  MAIN ACTIONS
  ====================*/

// 検索キーワードをURLエンコード
$querywords = $query;
$querykeywords = urlencode($querywords);
// 検索サイトを指定
if(isset($_GET['u'])){
    $hostArr = $hosts[$host];
    $url = $hostArr['url'];
    $pattern = $hostArr['pattern'];
    $xpath = $hostArr['xpath'];
}else{
    $hostArr = $hosts[0];
    $url = $hostArr['url'];
    $pattern = $hostArr['pattern'];
    $xpath = $hostArr['xpath'];
}
// URLを組み立て
$url = str_replace('<<KEYWORDS>>',$querykeywords,$url);

$result = scraping($url ,$xpath,$pattern,$debug);

/*====================
  AFTER ACTIONS
  ====================*/

// 結果を出力
echo $result;

/*====================
  FUNCTIONS
  ====================*/

function scraping($searchurl = '', $xpath = '', $pattern = '', $debug = false) {
    $context = stream_context_create(
        array('http' => array(
            'method' => 'GET',
            'header' => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0 ',
            )
        )
    );
    
    $dom = file_get_html($searchurl,false,$context,-1,-1,true,true,'UTF-8',true,"\r\n"," ");
    
    $domtext = $dom->find($xpath,0)->plaintext;
    if(preg_match($pattern, $domtext, $matches)){
        // 1,000の位のカンマを削除
        $response = str_replace(',','',$matches[1]);
        $response = intval($response);
    }else{
        // エラー
        if($debug){
            $response = 'URL . '.$searchurl.PHP_EOL;
            $response .= 'DOMTEXT . '.$domtext.PHP_EOL;
            $response .= 'DOM . '.$dom;
        }else{
            $response = "undefinedError";
        }
    }
    // DOM をクリア
    $dom->clear();
    
    return $response;
}
?>