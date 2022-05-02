<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.example.com/unknown
 * @since      1.0.0
 *
 * @package    Cfa_News
 * @subpackage Cfa_News/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cfa_News
 * @subpackage Cfa_News/includes
 * @author     Developer Junayed <admin@easeare.com>
 */
class Cfa_News_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
		$cfa_news = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}cfa_news` (
			`ID` INT NOT NULL AUTO_INCREMENT,
			`news_url` VARCHAR(500) NOT NULL,
			`data` LONGTEXT NOT NULL,
			`date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`ID`)) ENGINE = InnoDB";
		dbDelta($cfa_news);
	}

}
