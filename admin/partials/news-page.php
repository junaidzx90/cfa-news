<?php
$news_id = null;

$newsUrl = null;
$newsTitle = null;
$newsDate = null;
$newsImage = null;
$newsDescription = null;

if(isset($_GET['page']) && $_GET['page'] === 'cfa-news' && isset($_GET['action']) && $_GET['action'] !== 'delete'){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $news_id = intval($_GET['id']);
    }

    if($news_id !== null){
        global $wpdb;
        $news = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}cfa_news WHERE ID = $news_id");
        if($news){
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
        }
    }

    ?>
    <div id="cfa-news">
        <div class="addnew_box">
            <h3 class="heading3">CFA News</h3>
            <a href="?page=cfa-news&action=add" class="button-secondary">Add new</a>
        </div>
        <hr>

        <div class="cfa_news_contents">
            <div class="cfa-news-section">
                <input type="text" id="cfa-news-url" placeholder="News URL" value="<?php echo (($newsUrl) ? $newsUrl : '') ?>">
                <div class="date">
                    <input type="date" id="cfa-news-date" value="<?php echo (($newsDate) ? $newsDate : '') ?>">
                    <small style="color: red">Optional</small>
                </div>
                
                <div class="cfa-news-buttons">
                    <?php
                    if($news_id !== null){
                        echo '<button data-id="'.$news_id.'" id="regenrate_nes" class="button-secondary">ReGenerate</button>';
                    }else{
                        echo '<button id="get_and_save_news" class="button-primary">Get and save</button>';
                    }
                    ?>
                </div>
            </div>

            <?php if($news_id !== null){ ?>
                <div id="cfa-news-preview">
                    <div class="vfa-news-contents">
                        <h1 class="cfa-news-title"><?php echo (($newsTitle) ? $newsTitle : '') ?></h1>
                        <p class="cfa-news-date"><?php echo (($newsDate) ? date("F j, Y", strtotime($newsDate)) : '') ?></p>
                        <div class="cfa-news-contents">
                            <p><?php echo (($newsDescription) ? $newsDescription : '') ?></p>
                        </div>
                        <button class="cfa-readmore">Read more</button>
                    </div>

                    <div class="cfa-news-thumbnail">
                        <img src="<?php echo (($newsImage) ? $newsImage : '') ?>" alt="">
                    </div>
                </div>
            <?php } ?>
        </div>


        <div class="cfa_news_Loader">
            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
                <path fill="#2271b1" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                C22.32,8.481,24.301,9.057,26.013,10.047z">
                <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.9s" repeatCount="indefinite"></animateTransform>
                </path>
            </svg>
        </div>
    </div>
    <?php
}else{
    $newses = new CFA_News_Table();
    ?>
    <form action="" method="post">
        <div class="wrap" id="newses-table">
            <div class="addnew_box">
                <h3 class="heading3">CFA News</h3>
                <a href="?page=cfa-news&action=add" class="button-secondary">Add new</a>
            </div>
            <hr>
            <?php $newses->prepare_items(); ?>
            <?php $newses->display(); ?>
        </div>
    </form>
    <?php
}
