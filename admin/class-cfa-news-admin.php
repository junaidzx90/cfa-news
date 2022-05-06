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
		add_submenu_page( 'edit.php','CFA News', 'CFA News', 'manage_options', 'cfa-news', [$this, 'menupage_callback'], null );
		add_settings_section( 'cfa_news_opt_section', '', '', 'cfa_news_opt_page' );
		// Shortcode
		add_settings_field( 'cfa_news_shortcode', 'Shortcode', [$this, 'cfa_news_shortcode_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_shortcode' );
		// Scrapfly API
		add_settings_field( 'cfa_scrapfly_api', 'Scrapfly API', [$this, 'cfa_scrapfly_api_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_scrapfly_api' );
		// Excerpt length
		add_settings_field( 'news_excerpt_length', 'Excerpt Length', [$this, 'news_excerpt_length_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'news_excerpt_length' );
		// Load per load
		add_settings_field( 'cfa_news_perload', 'News per load', [$this, 'cfa_news_perload_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_perload' );
		// News category
		add_settings_field( 'cfa_news_category', 'News category', [$this, 'cfa_news_category_cb'], 'cfa_news_opt_page','cfa_news_opt_section' );
		register_setting( 'cfa_news_opt_section', 'cfa_news_category' );

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

	// URL meta box
	function news_url_metabox($post){
		add_meta_box( 'cfa_news_url', "Get contents by URL", [$this, "news_url_input"], 'post','advanced', 'high' );
	}

	function news_url_input($post){
		$newsUrl = get_post_meta($post->ID, 'cfa_news_url', true);
		echo '<div class="meta_box_for_url">';
		echo '<input class="widefat" type="text" id="cfa-news-url" placeholder="News URL" value="'.(($newsUrl) ? $newsUrl : '').'">';
		echo '<input type="hidden" id="cfa-post_id" value="'.$post->ID.'">';
		echo '<button id="get_news_btn" class="button-secondary">Get Contents</button>';
		echo '</div>';
	}

	function cfa_news_shortcode_cb(){
		echo '<input type="text" readonly value="[cfa_news]">';
	}
	
	function cfa_scrapfly_api_cb(){
		echo '<input class="widefat" type="text" name="cfa_scrapfly_api" id="cfa_scrapfly_api" value="'.get_option('cfa_scrapfly_api').'">';
		echo '<p>If you don\'t have an API, please create from <a target="_blank" href="https://scrapfly.io/">Here</a></p>';
	}
	function news_excerpt_length_cb(){
		echo '<input type="number" placeholder="10" style="width: 60px;" min="1" oninput="this.value = ((this.value !== \'\') ? Math.abs(this.value) : \'\')" value="'.get_option('news_excerpt_length').'" name="news_excerpt_length" id="news_excerpt_length">';
	}
	function cfa_news_perload_cb(){
		echo '<input type="number" placeholder="5" style="width: 60px;" min="1" oninput="this.value = ((this.value !== \'\') ? Math.abs(this.value) : \'\')" value="'.get_option('cfa_news_perload').'" name="cfa_news_perload" id="cfa_news_perload">';
	}
	function cfa_news_category_cb(){
		$categories = get_categories( array('hide_empty' => false) );
		if($categories){
			echo '<select name="cfa_news_category" id="cfa_news_category" class="widefat">';
			echo '<option value="">Select</option>';
			$selected = get_option( 'cfa_news_category' );
			if($selected)
				$selected = intval($selected);
			foreach($categories as $category){
				echo '<option '.((intval($category->term_id) === $selected) ? 'selected' : '').' value="'.$category->term_id.'">'.$category->name.'</option>';
			}
			echo '</select>';
		}
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
						$response[$key] = $this->scrapfly_curl_call($meta);
					}else{
						$response[$key] = $meta;
					}
				}
			}
		}

		return $response;
	}

	function setfeatured_image( $image, $post_id  ){
		$upload_dir = wp_upload_dir();
		$upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;
		$decoded = base64_decode($image);
		$filename = 'news.png';
		$hashed_filename = md5( $filename . microtime() ) . '_' . $filename;
		$image_upload = file_put_contents( $upload_path . $hashed_filename, $decoded );

		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');

        $file             = array();
        $file['error']    = '';
        $file['tmp_name'] = $upload_path . $hashed_filename;
        $file['name']     = $hashed_filename;
        $file['type']     = 'image/png';
        $file['size']     = filesize( $upload_path . $hashed_filename );

        // use $file instead of $image_upload
        $file_return = wp_handle_sideload( $file, array( 'test_form' => false ) );
        $filename = $file_return['file'];
        $attachment = array(
			'post_mime_type' => $file_return['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
			'post_content' => '',
			'post_status' => 'inherit',
			'guid' => $wp_upload_dir['url'] . '/' . basename($filename)
		);

        $attach_id = wp_insert_attachment( $attachment, $filename );

        $attachment_meta = wp_generate_attachment_metadata($attach_id, $filename );
        wp_update_attachment_metadata($attach_id,$attachment_meta);
        set_post_thumbnail($post_id,$attach_id);
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

				$post_id = null;
				if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
					$post_id = intval($_POST['post_id']);
				}

				$newsTitle = '';
				$newsDescription = '';
				$newsImage = '';
				if(array_key_exists('title', $response)){
                    $newsTitle = $response['title'];
                }
                if(array_key_exists('description', $response)){
                    $newsDescription = $response['description'];
                }
                if(array_key_exists('image', $response)){
                    $newsImage = $response['image'];
                }

				$newsPost = array(
					'ID'           => $post_id,
					'post_title'   => $newsTitle,
					'post_excerpt' => $newsDescription,
					'meta_input' => array(
						'cfa_news_url' => $newsUrl
					)
				);
			   
				$cat = ((get_option( 'cfa_news_category' )) ? intval(get_option( 'cfa_news_category' )) : 1);
			  	// Update the post into the database
				wp_update_post( $newsPost );
				wp_set_post_categories($post_id, [$cat] );
				$this->setfeatured_image($newsImage, $post_id );

				echo json_encode(array("success" => admin_url( "post.php?post=$post_id&action=edit" )));
				die;
			}

			echo json_encode(array('error' => "Something is wrong! try again"));
			die;
		}
	}

	function add_see_full_content_button($contents){
		global $post, $wpdb;
		$news_url = get_post_meta($post->ID, 'cfa_news_url', true);
		$post_id = $post->ID;
		if(is_singular( 'post' )){
			if(!empty($news_url)){
				$exerpt_txt = $wpdb->get_var("SELECT post_excerpt FROM {$wpdb->prefix}posts WHERE ID = $post_id");
				$contents .= $exerpt_txt;
				$contents .= '<div class="readarticleBox"><a target="_blank" href="'.$news_url.'" class="readfullarticle">Read the full article here</a></div>';
			}
		}

		return $contents;
	}
}
