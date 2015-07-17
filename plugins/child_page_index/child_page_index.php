<?php
	
/*-------------------------------------------*/
/*	Child page index
/*-------------------------------------------*/
add_action('admin_menu', 'add_custom_field_childPageIndex' );
add_action('save_post', 'save_custom_field_postdata');
add_filter('the_content', 'show_childPageIndex', 7);
remove_filter('the_content','wpautop');

// add meta_box
function add_custom_field_childPageIndex() {
    add_meta_box('child_Page_index', __('Display a child page index', 'vkExUnit'), 'childPageIndex_box', 'page', 'normal', 'high');
}

// display a meta_box
function childPageIndex_box(){
	global $post;
	$childPageIndex_active = get_post_meta( $post->ID, 'vkExUnit_childPageIndex' );
	echo '<input type="hidden" name="_nonce_vkExUnit__custom_field_childPageIndex" id="_nonce_vkExUnit__custom_field_childPageIndex" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
	echo '<label class="hidden" for="vkExUnit_childPageIndex">'.__('Choose display a child page index', 'vkExUnit').'</label>
		<input type="checkbox" id="vkExUnit_childPageIndex" name="vkExUnit_childPageIndex" value="active"';	
	if( !empty($childPageIndex_active) ) {
		if( $childPageIndex_active[0] === 'active' ) echo ' checked="checked"';
	}
	echo '/>'.__('if checked you will display a child page index ', 'vkExUnit');
}

// save custom field
function save_custom_field_postdata( $post_id ) {
    $childPageIndex = isset($_POST['_nonce_vkExUnit__custom_field_childPageIndex']) ? htmlspecialchars($_POST['_nonce_vkExUnit__custom_field_childPageIndex']) : null;
    
	if( !wp_verify_nonce( $childPageIndex, plugin_basename(__FILE__) )){
  		return $post_id;
	}
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;
    
    $data = isset($_POST['vkExUnit_childPageIndex']) ? htmlspecialchars($_POST['vkExUnit_childPageIndex']) : null;
       
	if('page' == $data){
		if(!current_user_can('edit_page', $post_id)) return $post_id;
	}
		
    if ( "" == get_post_meta( $post_id, 'vkExUnit_childPageIndex' )) {
        add_post_meta( $post_id, 'vkExUnit_childPageIndex', $data, true ) ;
    } else if ( $data != get_post_meta( $post_id, 'vkExUnit_childPageIndex' )) {
        update_post_meta( $post_id, 'vkExUnit_childPageIndex', $data ) ;
    } else if ( "" == $data ) {
        delete_post_meta( $post_id, 'vkExUnit_childPageIndex' ) ;
    }
}

function show_childPageIndex($content) {
global $post;
$childPageIndex_value = get_post_meta( $post->ID, 'vkExUnit_childPageIndex' );
if(!empty($childPageIndex_value)){
// check the childPageIndex_value
	if( is_page() && $childPageIndex_value[0] == 'active'){ 
		
			$my_wp_query = new WP_Query();
			$all_wp_pages = $my_wp_query -> query(array('post_type' => 'page', 'posts_per_page' => -1, 'order' => 'ASC'));
			
			$childrens = get_page_children( $post->post_parent, $all_wp_pages );
			$parentId = $post->ID;

			$childPageList = PHP_EOL.'<div class="row childPage_list">'.PHP_EOL;
			if( $post->post_parent ){
			// child page
				foreach($childrens as $s){
			        $page = $s->ID;
			        $pageData = get_page($page);
			        $pageTitle = $pageData->post_title;
			        $pageContent = strip_tags($pageData->post_content);
			        if(!empty($pageExcerpt)){
					    $pageContent = $pageExcerpt;
				    }
			        $childPageList .= '<a href="'.esc_url(get_permalink($page)).'"><div class="childPage_list_box col-md-3"><h3 class="childPage_list_title">'.esc_html($pageTitle).'</h3><div class="childPage_list_body">'.get_the_post_thumbnail( $page, 'large' ).'<p class="childPage_list_text">'.mb_substr(esc_html($pageContent), 0, 50).'</p></div><span class="childPage_list_more btn btn-default btn-sm">'.__('Read more', 'vkExUnit').'</span></div></a>'.PHP_EOL;
			    }
		    } else { 		
			// parent page
				foreach($childrens as $s){
					if($s->post_parent === $parentId){
				        $page = $s->ID;
				        $pageData = get_page($page);
				        $pageTitle = $pageData->post_title;
				        $pageExcerpt = $pageData->post_excerpt;
				        $pageContent = strip_tags($pageData->post_content);
				        if(!empty($pageExcerpt)){
					        $pageContent = $pageExcerpt;
				        }
				        $childPageList .= '<a href="'.esc_url(get_permalink($page)).'"><div class="childPage_list_box col-md-3"><h3 class="childPage_list_title">'.esc_html($pageTitle).'</h3><div class="childPage_list_body">'.get_the_post_thumbnail( $page, 'large' ).'<p class="childPage_list_text">'.mb_substr(esc_html($pageContent), 0, 50).'</p></div><span class="childPage_list_more btn btn-default btn-sm">'.__('Read more', 'vkExUnit').'</span></div></a>'.PHP_EOL; 
					}
			    }	
			}
			
		$content = wpautop($content).$childPageList.'</div>'.PHP_EOL.'<!-- [ /.childPage_list ] -->'.PHP_EOL;
		return $content;
	} 
} 
return wpautop($content);
}

?>