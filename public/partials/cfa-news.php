<div id="cfa_news">
    
    <div class="cfa__news_filter">
        <p>Sort by year</p>
        <div class="years_filter">
            <div class="years_btns">
                <?php
                echo '<span @click="news_year_filter(event, \'all\')" class="yrbtn year cfaActive">All</span>';
                $cat = ((get_option( 'cfa_news_category' )) ? get_option( 'cfa_news_category' ) : 1);
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'category' => [$cat],
                    'numberposts' => -1,
                    'orderby' => 'date',
                    'order'     => 'DESC',
                    'fields'    => 'ids',
                    // 'meta_query' => array(
                    //     array(
                    //         'key' => 'cfa_news_url',
                    //         'compare' => 'EXISTS'
                    //     )
                    // )
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
                        echo '<span @click="news_year_filter(event, \''.$year.'\')" class="yrbtn year">'.$year.'</span>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="cfa_news__contents">
        <!-- News -->
        <div v-for="news in cfaNewsObj" :key="news.id" class="cfa__news">
            <div class="top-date">
                <p>{{news.date_line}}</p>
                <span class="date__line"></span>
            </div>

            <div class="_content">
                <div class="news__info">
                    <h3 class="head3" v-html="news.title"></h3>
                    <p class="cfa_news__date">{{news.date}}</p>
                    <p class="news-excerpt" v-html="news.description"></p>

                    <a :href="news.url" target="_blank" class="readmorenews">Read More</a>
                </div>
                <div v-bind:style="{ backgroundImage: 'url(' + news.image + ')' }" class="news__image">
                    <!-- <img :src="news.image" alt="thumbnail-img"> -->
                </div>
            </div>
        </div> <!-- // News -->

        <div v-if="cfaNewsObj.length === 0" class="cfa_news_alert">Sorry, there are no news items to show right now.</div>

        <div v-if="numrows > currentPage" class="loadmore_news_box">
            <button @click="loadmore_news()" class="loadmore_news">Load More</button>
        </div>
    </div>

    <div v-if="isDisabled" class="cfaLoader">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
            <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
            <path fill="<?php echo ((get_option('cfa_news_selected_color')) ? get_option('cfa_news_selected_color') : '#8FD9F9') ?>" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
            C22.32,8.481,24.301,9.057,26.013,10.047z">
            <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.9s" repeatCount="indefinite"></animateTransform>
            </path>
        </svg>
    </div>
</div>