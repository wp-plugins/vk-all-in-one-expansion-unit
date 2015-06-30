<?php 

/*-------------------------------------------*/
/*	Side Profile widget
/*-------------------------------------------*/
class WP_Widget_vkExUnit_profile extends WP_Widget {
    
    function WP_Widget_vkExUnit_profile() {
		$widget_ops = array(
			'classname' => 'WP_Widget_vkExUnit_profile',
			'description' => __( "Displays a your site's profile", 'vkExUnit' ),
		);
		$widget_name = vkExUnit_get_short_name(). '_' . __( "Site's Profile", 'vkExUnit' );
		$this->WP_Widget('WP_Widget_vkExUnit_profile', $widget_name, $widget_ops);
	}
    
    function form($instance){
        $defaults = array(
			'label' => __("Site's Profile", 'vkExUnit' ),
            'mediafile' => '',
            'mediaalt' => '',
            'profile' => __("Site's Profile Text", 'vkExUnit' ),
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
        	
		<?php //タイトル ?>
		<p><label for="<?php echo $this->get_field_id('label');  ?>"><?php _e('Title:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('label'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('label'); ?>" value="<?php echo $instance['label']; ?>" />
		</p>
		
		<?php //メディアアップローダー ?>
        <p><label for="<?php echo $this->get_field_id('profile');  ?>"><?php _e('Select Profile image:'); ?></label><br/>
		
		<input type="hidden" class="media-url" id="<?php echo $this->get_field_id('mediafile'); ?>-title" name="<?php echo $this->get_field_name('mediafile'); ?>" value="<?php echo esc_attr($instance['mediafile']); ?>" />
		
		<input type="hidden" class="media-alt" id="<?php echo $this->get_field_id('mediaalt'); ?>-title" name="<?php echo $this->get_field_name('mediaalt'); ?>" value="<?php echo esc_attr($instance['mediaalt']); ?>" />
        
        <input type="button" class="media-select" value="画像を選択" onclick="clickSelect();" />
        <input type="button" class="media-clear" value="画像をクリア" onclick="clickClear();" />
        </p>
        
        <div class="media">
	        <?php if(!empty($instance['mediafile'])): ?>
	        <img class="media-image" src="<?php echo esc_url($instance['mediafile']); ?>" alt="<?php echo esc_attr($instance['mediaalt']); ?>" />
	        <?php endif; ?>
        </div>
		
		<?php //profileテキスト ?>
		<p><label for="<?php echo $this->get_field_id('profile');  ?>"><?php _e('Profile Text:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('profile'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('profile'); ?>" value="<?php echo $instance['profile']; ?>" />
		</p>
		
		<?php //facebook_URL ?>
		<p><label for="<?php echo $this->get_field_id('facebook');  ?>"><?php _e('Facebook URL:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('facebook'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>
		
		<?php //twitter_URL ?>
		<p><label for="<?php echo $this->get_field_id('twitter');  ?>"><?php _e('Twitter URL:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('twitter'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>
		
		<?php //mail_URL ?>
		<p><label for="<?php echo $this->get_field_id('mail');  ?>"><?php _e('Email Address:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('mail'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('mail'); ?>" value="<?php echo $instance['mail']; ?>" />
		</p>
		
		<?php //youtube_URL ?>
		<p><label for="<?php echo $this->get_field_id('youtube');  ?>"><?php _e('Youtube URL:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('youtube'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $instance['youtube']; ?>" />
		</p>
		
		<?php //rss_URL ?>
		<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS URL:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('rss'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $instance['rss']; ?>" />
		</p>
		
		<?php //instagram_URL ?>
		<p><label for="<?php echo $this->get_field_id('instagram');  ?>"><?php _e('instagram URL:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('instagram'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instance['instagram']; ?>" /></p>
		
		<?php //linkedin_URL ?>
		<p><label for="<?php echo $this->get_field_id('linkedin');  ?>"><?php _e('linkedin URL:'); ?></label><br/>
		<input type="text" id="<?php echo $this->get_field_id('linkedin'); ?>-title" class="prof-input" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $instance['linkedin']; ?>" /></p>
   
    <?php  }
    
    function update ($new_instance, $old_instance) {
        
        $instance = $old_instance;
        $instance['label'] = $new_instance['label'];
        $instance['mediafile'] = $new_instance['mediafile'];
        $instance['mediaalt'] = $new_instance['mediaalt'];
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
		// ここからサイドバーに表示される部分
        echo '<aside class="widget">';
		echo '<h1 class="widget-title subSection-title">';
		if ( isset($instance['label']) && $instance['label'] ) {
			echo $instance['label'];
		} else {
			_e("Site's Profile", 'vkExUnit' );
		}
		echo '</h1>'; ?>
		
		<div class="site-profile">
			<?php 
			// プロフィール画像表示
			if( !empty($instance['mediafile']) ){
                echo '<img class="profile-media" src="'.esc_url($instance['mediafile']).'" alt="'.esc_attr($instance['mediaalt']).'" />';
            } 
			 
            // プロフィールテキスト表示
            if( !empty($instance['profile']) ){
                echo '<p class="profile-text">'.esc_attr($instance['profile']).'</p>';
            } 
        
            // sns リンクボタン表示する
            if( isset($instance['facebook'], $instance['twitter'], $instance['mail'], $instance['youtube'], $instance['rss'], $instance['instagram'], $instance['linkedin'] ) ): ?>
            <ul class="sns-btns">
		        
		        <?php // facebook ボタン表示
                if( !empty($instance['facebook']) ): ?>
				<li class="facebook-btn">
                    <a href="<?php echo esc_url($instance['facebook']); ?>" target="_blank">
                    <i class="fa fa-facebook"></i>
                    </a>
				</li>
				<?php endif; ?>
				
				<?php // twitter ボタン表示
                if( !empty($instance['twitter']) ): ?>
				<li class="twitter-btn">
                    <a href="<?php echo esc_url($instance['twitter']); ?>" target="_blank">
                    <i class="fa fa-twitter"></i>
                    </a>
				</li>
				<?php endif; ?>
				
				<?php // mail ボタン表示
                if( !empty($instance['mail']) ): ?>
				<li class="mail-btn">
                    <a href="<?php echo esc_url($instance['mail']); ?>" target="_blank">
                    <i class="fa fa-envelope-o"></i>
                    </a>
				</li>
				<?php endif; ?>
				
				<?php // youtube ボタン表示
                if( !empty($instance['youtube']) ): ?>
				<li class="youtube-btn">
                    <a href="<?php echo esc_url($instance['youtube']); ?>" target="_blank">
                    <i class="fa fa-youtube"></i>
                    </a>
				</li>
				<?php endif; ?>
				
				<?php // RSS ボタン表示
                if( !empty($instance['rss']) ): ?>
				<li class="rss-btn">
                    <a href="<?php echo esc_url($instance['rss']); ?>" target="_blank">
                    <i class="fa fa-rss"></i>
                    </a>
				</li>
				<?php endif; ?>
				
				<?php // instagram ボタン表示
                if( !empty($instance['instagram']) ): ?>
				<li class="instagram-btn">
                    <a href="<?php echo esc_url($instance['instagram']); ?>" target="_blank">
                    <i class="fa fa-instagram"></i>
                    </a>
				</li>
				<?php endif; ?>
				
				<?php // linkedin ボタン表示
                if( !empty($instance['linkedin']) ): ?>
				<li class="linkedin-btn">
                    <a href="<?php echo esc_url($instance['linkedin']); ?>" target="_blank">
                    <i class="fa fa-linkedin"></i>
                    </a>
				</li>
				<?php endif; ?>
            
            </ul> 
            <?php endif; ?> 
		</div>
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
	.prof-input{
		width: 100%;
	}
    .media-select,.media-clear{
	    padding: 3px;
	    border: none;
	    border-radius: 3px;
	    background: #00a0d2;
	    color: #fff;
	    font-size: 12px;
	    cursor: pointer;
	    outline: none;
    }
    .media-select:hover,.media-clear:hover{
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
	.media-image{
		position: relative;
		z-index: 3;
		display: block;
		width: 100%;
		height: auto;
	}	
</style>'.PHP_EOL;
}
add_action("admin_print_styles-widgets.php", "my_admin_style");