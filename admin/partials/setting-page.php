<h3>Setting</h3>
<hr>
<form style="width: 75%;" method="post" action="options.php">
    <?php
    settings_fields( 'cfa_news_opt_section' );
    do_settings_sections('cfa_news_opt_page');
    echo get_submit_button( 'Save Changes', 'secondary', 'save-news-setting' );
    ?>
</form>