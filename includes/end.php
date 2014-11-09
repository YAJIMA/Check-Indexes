<?php
/**
 * Check Indexes - end script
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

$endNowTime = microtime(true);
if($startNowTime){
	$spanTime = $endNowTime - $startNowTime;
}else{
	$spanTime = $endNowTime;
}
if(DEBUG){
	echo '<!-- '.print_r($_SESSION, true).' -->';
}
