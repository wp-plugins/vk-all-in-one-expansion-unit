<?php 

/*-------------------------------------------*/
/*	Side Profile widget
/*-------------------------------------------*/
class WP_Widget_vkExUnit_profile extends WP_Widget {
    
    function WP_Widget_vkExUnit_profile() {
		$widget_ops = array(
			'classname' => 'WP_Widget_vkExUnit_profile',
			'description' => __( "Displays a your profile", 'vkExUnit' ),
		);
		$widget_name = vkExUnit_get_short_name(). '_' . __( "Profile", 'vkExUnit' );
		$this->WP_Widget('WP_Widget_vkExUnit_profile', $widget_name, $widget_ops);
	}
    
    function form($instance){
        $defaults = array(
			'label' => __('Profile', 'vkExUnit' ),
            'mediaFile' => '',
            'mediaAlt' => '',
            'profile' => __('Profile Text', 'vkExUnit' ),
            'facebook' => '',
            'twitter' => '',
            'mail' => '',
            'youtube' => '',
            'rss' => '',
            'instagram' => '',
            'linkedin' => ''
		);
        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
        	
		<?php //title ?>
		<p><label for="<?php echo $this->get_field_id('label');  ?>"><?php _e('Title:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('label'); ?>_title" class="prof_input" name="<?php echo $this->get_field_name('label'); ?>" value="<?php echo $instance['label']; ?>" />
		</p>
		
		<?php //media uploader ?>
        <p><label for="<?php echo $this->get_field_id('profile');  ?>"><?php _e('Select Profile image:', 'vkExUnit'); ?></label><br/>
		
		<input type="hidden" class="media_url" id="<?php echo $this->get_field_id('mediaFile'); ?>_media" name="<?php echo $this->get_field_name('mediaFile'); ?>" value="<?php echo esc_attr($instance['mediaFile']); ?>" />
		
		<input type="hidden" class="media_alt" id="<?php echo $this->get_field_id('mediaAlt'); ?>_media" name="<?php echo $this->get_field_name('mediaAlt'); ?>" value="<?php echo esc_attr($instance['mediaAlt']); ?>" />
        
        <input type="button" class="media_select" value="<?php _e('Select image', 'vkExUnit'); ?>" onclick="clickSelect(event.target);" />
        <input type="button" class="media_clear" value="<?php _e('Clear image', 'vkExUnit'); ?>" onclick="clickClear(event.target);" />
        </p>
        
        <div class="media">
	        <?php if(!empty($instance['mediaFile'])): ?>
	        <img class="media_image" src="<?php echo esc_url($instance['mediaFile']); ?>" alt="<?php echo esc_attr($instance['mediaAlt']); ?>" />
	        <?php endif; ?>
        </div>
		
		<?php //profile text ?>
		<p><label for="<?php echo $this->get_field_id('profile');  ?>"><?php _e('Profile Text:', 'vkExUnit'); ?></label></p>
		
		<textarea rows="4" cols="40" id="<?php echo $this->get_field_id('profile'); ?>_text" class="prof_input textarea" name="<?php echo $this->get_field_name('profile'); ?>"><?php echo $instance['profile']; ?></textarea>
		
		<?php //facebook_URL ?>
		<p><label for="<?php echo $this->get_field_id('facebook');  ?>"><?php _e('Facebook URL:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('facebook'); ?>_url" class="prof_input" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>
		
		<?php //twitter_URL ?>
		<p><label for="<?php echo $this->get_field_id('twitter');  ?>"><?php _e('Twitter URL:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('twitter'); ?>_url" class="prof_input" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>
		
		<?php //mail_URL ?>
		<p><label for="<?php echo $this->get_field_id('mail');  ?>"><?php _e('Email Address:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('mail'); ?>_url" class="prof_input" name="<?php echo $this->get_field_name('mail'); ?>" value="<?php echo $instance['mail']; ?>" />
		</p>
		
		<?php //youtube_URL ?>
		<p><label for="<?php echo $this->get_field_id('youtube');  ?>"><?php _e('Youtube URL:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('youtube'); ?>_url" class="prof_input" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $instance['youtube']; ?>" />
		</p>
		
		<?php //rss_URL ?>
		<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS URL:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('rss'); ?>_url" class="prof_input" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $instance['rss']; ?>" />
		</p>
		
		<?php //instagram_URL ?>
		<p><label for="<?php echo $this->get_field_id('instagram');  ?>"><?php _e('instagram URL:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('instagram'); ?>_url" class="prof_input" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instance['instagram']; ?>" /></p>
		
		<?php //linkedin_URL ?>
		<p><label for="<?php echo $this->get_field_id('linkedin');  ?>"><?php _e('linkedin URL:', 'vkExUnit'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('linkedin'); ?>_url" class="prof_input" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $instance['linkedin']; ?>" /></p>
   
    <?php  }
    
    function update ($new_instance, $old_instance) {
        
        $instance = $old_instance;
        $instance['label'] = $new_instance['label'];
        $instance['mediaFile'] = $new_instance['mediaFile'];
        $instance['mediaAlt'] = $new_instance['mediaAlt'];
        $instance['profile'] = $new_instance['profile'];
        $instance['facebook'] = $new_instance['facebook'];
        $instance['twitter'] = $new_instance['twitter'];
        $instance['mail'] = $new_instance['mail'];
        $instance['youtube'] = $new_instance['youtube'];
        $instance['rss'] = $new_instance['rss'];
        $instance['instagram'] = $new_instance['instagram'];
        $instance['linkedin'] = $new_instance['linkedin'];
        return $instance;
        
    } 
    
    function widget($args, $instance) {
		// From here Display a widget
        echo PHP_EOL.'<aside class="widget">'.PHP_EOL;
		echo '<h1 class="widget-title subSection-title">';
		if ( isset($instance['label']) && $instance['label'] ) {
			echo $instance['label'];
		} else {
			_e("Site's Profile", 'vkExUnit' );
		}
		echo '</h1>'; ?>
		
<div class="site-profile">
<?php // Display a profile image 
		if( !empty($instance['mediaFile']) ){
        	echo '<img class="profile_media" src="'.esc_url($instance['mediaFile']).'" alt="'.esc_attr($instance['mediaAlt']).'" />'.PHP_EOL;
        } 
        // Display a profile text
        if( !empty($instance['profile']) ){
            echo '<p class="profile_text">'.nl2br(esc_attr($instance['profile'])).'</p>'.PHP_EOL;
        } 
        
        // Display a sns botton
        if( isset($instance['facebook']) && $instance['facebook'] || isset($instance['twitter']) && $instance['twitter'] || isset($instance['mail']) && $instance['mail'] || isset($instance['youtube']) && $instance['youtube'] || isset($instance['rss']) && $instance['rss'] || isset($instance['instagram']) && $instance['instagram'] || isset($instance['linkedin']) && $instance['linkedin'] ): ?>
        
<ul class="sns_btns">
<?php // Display a facebook botton
    if( !empty($instance['facebook']) ): ?>
        <li class="facebook_btn"><a href="<?php echo esc_url($instance['facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
<?php endif; ?>
<?php // Display a twitter botton
	if( !empty($instance['twitter']) ): ?>
        <li class="twitter_btn"><a href="<?php echo esc_url($instance['twitter']); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
<?php endif; ?>
<?php // Display a mail botton
    if( !empty($instance['mail']) ): ?>
        <li class="mail_btn"><a href="<?php echo esc_url($instance['mail']); ?>" target="_blank"><i class="fa fa-envelope"></i></a></li>
<?php endif; ?>
<?php // Display a youtube botton
    if( !empty($instance['youtube']) ): ?>
        <li class="youtube_btn"><a href="<?php echo esc_url($instance['youtube']); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
<?php endif; ?>
<?php // Display a RSS botton
    if( !empty($instance['rss']) ): ?>
        <li class="rss_btn"><a href="<?php echo esc_url($instance['rss']); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
<?php endif; ?>
<?php // Display a instagram botton
    if( !empty($instance['instagram']) ): ?>
        <li class="instagram_btn"><a href="<?php echo esc_url($instance['instagram']); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
<?php endif; ?>
<?php // Display a linkedin botton
    if( !empty($instance['linkedin']) ): ?>
        <li class="linkedin_btn"><a href="<?php echo esc_url($instance['linkedin']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
<?php endif; ?>
</ul>
<?php endif; ?>

</div>
<!-- / .site-profile -->		
</aside>
<?php }
} 
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_vkExUnit_profile");'));

// Profile widget uploader js
function my_admin_scripts() {	
    wp_enqueue_media();
    wp_register_script( 'mediauploader', plugin_dir_url( __FILE__ ) . 'js/widget-prof-uploader.js', array( 'jquery' ), false, true);
    wp_enqueue_script( 'mediauploader' );
}
add_action( 'admin_print_scripts', 'my_admin_scripts' );

// Profile widget CSS
function my_admin_style() {
echo '<style>
	.prof_input{
		width: 100%;
	}
    .media_select,.media_clear{
	    padding: 3px;
	    border: none;
	    border-radius: 3px;
	    background: #00a0d2;
	    color: #fff;
	    font-size: 12px;
	    cursor: pointer;
	    outline: none;
    }
    .media_select:hover,.media_clear:hover{
	    background: #0073aa;
    }
    .media{
		position: relative;
		z-index: 2;
		overflow: hidden;
		margin: 3px 0;
		min-height: 70px;
		max-height: 200px;
		width: 100%;
		border: 1px dashed #ccc;
		border-radius: 5px;
		background-color: rgba(212, 212, 212, 0.1);
	}
	.media:before{
		position: absolute;
		top: 50%;
		left: 50%;
		z-index: 1;
		margin: -8px 0 0 -30px;
		color: #999;
		content: "No Image";
	}
	.media_image{
		position: relative;
		z-index: 3;
		display: block;
		width: 100%;
		height: auto;
	}	
	.prof_input.textarea{
		margin-top: -1em;
	}
</style>'.PHP_EOL;
}
add_action("admin_print_styles-widgets.php", "my_admin_style");
