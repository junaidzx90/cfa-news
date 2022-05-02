<?php
class CFA_News_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items() {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $action = $this->current_action();

        $data = $this->table_data();
        usort($data, array(&$this, 'sort_data'));

        $perPage = 20;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page' => $perPage,
        ));

        $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->items = $data;
    }

    // function display_tablenav($which){

    // }
    
    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'news_title' => 'News title',
            'date' => 'Date'
        );

        return $columns;
    }

    function extra_tablenav( $which )
    {
        switch ( $which )
        {
            case 'top':
                global $wpdb;
                $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cfa_news");

                $dates = [];
                if($results){
                    foreach($results as $news){
                        $newsDate = $news->date;

                        $date = date("j F, Y", strtotime($newsDate));

                        $year = explode(', ', $date)[1];
                        $dates[$year] = $year;
                    }
                }

                asort($dates);
                ?>
                <select name="news-filter">
                    <option value="">Select all date</option>
                    <?php
                    if(sizeof($dates) > 0){
                        foreach($dates as $date){
                            echo '<option value="'.$date.'">'.$date.'</option>';
                        }
                    }
                    ?>
                </select>
                <button class="button-secondary">Filter</button>
                <?php
                break;
        }
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns() {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns() {
        return array(
            'news_title' => array('news_title', true),
            'date' => array('date', true)
        );
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data() {
        global $wpdb;
        $Tbldata = array();
        
        if(isset($_POST['news-filter'])){
            $filter = $_POST['news-filter'];
            $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cfa_news WHERE date LIKE '$filter%'");
        }else{
            $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cfa_news");
        }

		if($results){
			foreach($results as $news){
				$newsTitle = null;

				$newsDate = $news->date;

				$data = $news->data;
				if(!empty($data)){
					$data = unserialize($data);
					if(array_key_exists('title', $data)){
						$newsTitle = $data['title'];
					}
				}

				$newsArr = array(
					'ID' => $news->ID,
					'news_title' => $newsTitle,
					'date' => date("Y-m-d", strtotime($newsDate))
				);

				$Tbldata[] = $newsArr;
			}
        }
       
        return $Tbldata;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default($item, $column_name) {
        switch ($column_name) {
            case $column_name:
                return $item[$column_name];
            default:
                return print_r($item, true);
        }
    }

    public function column_news_title($item) {
        $actions = array(
            'edit' => '<a href="?page=cfa-news&action=edit&id='.$item['ID'].'">Edit</a>',
            'delete' => '<a href="?page=cfa-news&action=delete&news='.$item['ID'].'">Delete</a>',
        );

        return sprintf('%1$s %2$s', $item['news_title'], $this->row_actions($actions));
    }

    public function get_bulk_actions() {
        $actions = array(
            'delete' => 'Delete',
        );
        return $actions;
    }

    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="news[]" value="%s" />', $item['ID']
        );
    }

    // All form actions
    public function current_action() {
        global $wpdb;
        if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'cfa-news') {
            if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['news'])) {
                if(is_array($_REQUEST['news'])){
                    $ids = $_REQUEST['news'];
                    foreach($ids as $ID){
                        $wpdb->query("DELETE FROM {$wpdb->prefix}cfa_news WHERE ID = $ID");
                    }
                }else{
                    $ID = intval($_REQUEST['news']);
                    
                    $wpdb->query("DELETE FROM {$wpdb->prefix}cfa_news WHERE ID = $ID");
                }

                wp_safe_redirect( admin_url("admin.php?page=cfa-news") );
                exit;
            }
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data($a, $b) {
        // If no sort, default to user_login
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'news_title';
        // If no order, default to asc
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';
        // Determine sort order
        $result = strnatcmp($a[$orderby], $b[$orderby]);
        // Send final sort direction to usort
        return ($order === 'asc') ? $result : -$result;
    }

} //class
