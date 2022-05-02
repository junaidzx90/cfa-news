<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.example.com/unknown
 * @since      1.0.0
 *
 * @package    Cfa_News
 * @subpackage Cfa_News/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cfa_News
 * @subpackage Cfa_News/admin
 * @author     Developer Junayed <admin@easeare.com>
 */
class Cfa_News_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cfa_News_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cfa_News_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cfa-news-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cfa_News_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cfa_News_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cfa-news-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( $this->plugin_name, 'newsajax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'news_nonce' )
		) );

	}

	// menupage
	function admin_menupage(){
		$icon_url = 'data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIGZpbGw9IiM5Y2EyYTciIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAxMDAwIDEwMDAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEwMDAgMTAwMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8bWV0YWRhdGE+IFN2ZyBWZWN0b3IgSWNvbnMgOiBodHRwOi8vd3d3Lm9ubGluZXdlYmZvbnRzLmNvbS9pY29uIDwvbWV0YWRhdGE+DQo8Zz48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjAwMDAwMCw1MTEuMDAwMDAwKSBzY2FsZSgwLjEwMDAwMCwtMC4xMDAwMDApIj48cGF0aCBkPSJNMTYyMS40LDM4NzguNWMtMzIuNy0xNC4zLTc5LjYtNDctMTAyLjEtNzMuNWMtMzguOC00Mi45LTQwLjgtODEuNy01MS4xLTYwMC40bC0xMC4yLTU1My40bC02MTIuNi0xMC4yYy0zMzctNi4xLTYyNC45LTE4LjQtNjQxLjItMjguNmMtMTQuMy0xMC4yLTQ0LjktNTUuMS02NS40LTEwMi4xQzEwMiwyNDMwLjYsMTAwLDIzMzAuNSwxMDAsMTE2LjljMC0xNDU2LjEsOC4yLTIzODcuMywyMC40LTI1MThjNzEuNS02ODguMiwzNTcuNC0xMDc0LjIsOTEyLjgtMTIzMy40bDE1OS4zLTQ0LjlsMzgxOC44LTYuMWMyNzg1LjUtNC4xLDM4NTUuNiwwLDM5NTcuNywxOC40YzM3OS44LDYzLjMsNzA4LjYsMzUzLjMsODcwLDc2OS45bDUzLjEsMTM2LjhsNi4xLDMyMjYuNmM0LjEsMzEwMiw0LjEsMzIyOC42LTMyLjcsMzI5NmMtMjAuNCwzOC44LTY5LjUsODcuOC0xMDguMiwxMDguMmMtNjUuNCwzNC43LTIzMi44LDM2LjgtNDA3MiwzNi44QzI0MDkuNywzOTA1LDE2NzIuNSwzOTAwLjksMTYyMS40LDM4NzguNXogTTkyMDgsMjgyLjNjMC0zMjM2LjgsMTAuMi0zMDA4LjEtMTI4LjctMzE1MWMtMTMwLjctMTM2LjgsMTY1LjQtMTI2LjYtMzY0OS4zLTEyNi42Yy0xOTA5LjQsMC0zNDcxLjcsMi0zNDcxLjcsNi4xczIyLjUsNjEuMyw0OSwxMjguN2MxMjguNywzMTYuNSwxMjIuNSwxNDkuMSwxMjguNywzMjUxLjFsOC4yLDI4MjIuM2gzNTMwLjlIOTIwOFYyODIuM3ogTTE0NTgtMjA3LjljMC0xOTY4LjYtNC4xLTIxNzktMzQuNy0yMzE1LjhjLTY3LjQtMjg1LjktMTYzLjQtNDEwLjUtMzIwLjYtNDEwLjVjLTk2LDAtMTg1LjgsMTAwLjEtMjQ5LjEsMjc3LjdsLTQ5LDE0MC45bC02LjEsMjI0Mi4zTDc5Mi4zLDE5NjdsMzMyLjktNC4xbDMzMi45LTYuMVYtMjA3Ljl6Ii8+PHBhdGggZD0iTTc1NzguMywyNTI4LjZjLTE4Ny45LTU5LjItMzA4LjQtMjEyLjQtMzEwLjQtMzk0LjFjMC0xODEuOCwxMjQuNi0zMjAuNiwzNjUuNS00MTAuNWMxODUuOC03MS41LDI0NS4xLTE0MywxNzUuNi0yMTQuNGMtNTEuMS01MS4xLTE1Ny4yLTU5LjItMjg3LjktMjIuNWMtNjcuNCwxOC40LTEzOC45LDM2LjgtMTYzLjQsNDIuOWMtMzguOCwxMC4yLTQ3LTItNzcuNi0xMjIuNWMtMTguNC03My41LTMyLjctMTQwLjktMzIuNy0xNTMuMmMwLTI4LjYsMTc5LjctODMuNywzMjYuNy05NmMxNjcuNS0xNi4zLDM2OS42LDMyLjcsNDY5LjcsMTEwLjNjOTEuOSw3My41LDE2My40LDIxNC40LDE2My40LDMyMC42Yy0yLjEsMTg5LjktMTIwLjUsMzIyLjctMzgzLjksNDI4LjhjLTE2NS40LDY1LjQtMTg3LjksODMuNy0xODcuOSwxNDNjMCw4OS44LDE0MC45LDExNC40LDMyNi44LDU5LjJjODMuNy0yNC41LDExMi4zLTI2LjUsMTIyLjUtNi4xYzIwLjQsMzIuNyw2OS41LDI2MS40LDU5LjIsMjczLjZjLTYuMiw0LjEtNjMuMywyMi41LTEzMC43LDQwLjhDNzg2OC4zLDI1NjUuNCw3Njk2LjgsMjU2NS40LDc1NzguMywyNTI4LjZ6Ii8+PHBhdGggZD0iTTMyNDQuOSwxODU0Ljd2LTY4NC4xaDE2My40aDE2My40djQxNC42djQxMi41bDEwOC4yLTIwNC4yYzU5LjItMTEyLjMsMTYxLjMtMjk4LjIsMjI2LjctNDE0LjZsMTE4LjQtMjEwLjNsMTc1LjYsNi4xbDE3Ny43LDYuMXY2NzMuOXY2NzMuOWgtMTYzLjRoLTE2My40di0zNjMuNWMwLTE5OC4xLTItMzYxLjUtNC4xLTM2MS41YzAsMC00OSw4NS44LTEwNC4xLDE4OS45Yy01NS4xLDEwMi4xLTE0NywyNjUuNS0yMDIuMiwzNjEuNWwtMTAwLjEsMTczLjZsLTE5OC4xLDYuMWwtMTk4LjEsNi4xVjE4NTQuN3oiLz48cGF0aCBkPSJNNDU3Mi4zLDE4NTQuN3YtNjg0LjFoNDM5LjFoNDM5LjFsMTAuMiw0N2M4LjIsMjYuNiwxMC4yLDkzLjksNi4xLDE0OS4xbC02LjEsMTAwLjFsLTI2NS41LDEwLjJsLTI2NS41LDEwLjJ2MTEyLjN2MTEyLjNsMjM0LjgsMTAuMmwyMzQuOCwxMC4ydjE0Mi45djE0Mi45bC0yMzQuOCwxMC4ybC0yMzQuOCwxMC4ydjkxLjl2OTEuOWwyNTEuMiw2LjFsMjQ5LjEsNi4xdjE1MS4xdjE1My4yaC00MjguOWgtNDI4LjhWMTg1NC43eiIvPjxwYXRoIGQ9Ik01NTExLjcsMjUxMC4yYzAtMTYuMyw2OS41LTMyMC42LDE1My4yLTY3My45YzgzLjctMzUzLjMsMTUzLjItNjQ5LjQsMTUzLjItNjU1LjVjMC0xOC40LDM2NS41LTEwLjIsMzc3LjgsOC4yYzYuMSwxMi4zLDQ3LDE4My44LDkxLjksMzgzLjljNDIuOSwyMDAuMSw3OS43LDM1OS40LDc5LjcsMzUzLjNjMi02LjEsMzQuNy0xNzMuNiw3My41LTM3My43YzM4LjgtMjAwLjEsNzEuNS0zNjcuNiw3MS41LTM3My43YzAtNi4xLDg1LjgtNi4xLDE4Ny45LTQuMWwxODkuOSw2LjFsMTY3LjUsNjQzLjNjOTEuOSwzNTMuMywxNjcuNSw2NTkuNiwxNjcuNSw2ODBjMiwzMi43LTE2LjQsMzQuNy0xNzUuNiwzMC42bC0xNzkuNy02LjFsLTY1LjQtMzE2LjVjLTM0LjctMTczLjYtNjUuNC0zNDEtNjUuNC0zNzEuN2MtNC4xLTEzNC44LTM2LjgtMzQuNy05MS45LDI3NS43Yy04MS43LDQ2MS41LTU3LjIsNDI0LjgtMjcxLjYsNDE4LjZsLTE3Ny43LTYuMWwtNjUuMy0zMTYuNWMtMzQuNy0xNzMuNi03MS41LTM1MS4zLTc3LjYtMzk2LjJjLTguMi00Mi45LTE4LjQtNzMuNS0yMi41LTcxLjVjLTQuMSw0LjEtMzQuNywxNjkuNS03MS41LDM2NS41Yy0zNC43LDE5Ni02Ny40LDM3My43LTczLjUsMzk0LjFjLTEwLjIsMjguNi0zNi44LDM0LjctMTk0LDM0LjdDNTU0OC40LDI1MzguOCw1NTExLjcsMjUzMi43LDU1MTEuNywyNTEwLjJ6Ii8+PHBhdGggZD0iTTU3MzAuMiw2NDUuOGMtOC4yLTYuMS0xNC4zLTMyMi43LTE0LjMtNzAyLjVjMC02NjEuNywyLTY5Mi4zLDM4LjgtNzEyLjdjNjMuMy0zMi43LDI2NTguOS0yOC42LDI3MDMuOCw2LjFjMzIuNywyMi41LDM0LjcsODMuNywzMC42LDcxOC44bC02LjEsNjk0LjNMNzExMi43LDY1NkM2MzU5LjIsNjU4LDU3MzYuMyw2NTMuOSw1NzMwLjIsNjQ1Ljh6Ii8+PHBhdGggZD0iTTMzNjcuNCw1ODAuNGMtMTQ1LTQ0LjktMjg1LjktMTY3LjUtMjg1LjktMjQ5LjFjMC0yNTEuMiw0OTIuMi0zNDUuMSw3NTMuNS0xNDVjNjEuMyw0NC45LDkzLjksNTUuMSwxODcuOSw1My4xYzM1My4zLTYuMSw3NTcuNi0yMjQuNiw4ODguMy00NzkuOWMxMzYuOC0yNzMuNy0yNC41LTY1NS41LTM0NS4xLTgxNC44Yy0xNDAuOS02Ny40LTMzMi45LTExNC4zLTU2NS43LTEzMi43Yy04My43LTYuMS0xODMuOC0xNi4zLTIxOC41LTIyLjVsLTY3LjQtMTAuMnYtMTMyLjd2LTEzMC43bDE2OS41LDEwLjJjNzY5LjksNTUuMSwxMDcwLjEsMjAyLjIsMTI4NC41LDYzOS4yYzg1LjgsMTY5LjUsODcuOCwxODEuOCw4Ny44LDM3MS43YzAsMTg1LjgtNC4xLDIwNC4yLTc1LjYsMzUxLjNjLTEwNC4xLDIxMC4zLTI3Ny43LDM3MS43LTUzMyw0OTYuMmMtMjMyLjgsMTEyLjMtNDE4LjYsMTU3LjMtNjU1LjUsMTU3LjNjLTEwOC4yLDAtMjEwLjMsMTIuMi0yNDkuMSwyOC42QzM2NzEuNyw2MDAuOCwzNDUzLjIsNjA0LjksMzM2Ny40LDU4MC40eiIvPjxwYXRoIGQ9Ik0yNTc5LjItMjAxLjdjMjIuNS0xNjEuMywxMDAuMS0zMTAuNCwyMjQuNi00MzVjMTMwLjctMTI2LjYsMjY5LjYtMjAwLjEsNDgxLjktMjUxLjJsMTUzLjItMzguOHYtMzcxLjd2LTM3My43bDU5LjIsMTIuM2MzMi43LDYuMSw3NS42LDEyLjIsOTYsMTIuMmMzNi44LDAsMzguOCwyMi41LDM4LjgsMzYzLjV2MzYzLjVsMTI4LjcsMjYuNmMzODMuOSw3Ny42LDY5MC4yLDM2OS42LDcyMi45LDY4Ni4ybDEyLjIsMTEyLjNoLTk2NS45aC05NjUuOUwyNTc5LjItMjAxLjd6Ii8+PHBhdGggZD0iTTU3MjYuMS0xMjA0LjRjLTYuMS0xMi4zLTguMi0zMTguNi02LjEtNjc4bDYuMS02NTMuNWgxMzc4LjRIODQ4M3Y2NzMuOXY2NzMuOWwtMTM3NC40LDYuMUM2MDE2LjEtMTE3Ny45LDU3MzIuMi0xMTgyLDU3MjYuMS0xMjA0LjR6Ii8+PHBhdGggZD0iTTMxMjQuNC0xMzAwLjRjLTI2My40LTY5LjQtMzgzLjktMTY3LjUtNDA0LjQtMzI2LjdjLTE2LjMtMTEyLjMsNDAuOC0yMTQuNCwxNTUuMi0yODEuOGM4Ny44LTUxLjEsMTEwLjMtNTUuMSwzMTguNi01My4xYzE3OS43LDIuMSwyNzMuNiwxNC4zLDQ2OS43LDYzLjNjMTM0LjgsMzQuNywyNzcuNyw2OS40LDMyMC42LDc1LjZjOTgsMTguNCwyNTMuMi0xOC40LDM1MS4yLTgxLjdjNTMuMS0zNi44LDgzLjctNDcsOTgtMzIuN2MzMC42LDMwLjYsOC4yLDczLjUtNzMuNSwxMzYuOGMtMTYxLjMsMTIyLjUtMzE4LjYsMTM2LjgtNzEyLjcsNjkuNGMtMzEwLjQtNTMuMS02MDAuNC00OS02NjUuNywxMC4yYy0yNC41LDIyLjUtNDIuOSw1MS4xLTQyLjksNjUuM2MwLDQwLjgsOTYsODMuNywyNTcuMywxMTYuNGwxNDAuOSwyOC42bDYuMSwxMjQuNkMzMzQ5LjEtMTIzOS4xLDMzNTcuMi0xMjQxLjIsMzEyNC40LTEzMDAuNHoiLz48cGF0aCBkPSJNMzUzMC44LTIwMjUuNGMtNzcuNi0xOC40LTkxLjktMzAuNi04NS44LTY3LjRjNC4xLTMyLjctOC4yLTUxLTUxLjEtNjcuNGMtMTY1LjQtNjMuMy0yNzMuNi0xMzAuNy0zMTIuNC0xOTJjLTgzLjctMTM2LjgtOTYtMTMyLjcsNDQ5LjMtMTMyLjdjNTM5LjEsMCw1MjQuOC00LjEsNDU5LjUsMTIyLjVjLTM4LjgsNzUuNi0xMTguNCwxMzAuNy0yNDkuMSwxNzMuNmMtMTAwLjEsMzIuNy0xMDYuMiwzOC44LTExMi4zLDExMC4zbC02LjEsNzUuNUwzNTMwLjgtMjAyNS40eiIvPjwvZz48L2c+DQo8L3N2Zz4=';

		add_menu_page( 'CFA News', 'CFA News', 'manage_options', 'cfa-news', [$this, 'news_menupage_callback'], $icon_url, 45 );
		add_submenu_page( 'cfa-news', 'Settings', 'Settings', 'manage_options', 'news-setting', [$this, 'menupage_callback'] );
		add_settings_section( 'cfa_news_opt_section', '', '', 'cfa_news_opt_page' );
		// Scrapfly API
		add_settings_field( 'cfa_scrapfly_api', 'Scrapfly API', [$this, 'cfa_scrapfly_api_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_scrapfly_api' );
		// Load per load
		add_settings_field( 'cfa_news_perload', 'News per load', [$this, 'cfa_news_perload_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_perload' );

		// Static color
		add_settings_field( 'cfa_news_static_color', 'Static color', [$this, 'cfa_news_static_color_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_static_color' );
		// Static text color
		add_settings_field( 'cfa_news_static_text_color', 'Static text color', [$this, 'cfa_news_static_text_color_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_static_text_color' );
		// Selected color
		add_settings_field( 'cfa_news_selected_color', 'Selected color', [$this, 'cfa_news_selected_color_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_selected_color' );
		// Selected text color
		add_settings_field( 'cfa_news_selected_text_color', 'Selected text color', [$this, 'cfa_news_selected_text_color_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_selected_text_color' );
		// Title color
		add_settings_field( 'cfa_news_title_color', 'Title color', [$this, 'cfa_news_title_color_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_title_color' );
		// Title font size
		add_settings_field( 'cfa_news_title_font_size', 'Title font size', [$this, 'cfa_news_title_font_size_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_title_font_size' );
		// Title font weight
		add_settings_field( 'cfa_news_title_font_weight', 'Title font weight', [$this, 'cfa_news_title_font_weight_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_title_font_weight' );
		// Date color
		add_settings_field( 'cfa_news_date_color', 'Date color', [$this, 'cfa_news_date_color_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_date_color' );
		// Date font size
		add_settings_field( 'cfa_news_date_font_size', 'Date font size', [$this, 'cfa_news_date_font_size_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_date_font_size' );
		// Date font weight
		add_settings_field( 'cfa_news_date_font_weight', 'Date font weight', [$this, 'cfa_news_date_font_weight_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_date_font_weight' );
		// Content text color
		add_settings_field( 'cfa_news_content_text_color', 'Content text color', [$this, 'cfa_news_content_text_color_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_content_text_color' );
		// Content font size
		add_settings_field( 'cfa_news_content_font_size', 'Content font size', [$this, 'cfa_news_content_font_size_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_content_font_size' );
		// Content font weight
		add_settings_field( 'cfa_news_content_font_weight', 'Content font weight', [$this, 'cfa_news_content_font_weight_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_content_font_weight' );
	}
	
	function cfa_scrapfly_api_cb(){
		echo '<input class="widefat" type="text" name="cfa_scrapfly_api" id="cfa_scrapfly_api" value="'.get_option('cfa_scrapfly_api').'">';
		echo '<p>If you don\'t have an API, please create from <a target="_blank" href="https://scrapfly.io/">Here</a></p>';
	}
	function cfa_news_perload_cb(){
		echo '<input type="number" placeholder="10" style="width: 60px;" min="1" oninput="this.value = ((this.value !== \'\') ? Math.abs(this.value) : \'\')" value="'.get_option('cfa_news_perload').'" name="cfa_news_perload" id="cfa_news_perload">';
	}

	function cfa_news_static_color_cb(){
		echo '<input type="text" name="cfa_news_static_color" id="cfa_news_static_color" data-default-color="#3E3F94" value="'.((get_option('cfa_news_static_color')) ? get_option('cfa_news_static_color') : '#3E3F94').'">';
	}
	function cfa_news_static_text_color_cb(){
		echo '<input type="text" name="cfa_news_static_text_color" id="cfa_news_static_text_color" data-default-color="#FFFFFF" value="'.((get_option('cfa_news_static_text_color')) ? get_option('cfa_news_static_text_color') : '#FFFFFF').'">';
	}
	function cfa_news_selected_color_cb(){
		echo '<input type="text" name="cfa_news_selected_color" id="cfa_news_selected_color" data-default-color="#8FD9F9" value="'.((get_option('cfa_news_selected_color')) ? get_option('cfa_news_selected_color') : '#8FD9F9').'">';
	}
	function cfa_news_selected_text_color_cb(){
		echo '<input type="text" name="cfa_news_selected_text_color" id="cfa_news_selected_text_color" data-default-color="#ffffff" value="'.((get_option('cfa_news_selected_text_color')) ? get_option('cfa_news_selected_text_color') : '#ffffff').'">';
	}
	function cfa_news_title_color_cb(){
		echo '<input type="text" name="cfa_news_title_color" id="cfa_news_title_color" data-default-color="#333333" value="'.((get_option('cfa_news_title_color')) ? get_option('cfa_news_title_color') : '#333333').'">';
	}
	function cfa_news_title_font_size_cb(){
		echo '<input type="number" min="10" oninput="((this.value) ? this.value = Math.abs(this.value) : \'\')"name="cfa_news_title_font_size" placeholder="18px" value="'.get_option('cfa_news_title_font_size').'">';
	}
	function cfa_news_title_font_weight_cb(){
		echo '<input type="number" min="100" oninput="((this.value) ? this.value = Math.abs(this.value) : \'\')"name="cfa_news_title_font_weight" placeholder="700" value="'.get_option('cfa_news_title_font_weight').'">';
	}
	function cfa_news_date_color_cb(){
		echo '<input type="text" name="cfa_news_date_color" id="cfa_news_date_color" data-default-color="#E91934" value="'.((get_option('cfa_news_date_color')) ? get_option('cfa_news_date_color') : '#E91934').'">';
	}
	function cfa_news_date_font_size_cb(){
		echo '<input type="number" min="8" oninput="((this.value) ? this.value = Math.abs(this.value) : \'\')" name="cfa_news_date_font_size" placeholder="14px" value="'.get_option('cfa_news_date_font_size').'">';
	}
	function cfa_news_date_font_weight_cb(){
		echo '<input type="number" min="100" oninput="((this.value) ? this.value = Math.abs(this.value) : \'\')" name="cfa_news_date_font_weight" placeholder="500" value="'.get_option('cfa_news_date_font_weight').'">';
	}
	function cfa_news_content_text_color_cb(){
		echo '<input type="text" name="cfa_news_content_text_color" id="cfa_news_content_text_color" data-default-color="#646464" value="'.((get_option('cfa_news_content_text_color')) ? get_option('cfa_news_content_text_color') : '#646464').'">';
	}
	function cfa_news_content_font_size_cb(){
		echo '<input type="number" min="10" oninput="((this.value) ? this.value = Math.abs(this.value) : \'\')" name="cfa_news_content_font_size" placeholder="16px" value="'.get_option('cfa_news_content_font_size').'">';
	}
	function cfa_news_content_font_weight_cb(){
		echo '<input type="number" min="100" oninput="((this.value) ? this.value = Math.abs(this.value) : \'\')" name="cfa_news_content_font_weight" placeholder="100" value="'.get_option('cfa_news_content_font_weight').'">';
	}

	function news_menupage_callback(){
		require_once plugin_dir_path( __FILE__ )."partials/news-page.php";
	}
	function menupage_callback(){
		require_once plugin_dir_path( __FILE__ )."partials/setting-page.php";
	}

	// scrapfly scrapping
	function scrapfly_curl_call($url){
		if(!$url){
			return;
		}
		$scrapfly_api = get_option('cfa_scrapfly_api');

		if(!$scrapfly_api){
			return;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.scrapfly.io/scrape?key=$scrapfly_api&url=$url");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		$results = json_decode($result, true);

		$html = '';
		if(array_key_exists('result', $results)){
			$html = $results['result']['content'];
		}
		
		return $html;
	}

	function get_ogp_tags($newsUrl){
		if(!$newsUrl){
			return;
		}

		$graph = OpenGraph::fetch($newsUrl);
		$response = [];
		if($graph && is_object($graph)){ // Free Scraping
			foreach ($graph as $key => $value) {
				if($key === 'image'){
					$response[$key] = get_image_to_base64($value);
				}else{
					$response[$key] = $value;
				}
			}
		}

		if(sizeof($response) === 0){ // Using API
			$response = $this->scrapfly_curl_call($newsUrl);
			$resp = OpenGraph::_parse($response);

			$response = [];
			if($resp && is_object($resp)){
				foreach($resp as $key => $meta){
					if($key === 'image'){
						$response[$key] = 'data:image/jpg;base64,'.$this->scrapfly_curl_call($meta);
					}else{
						$response[$key] = $meta;
					}
				}
			}
		}

		return $response;
	}

	function regenrate_news(){
		if(!wp_verify_nonce( $_POST['nonce'], "news_nonce" )){
			die("Invalid Request!");
		}
		if(isset($_POST['news_id'])){
			$newsid = intval($_POST['news_id']);
			global $wpdb;
			$news_url = $wpdb->get_var("SELECT news_url FROM {$wpdb->prefix}cfa_news WHERE ID = $newsid");

			if($news_url){
				$response = $this->get_ogp_tags($news_url);

				if(sizeof($response) > 0){
					$wpdb->update($wpdb->prefix.'cfa_news', array(
						'data' => serialize($response),
					), array('ID' => $newsid), array("%s"), array('%d'));

					echo json_encode(array("success" => admin_url( "admin.php?page=cfa-news&action=edit&id=".$newsid )));
					die;
				}
			}
		}

		echo json_encode(array('error' => "Something is wrong! try again"));
		die;
	}

	function url_to_cfa_news(){
		if(!wp_verify_nonce( $_POST['nonce'], "news_nonce" )){
			die("Invalid Request!");
		}
		if(isset($_POST['newsurl']) && !empty($_POST['newsurl'])){
			$newsUrl = esc_url( $_POST['newsurl'] );

			$response = $this->get_ogp_tags($newsUrl);

			if(sizeof($response) > 0){
				global $wpdb;
				$defaultZone = wp_timezone_string();
				if($defaultZone){
					date_default_timezone_set($defaultZone);
				}

				$date = date("Y-m-d");
				if(isset($_POST['date']) && !empty($_POST['date'])){
					$date = $_POST['date'];
				}

				$wpdb->insert($wpdb->prefix.'cfa_news', array(
					'news_url' => $newsUrl,
					'data' => serialize($response),
					'date' => $date
				), array('%s', '%s', '%s'));

				if($wpdb->insert_id){
					echo json_encode(array("success" => admin_url( "admin.php?page=cfa-news&action=edit&id=".$wpdb->insert_id )));
					die;
				}
			}

			echo json_encode(array('error' => "Something is wrong! try again"));
			die;
		}
	}
}
