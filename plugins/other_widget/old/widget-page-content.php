
<?php
/*-------------------------------------------*/
/*	page widget
/*-------------------------------------------*/
class wp_widget_page extends WP_Widget {
	function wp_widget_page() {
		$widget_ops = array(
			'classname' => 'WP_Widget_page_post',
			'description' => __( 'Displays the content of a chosen page.', 'biz-vektor' ),
		);
		$widget_name = vkExUnit_get_short_name() . '_' . __( 'page content for top', 'biz-vektor' );
		$this->WP_Widget('pudge', $widget_name, $widget_ops);
	}

	function widget($args, $instance){
		$this->display_page($instance['page_id'],$instance['set_title']);
	}

	function form($instance){
		$defaults = array(
			'page_id' => 2,
			'set_title' => true
		);

		$instance = wp_parse_args((array) $instance, $defaults);
		?>
		<p>
		<?php 	$pages = get_pages();	?>
		<label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e('Display page', 'biz-vektor') ?></label>
		<select name="<?php echo $this->get_field_name('page_id'); ?>" >
		<?php foreach($pages as $page){ ?>
		<option value="<?php echo $page->ID; ?>" <?php if($instance['page_id'] == $page->ID) echo 'selected="selected"'; ?> ><?php echo $page->post_title; ?></option>
		<?php } ?>
		</select>
		<br/>
		<input type="checkbox" name="<?php echo $this->get_field_name('set_title'); ?>" value="true" <?php echo ($instance['set_title'])? 'checked': '' ; ?> >
		<label for="<?php echo $this->get_field_id('set_title'); ?>"> <?php _e( 'display title', 'biz-vektor' ); ?></label>
		</p>
		<?php
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['page_id'] = $new_instance['page_id'];
		$instance['set_title'] = ($new_instance['set_title'] == 'true')? true : false;
		return $instance;
	}

	function display_page($pageid,$titleflag=false) {
		$page = get_page($pageid);
		echo '<div id="widget-page-'.$pageid.'" class="sectionBox">';
		if($titleflag){ echo "<h2>".$page->post_title."</h2>"; }
		echo apply_filters('the_content', $page->post_content );
		if ( is_user_logged_in() == TRUE ) {
			global $user_level;
			get_currentuserinfo();
			if (10 <= $user_level) {
				?>
				<div class="adminEdit">
				<a href="<?php echo site_url(); ?>/wp-admin/post.php?post=<?php echo $pageid ;?>&action=edit" class="btn btnS btnAdmin"><?php _e('Edit', 'biz-vektor');?></a>
				</div>
			<?php } }
		echo '</div>';
	}
}
add_action('widgets_init', create_function('', 'return register_widget("wp_widget_page");'));