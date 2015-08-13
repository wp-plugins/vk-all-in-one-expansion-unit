<?php
/**
 * VkExUnit package_manager.php
 *
 * @package  VkExUnit
 * @author   shoji imamura<imamura@vektor-inc.co.jp>
 * @version  1.1.0
 * @since    6/Aug/2015
 */

vkExUnit_package_initilate();


function vkExUnit_package_initilate(){
    global $vkExUnit_packages;
    if(!is_array($vkExUnit_packages)) $vkExUnit_packages = array();
}


function vkExUnit_package_is_enable( $package_name ){
    global $vkExUnit_packages;
    if( !isset( $vkExUnit_packages[$package_name] ) ) return null;
    $options = vkExUnit_get_common_options();
    if( !isset($options['active_'.$package_name]) ) return $vkExUnit_packages[$package_name]['default'];
    return $options['active_'.$package_name];
}


function vkExUnit_package_register( $args ){
    $defaults = vkExUnit_package_default();
    $args = wp_parse_args( $args, $defaults );

    global $vkExUnit_packages;
    $vkExUnit_packages[$args['name']] = $args;
}


function vkExUnit_package_default(){
    return array(
            'name'  => null,
            'title' => 'noting',
            'description' => "noting",
            'attr' => array(),
            'default' => null,
        );
}


add_filter('vkExUnit_common_options_validate' , 'vkExUnit_common_package_options_validate', 10, 2);
function vkExUnit_common_package_options_validate( $output, $input ){
    global $vkExUnit_packages;
    if( !count($vkExUnit_packages) ) return $output;
    foreach($vkExUnit_packages as $package){
        if(
            isset($output['active_'.$package['name']]) &&
            $output['active_'.$package['name']] == (isset($input['active_'.$package['name']]) && $input['active_'.$package['name']]) ? true : false
        ) continue;
        $output['active_'.$package['name']] = (isset($input['active_'.$package['name']])) ? true : false;
    }
    return $output;
}