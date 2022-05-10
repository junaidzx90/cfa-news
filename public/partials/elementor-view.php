<div id="cfa_news">
    <div class="cfa__news_filter">
        <p>Sort by year</p>
        <div class="years_filter">
            <div class="years_btns">
                <?php
                echo '<span class="yrbtn year cfaActive">All</span>';
                $cat = get_cat_ID($atts['category']);
                
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'category' => [$cat],
                    'numberposts' => -1,
                    'orderby' => 'date',
                    'order'     => 'DESC',
                    'fields'    => 'ids'
                );

                $results = get_posts($args);

                $dates = [];
                if($results){
                    foreach($results as $news){
                        $date = get_the_date( 'j F, Y', $news );

                        $year = explode(', ', $date)[1];
                        $dates[$year] = $year;
                    }
                }

                asort($dates);

                if(sizeof($dates)){
                    foreach($dates as $year){
                        echo '<span class="yrbtn year">'.$year.'</span>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="cfa_news__contents">
        <?php
        global $wpdb;
        $perload = ((get_option('cfa_news_perload')) ? get_option('cfa_news_perload') : 5);
        $cat = get_cat_ID($atts['category']);

        $args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'cat' => [$cat],
			'posts_per_page' => $perload,
			'paged' => 1,
			'orderby' => 'date',
			'order'     => 'DESC'
		);

        
		$results = new WP_Query( $args );
		$len = ((get_option('news_excerpt_length')) ? get_option('news_excerpt_length') : 10);
				
		if ( $results->have_posts() ){
            $line1 = [];

			while ( $results->have_posts() ){
				$results->the_post();
				$post_id = get_post()->ID;

				$exerpt_txt = $wpdb->get_var("SELECT post_excerpt FROM {$wpdb->prefix}posts WHERE ID = $post_id");
				$excerpt = wp_trim_words($exerpt_txt, $len);

				$newsURL = get_post_meta(get_post()->ID, 'cfa_news_url', true);
                
                $line = get_the_date( "F, Y", get_post()->ID );
                $lineDate = '';
                if(!in_array($line, $line1)){
                    $line1[] = $line;
                    $lineDate = $line;
				}

				$newsArr = array(
					'id' => get_post()->ID,
					'url' => (($newsURL) ? $newsURL : get_the_permalink( get_post()->ID )),
					'title' => get_the_title(),
					'image' => get_the_post_thumbnail_url( get_post()->ID ),
					'description' => $excerpt,
					'date_line' => $lineDate,
					'date' => get_the_date( "F j, Y", get_post()->ID )
				); ?>
                    <!-- News -->
                    <div class="cfa__news">
                        <?php 
                        if($newsArr['date_line']){
                        ?>
                        <div class="top-date">
                            <p><?php echo $newsArr['date_line'] ?></p>
                            <span class="date__line"></span>
                        </div>
                        <?php
                        }
                        ?>

                        <div class="_content">
                            <div class="news__info">
                                <h3 class="head3"><?php echo $newsArr['title'] ?></h3>
                                <p class="cfa_news__date"><?php echo $newsArr['date'] ?></p>
                                <p class="news-excerpt"><?php echo $newsArr['description'] ?></p>

                                <a href="<?php echo $newsArr['url'] ?>" target="_blank" class="readmorenews">Read More</a>
                            </div>
                            <div style="background-image: url(<?php echo $newsArr['image'] ?>)" class="news__image">
                                <!-- <img :src="news.image" alt="thumbnail-img"> -->
                            </div>
                        </div>
                    </div> <!-- // News -->
                <?php 
            } 
            wp_reset_postdata();

            if($results->max_num_pages > 1){
                echo '<div class="loadmore_news_box">
                <button class="loadmore_news">Load More</button>
                </div>';
            }
            
        }else{
            echo '<div class="cfa_news_alert">Sorry, there are no news items to show right now.</div>';
        }
        ?>
    </div>
</div>