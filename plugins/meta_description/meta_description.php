<?php
add_post_type_support( 'page', 'excerpt' );


function vkExUnit_description_options_init() {
	vkExUnit_register_setting(
		__('Meta Description', 'vkExUnit'), 	 // tab label.
		'vkExUnit_description_options',			 // name attr
		false,                                   // sanitaise function name
		'vkExUnit_add_description_options_page'  // setting_page function name
	);
}
add_action( 'admin_init', 'vkExUnit_description_options_init' );



function vkExUnit_add_description_options_page(){
?>
<h3><?php _e('Meta Description', 'vkExUnit'); ?></h3>
<div id="meta_description" class="sectionBox">
<table class="form-table">
<tr><th>ディスクリプション</th>
<td>

<?php _e('What you have to complete the "excerpt" column of the edit screen of each page will be reflected in the description of the meta tag.','vkExUnit') ?><br/>
<?php _e('Description of meta tags in the search results screen of search sites such as Google, will be Displayed, such as the bottom of the site title. If the excerpt column is blank, is 240 characters than text beginning of a sentence has become a specification that is applied as a description.','vkExUnit') ?><br/>
<?php _e('The meta description of the top page is subject to the catchphrase of the site. However, its contents will be reflected if the excerpt is entered in fixed page that was set on the top page.','vkExUnit') ?><br/>
* <?php _e('If "excerpt" column is not found, Click "Display Option" of page top at each article edit page, and check the expert column display.','vkExUnit') ?><br/>
</td></tr>
</table>
</div>
<?php
}


/*-------------------------------------------*/
/*	head_description
/*-------------------------------------------*/
add_filter( 'wp_head', 'vkExUnit_render_HeadDescription', 5 );
function vkExUnit_render_HeadDescription() {

	echo '<meta name="description" content="' . vkExUnit_get_pageDescription() . '" />';
}
