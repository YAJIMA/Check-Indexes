<?php
/**
 * Check Indexes - start up
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

error_reporting(E_ALL);

if(!isset($_SESSION)){
	session_name('checkindexes');
	session_start();
}

$startNowTime = microtime(true);
ini_set('default_mimetype', 'text/html');
ini_set('default_charset', 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_http_input('pass');
mb_http_output('UTF-8');

require dirname(__FILE__).'/config.php';
