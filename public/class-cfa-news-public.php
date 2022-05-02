<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.example.com/unknown
 * @since      1.0.0
 *
 * @package    Cfa_News
 * @subpackage Cfa_News/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cfa_News
 * @subpackage Cfa_News/public
 * @author     Developer Junayed <admin@easeare.com>
 */
class Cfa_News_Public {

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

	private $icsName;

	private $icsData;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( 'cfa_news', [$this, 'cfa_news_callback'] );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		global $post;
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'cfa_news') ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		global $post;
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'cfa_news') ) {
			wp_enqueue_script( 'cfavue', plugin_dir_url( __FILE__ ) . 'js/vue.min.js', array(  ), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/index.js', array( 'jquery', 'cfavue' ), $this->version, true );
			wp_localize_script( $this->plugin_name, 'cfa_news_ajax', array(
				'ajaxurl' => admin_url( "admin-ajax.php" ),
				'nonce'	=> wp_create_nonce( "news_nonce" )
			) );
		}
	}

	function wp_head_scripts(){
		?>
		<style>
			:root{
				--cfa_news_static_color: <?php echo ((get_option('cfa_news_static_color')) ? get_option('cfa_news_static_color') : '#3E3F94') ?>;
				--cfa_news_static_text_color: <?php echo ((get_option('cfa_news_static_text_color')) ? get_option('cfa_news_static_text_color') : '#FFFFFF') ?>;
				--cfa_news_selected_color: <?php echo ((get_option('cfa_news_selected_color')) ? get_option('cfa_news_selected_color') : '#8FD9F9') ?>;
				--cfa_news_selected_text_color: <?php echo ((get_option('cfa_news_selected_text_color')) ? get_option('cfa_news_selected_text_color') : '#ffffff') ?>;
				--cfa_news_title_color: <?php echo ((get_option('cfa_news_title_color')) ? get_option('cfa_news_title_color') : '#333333') ?>;
				--cfa_news_title_font_size: <?php echo ((get_option('cfa_news_title_font_size')) ? get_option('cfa_news_title_font_size').'px' : '18px') ?>;
				--cfa_news_title_font_weight: <?php echo ((get_option('cfa_news_title_font_weight')) ? get_option('cfa_news_title_font_weight') : '700') ?>;
				--cfa_news_date_color: <?php echo ((get_option('cfa_news_date_color')) ? get_option('cfa_news_date_color') : '#E91934') ?>;
				--cfa_news_date_font_size: <?php echo ((get_option('cfa_news_date_font_size')) ? get_option('cfa_news_date_font_size').'px' : '14px') ?>;
				--cfa_news_date_font_weight: <?php echo ((get_option('cfa_news_date_font_weight')) ? get_option('cfa_news_date_font_weight') : '500') ?>;
				--cfa_news_content_text_color: <?php echo ((get_option('cfa_news_content_text_color')) ? get_option('cfa_news_content_text_color') : '#646464') ?>;
				--cfa_news_content_font_size: <?php echo ((get_option('cfa_news_content_font_size')) ? get_option('cfa_news_content_font_size').'px' : '16px') ?>;
				--cfa_news_content_font_weight: <?php echo ((get_option('cfa_news_content_font_weight')) ? get_option('cfa_news_content_font_weight') : '100') ?>;
			}
		</style>
		<?php
	}

	function get_news_data(){
		if(!wp_verify_nonce( $_GET['nonce'], "news_nonce" )){
			die("Invalid Request!");
		}

		$page = 0;
		if(isset($_GET['page'])){
			$page = intval($_GET['page']);
		}

		$filter = '';
		if(isset($_GET['filter'])){
			$filter = $_GET['filter'];
		}

		global $wpdb;

		$perload = ((get_option('cfa_news_perload')) ? get_option('cfa_news_perload') : 5);

		if(!empty($filter) && $filter !== 'all'){
			$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cfa_news WHERE date LIKE '$filter%' ORDER BY date DESC LIMIT $page, $perload");

			$total_rows = $wpdb->query("SELECT * FROM {$wpdb->prefix}cfa_news WHERE date LIKE '$filter%'");
		}else{
			$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cfa_news ORDER BY date DESC LIMIT $page, $perload");

			$total_rows = $wpdb->query("SELECT * FROM {$wpdb->prefix}cfa_news");
		}


		$num_rows = $total_rows;
		$newsData = [];
		if($results){
			foreach($results as $news){

				$newsUrl = null;
				$newsTitle = null;
				$newsDate = null;
				$newsImage = null;
				$newsDescription = null;

				$newsUrl = $news->news_url;
				$newsDate = $news->date;

				$data = $news->data;
				if(!empty($data)){
					$data = unserialize($data);
					if(array_key_exists('title', $data)){
						$newsTitle = $data['title'];
					}
					if(array_key_exists('description', $data)){
						$newsDescription = $data['description'];
					}
					if(array_key_exists('image', $data)){
						$newsImage = $data['image'];
					}
				}

				$newsArr = array(
					'id' => $news->ID,
					'url' => $newsUrl,
					'title' => $newsTitle,
					'image' => $newsImage,
					'description' => $newsDescription,
					'date_line' => date("F, Y", strtotime($newsDate)),
					'date' => date("F j, Y", strtotime($newsDate))
				);

				$newsData[] = $newsArr;
			}
		}

		echo json_encode(array(
			"success" => $newsData, 
			'numrows' => $num_rows
		));
		die;
	}

	function cfa_news_callback(){
		ob_start();
		require_once plugin_dir_path( __FILE__ ). 'partials/cfa-news.php';
		$output = ob_get_contents();
		ob_get_clean();
		return $output;
	}

}
