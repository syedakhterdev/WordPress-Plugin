<?php
/**
 * Plugin Name: Custom menu for resturant
 * Plugin URI: https://www.syed.work
 * Description: Custom menu for resturant
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Syed Akhtar
 * Author URI: https://www.syed.work
 * @author Syed Akhtar
 * @version 3.09
 * @package
 *
 * Change History:
 */
define('CUSTOM_TAGESMENUE_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

function add_events_metaboxes() {
	add_meta_box('wpt_events_location', 'Event Location', 'wpt_events_location', 'events', 'side', 'default');
}
function wpt_events_location() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, '_location', true);
	
	// Echo out the field
	echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';

}

	function tgmenu_tax1() {
 $labels = array(
  'name'               => _x( 'Tagesmenü', 'post type general name' ),
  'singular_name'      => _x( 'Tagesmenü', 'post type singular name' ),
  'add_new'            => _x( 'Tagesmenü anlegen', 'Tagesmenü' ),
  'add_new_item'       => __( 'Neues Tagemenü erstellen' ),
  'edit_item'          => __( 'Menü bearbeiten' ),
  'new_item'           => __( 'Neues Tagemenü erstellen' ),
  'all_items'          => __( 'Alle Tagesmenüs' ),
  'view_item'          => __( 'Menü einsehen' ),
  'search_items'       => __( 'Menü suchen' ),
  'not_found'          => __( 'Tagesmenü gefunden' ),
  'not_found_in_trash' => __( 'Kein Tagesmenü im Papierkorb' ), 
  'parent_item_colon'  => '',
  'menu_name'          => 'Tagesmenü'
 );
 $args = array(
  'labels'        => $labels,
  'description'   => 'Tagesmenü',
  'public'        => true,
  'menu_position' => 6,
  'supports'      => array( 'title'),  
  'has_archive'   => true,
  'menu_icon' => CUSTOM_TAGESMENUE_PLUGIN_PATH.'/img/tagesmenue.png',
 );
 register_post_type( 'tgmenu', $args ); 
}
add_action( 'init', 'tgmenu_tax1' );

//Dishes CPT

function tgmenu_tax2() {
 $labels = array(
		'name'              => _x( 'Gerichte', 'taxonomy general name' ),
		'singular_name'     => _x( 'Gericht', 'taxonomy singular name' ),
		'search_items'      => __( 'Gericht suchen' ),
		'all_items'         => __( 'Alle Gerichte' ),
		'parent_item'       => __( 'Eltern Gericht' ),
		'parent_item_colon' => __( 'Eltern Gericht:' ),
		'edit_item'         => __( 'Gericht bearbeiten' ),
		'update_item'       => __( 'Update Gericht' ),
		'add_new_item'      => __( 'Neues Gericht' ),
		'new_item_name'     => __( 'Neuer Name Gericht' ),
		'menu_name'         => __( 'Gericht hinzufügen' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'dish' ),
	);
 
 //register_post_type( 'dishes', $args ); 
 register_taxonomy( 'dish', 'tgmenu', $args );
}
add_action( 'init', 'tgmenu_tax2' );



add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );
function myplugin_add_custom_box() {
    $screens = array( 'tgmenu' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'myplugin_box_id',            // Unique ID
            'Erster Gang',      // Box title
            'myplugin_inner_custom_box',  // Content callback
             $screen                      // post type
        );
    }
}



add_action( 'add_meta_boxes', 'myplugin_add_custom_box2' );
function myplugin_add_custom_box2() {
    $screens = array( 'tgmenu' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'myplugin_box_id2',            // Unique ID
            'Zweiter Gang',      // Box title
            'myplugin_inner_custom_box2',  // Content callback
             $screen                      // post type
        );
    }
}

add_action( 'add_meta_boxes', 'myplugin_add_custom_box3' );
function myplugin_add_custom_box3() {
    $screens = array( 'dishes' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'myplugin_box_id3',            // Unique ID
            'Dish price',      // Box title
            'myplugin_inner_custom_box3',  // Content callback
             $screen                      // post type
        );
    }
}



function myplugin_inner_custom_box( $post ) {
	//print_r(get_post_meta( $post->ID));
	$below_2 = get_post_meta( $post->ID, '_below', true );
	$value = get_post_meta( $post->ID, '_title_1_1', true );
	$value1 = get_post_meta( $post->ID, '_desc_1_1', true );
	$value2 = get_post_meta( $post->ID, '_price_1_1', true );
	$value2_1 = get_post_meta( $post->ID, '_title_1_2', true );	
	$value2_2 = get_post_meta( $post->ID, '_price_1_2', true );
	$value2_3 = get_post_meta( $post->ID, '_desc_1_2', true );
	$value3_1 = get_post_meta( $post->ID, '_title_1_3', true );	
	$value3_2 = get_post_meta( $post->ID, '_price_1_3', true );
	$value3_3 = get_post_meta( $post->ID, '_desc_1_3', true );
	$value4_1 = get_post_meta( $post->ID, '_title_1_4', true );	
	$value4_2 = get_post_meta( $post->ID, '_price_1_4', true );
	$value4_3 = get_post_meta( $post->ID, '_desc_1_4', true );
	$value5_1 = get_post_meta( $post->ID, '_title_1_5', true );	
	$value5_2 = get_post_meta( $post->ID, '_price_1_5', true );
	$value5_3 = get_post_meta( $post->ID, '_desc_1_5', true );
	$value6_1 = get_post_meta( $post->ID, '_title_1_6', true );	
	$value6_2 = get_post_meta( $post->ID, '_price_1_6', true );
	$value6_3 = get_post_meta( $post->ID, '_desc_1_6', true );
	$value7_1 = get_post_meta( $post->ID, '_title_1_7', true );	
	$value7_2 = get_post_meta( $post->ID, '_price_1_7', true );
	$value7_3 = get_post_meta( $post->ID, '_desc_1_7', true );
	
	$value8_1 = get_post_meta( $post->ID, '_title_1_8', true );	
	$value8_2 = get_post_meta( $post->ID, '_price_1_8', true );
	$value8_3 = get_post_meta( $post->ID, '_desc_1_8', true );
	
	$value9_1 = get_post_meta( $post->ID, '_title_1_9', true );	
	$value9_2 = get_post_meta( $post->ID, '_price_1_9', true );
	$value9_3 = get_post_meta( $post->ID, '_desc_1_9', true );
	
	$value10_1 = get_post_meta( $post->ID, '_title_1_10', true );	
	$value10_2 = get_post_meta( $post->ID, '_price_1_10', true );
	$value10_3 = get_post_meta( $post->ID, '_desc_1_10', true );
	
	
?>
<style type="text/css">
#wp-content-id-desc-wrap {
	height: 40px;
}
.main-tile {
	height: 40px;
}
#collection_data input[type=text], select {
	height: 40px;
	width: 32%;
}
.main-tile {
	width: 100%;
	font-weight: bold;
}
.main-heading-field {
	height: 40px;
	width: 96.5%;
}
.wp-admin select {
	margin-top: -4px;
	line-height: 28px;
	height: 41px;
}
</style>
<div class="main-tile">
  <label for="myplugin_field">Überschrift</label>
</div>
<input type="text" name="below" value="<?php echo $below_2; ?>" class="main-heading-field" placeholder="Überschrift" />
<br />
<br />
<div id="collection_data">
  <?php 
  $taxonomies = array('dish');
 //Set arguments - don't 'hide' empty terms.
 $args = array(
     'hide_empty' => 0
 );


  	//$args_menu_dishes = array ('post_type' =>'dishes','order'=>'DESC', 'paged' => $paged, 'posts_per_page' =>-1 );
   	$all_menu_items_dishes = get_terms( $taxonomies, $args);
	//print_r($all_menu_items_dishes);
	?>
  <script type="text/javascript">

    jQuery(document).ready(function() {  
            jQuery('.getprice').change(function() {
			//var serializedData = jQuery('.getprice');
			var serializedData= jQuery( this ).val();
			
			var a = this.id;
			var	get_id = a.replace('title','');
			
			jQuery.ajax({
		   		type:	'POST',
				data:	'name='+serializedData,
				url: 	'<?php echo CUSTOM_TAGESMENUE_PLUGIN_PATH.'ajax/ajax_file.php'; ?>',
				success:function(data)
				{
					//alert(data);
					var response = eval('('+data+')');
					//alert(data);
					//jQuery('.price'+get_id).val("");
					//jQuery('.price'+get_id).val(response.price);
					jQuery('.desc'+get_id).val("");
					jQuery('.desc'+get_id).val(response.cont.replace('&quot;','"').replace('&quot;','"').replace('&ouml;','ö').replace('&auml;','ä').replace('&uuml;','ü').replace('&Ouml;','Ö').replace('&Auml;','Ä').replace('&Uuml;','Ü'));
				}
			
			});
    
		

    // Callback handler that will be called on success
    

    // Callback handler that will be called on failure
    

			});
			});
    </script>
  <div class="main-tile">
    <label for="myplugin_field">Gericht 1</label>
  </div>
  <select name="title_1_1" class="getprice" id="title_1_1">
    <option value="">Gericht auswählen</option>
    <?php
	//print_r($all_menu_items_dishes);
  foreach($all_menu_items_dishes  as $dishes){
	  ?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_1" class="desc_1_1" value="<?php echo $value1; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_1" class="price_1_1" value="<?php echo $value2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 2</label>
  </div>
  <select name="title_1_2" class="getprice" id="title_1_2">
    <option value="">Gericht auswählen</option>
    <?php
  foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_2" class="desc_1_2" value="<?php echo $value2_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_2" class="price_1_2" value="<?php echo $value2_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 3</label>
  </div>
  <select name="title_1_3" class="getprice" id="title_1_3">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value3_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_3" class="desc_1_3" value="<?php echo $value3_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_3" class="price_1_3" value="<?php echo $value3_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 4</label>
  </div>
  <select name="title_1_4" class="getprice" id="title_1_4">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value4_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_4" class="desc_1_4" value="<?php echo $value4_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_4" class="price_1_4" value="<?php echo $value4_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 5</label>
  </div>
  <select name="title_1_5" class="getprice" id="title_1_5">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value5_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_5" class="desc_1_5" value="<?php echo $value5_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_5" value="<?php echo $value5_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 6</label>
  </div>
  <select name="title_1_6" class="getprice" id="title_1_6">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value6_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_6" class="desc_1_6" value="<?php echo $value6_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_6" value="<?php echo $value6_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 7</label>
  </div>
  <select name="title_1_7" class="getprice" id="title_1_7">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value7_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_7" class="desc_1_7" value="<?php echo $value7_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_7" value="<?php echo $value7_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 8</label>
  </div>
  <select name="title_1_8" class="getprice" id="title_1_8">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value8_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_8" class="desc_1_8" value="<?php echo $value8_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_8" value="<?php echo $value8_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 9</label>
  </div>
  <select name="title_1_9" class="getprice" id="title_1_9">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value9_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_9" class="desc_1_9" value="<?php echo $value9_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_9" value="<?php echo $value9_2; ?>" placeholder="Preis" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 10</label>
  </div>
  <select name="title_1_10" class="getprice" id="title_1_10">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value10_1) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_1_10" class="desc_1_10" value="<?php echo $value10_3; ?>" placeholder="Beschreibung" />
  <input type="text" name="price_1_10" value="<?php echo $value10_2; ?>" placeholder="Preis" />
  <br />
  <br />
</div>
<?php
	
}

function myplugin_inner_custom_box2( $post ) {
	//Second_section
	$below_22 = get_post_meta( $post->ID, '_below_2', true );
	$value2_1_2 = get_post_meta( $post->ID, '_title_2_1_2', true );
	$value2_1_3 = get_post_meta( $post->ID, '_desc_2_1_3', true );
	$value2_1_4 = get_post_meta( $post->ID, '_price_2_1_4', true );
	$value2_1_5 = get_post_meta( $post->ID, '_title_2_1_5', true );	
	$value2_1_6 = get_post_meta( $post->ID, '_price_2_1_6', true );
	$value2_1_7 = get_post_meta( $post->ID, '_desc_2_1_7', true );
	$value2_1_8 = get_post_meta( $post->ID, '_title_2_1_8', true );	
	$value2_1_9 = get_post_meta( $post->ID, '_price_2_1_9', true );
	$value2_1_10 = get_post_meta( $post->ID, '_desc_2_1_10', true );
	$value2_1_11 = get_post_meta( $post->ID, '_title_2_1_11', true );	
	$value2_1_12 = get_post_meta( $post->ID, '_price_2_1_12', true );
	$value2_1_13 = get_post_meta( $post->ID, '_desc_2_1_13', true );
	$value2_1_14 = get_post_meta( $post->ID, '_title_2_1_14', true );	
	$value2_1_15 = get_post_meta( $post->ID, '_price_2_1_15', true );
	$value2_1_16 = get_post_meta( $post->ID, '_desc_2_1_16', true );
	$value2_1_17 = get_post_meta( $post->ID, '_title_2_1_17', true );	
	$value2_1_18 = get_post_meta( $post->ID, '_price_2_1_18', true );
	$value2_1_19 = get_post_meta( $post->ID, '_desc_2_1_19', true );
	$value2_1_20 = get_post_meta( $post->ID, '_title_2_1_20', true );	
	$value2_1_21 = get_post_meta( $post->ID, '_price_2_1_21', true );
	$value2_1_22 = get_post_meta( $post->ID, '_desc_2_1_22', true );
	$value2_1_23 = get_post_meta( $post->ID, '_title_2_1_23', true );	
	$value2_1_24 = get_post_meta( $post->ID, '_price_2_1_24', true );
	$value2_1_25 = get_post_meta( $post->ID, '_desc_2_1_25', true );
	
	$value2_1_26 = get_post_meta( $post->ID, '_title_2_1_26', true );	
	$value2_1_27 = get_post_meta( $post->ID, '_price_2_1_27', true );
	$value2_1_28 = get_post_meta( $post->ID, '_desc_2_1_28', true );
	
	$value2_1_29 = get_post_meta( $post->ID, '_title_2_1_29', true );	
	$value2_1_30 = get_post_meta( $post->ID, '_price_2_1_30', true );
	$value2_1_31 = get_post_meta( $post->ID, '_desc_2_1_31', true );
?>
<?php
$taxonomies = array('dish');
 //Set arguments - don't 'hide' empty terms.
 $args = array(
     'hide_empty' => 0
 );


  	//$args_menu_dishes = array ('post_type' =>'dishes','order'=>'DESC', 'paged' => $paged, 'posts_per_page' =>-1 );
   	$all_menu_items_dishes = get_terms( $taxonomies, $args);
?>
<!-----Second Section---->
<div class="main-tile">
  <label for="myplugin_field"> Überschrift </label>
</div>
<input type="text" name="below_2" value="<?php echo $below_22; ?>" class="main-heading-field" placeholder="Überschrift" />
<br />
<br />
<div id="collection_data">
  <div class="main-tile">
    <label for="myplugin_field">Gericht 1</label>
  </div>
  <select name="title_2_1_2" class="getprice" id="title_2_1_2">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_2) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_4" class="desc_2_1_2" value="<?php echo $value2_1_3; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_3" value="<?php echo $value2_1_4; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 2</label>
  </div>
  <select name="title_2_1_5" class="getprice" id="title_2_1_5">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_5) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_7" class="desc_2_1_5" value="<?php echo $value2_1_7; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_6" value="<?php echo $value2_1_6; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 3</label>
  </div>
  <select name="title_2_1_8" class="getprice" id="title_2_1_8">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_8) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_10" class="desc_2_1_8" value="<?php echo $value2_1_10; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_9" value="<?php echo $value2_1_9; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 4</label>
  </div>
  <select name="title_2_1_11" class="getprice" id="title_2_1_11">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_11) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" name="desc_2_1_13" class="desc_2_1_11" value="<?php echo $value2_1_13; ?>" placeholder="Beschreibung"/>
  <input type="text" name="price_2_1_12" value="<?php echo $value2_1_12; ?>" placeholder="Preis"/>
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 5</label>
  </div>
  <select name="title_2_1_14" class="getprice" id="title_2_1_14">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_14) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_16" class="desc_2_1_14" value="<?php echo $value2_1_16; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_15" value="<?php echo $value2_1_15; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 6</label>
  </div>
  <select name="title_2_1_17" class="getprice" id="title_2_1_17">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_17) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_19" class="desc_2_1_17" value="<?php echo $value2_1_19; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_18" value="<?php echo $value2_1_18; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 7</label>
  </div>
  <select name="title_2_1_20" class="getprice" id="title_2_1_20">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_20) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_22" class="desc_2_1_20" value="<?php echo $value2_1_22; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_21" value="<?php echo $value2_1_21; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 8</label>
  </div>
  <select name="title_2_1_23" class="getprice" id="title_2_1_23">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_23) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_25" class="desc_2_1_23" value="<?php echo $value2_1_25; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_24" value="<?php echo $value2_1_24; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 9</label>
  </div>
  <select name="title_2_1_26" class="getprice" id="title_2_1_26">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_26) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_28" class="desc_2_1_26" value="<?php echo $value2_1_28; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_27" value="<?php echo $value2_1_27; ?>" />
  <br />
  <br />
  <div class="main-tile">
    <label for="myplugin_field">Gericht 10</label>
  </div>
  <select name="title_2_1_29" class="getprice" id="title_2_1_29">
    <option value="">Gericht auswählen</option>
    <?php
 foreach($all_menu_items_dishes  as $dishes){?>
    <option value="<?php echo $dishes->term_id; ?>" <?php if($dishes->term_id==$value2_1_29) echo "selected=selected"; ?> ><?php echo $dishes->name; ?></option>
    <?php } ?>
  </select>
  <input type="text" placeholder="Beschreibung" name="desc_2_1_31" class="desc_2_1_29" value="<?php echo $value2_1_31; ?>" />
  <input type="text" placeholder="Preis" name="price_2_1_30" value="<?php echo $value2_1_30; ?>" />
  <br />
  <br />
</div>
<?php
	
}

function myplugin_inner_custom_box3( $post ) {
	//print_r(get_post_meta( $post->ID));
	$price_dish = get_post_meta( $post->ID, '_price_dish', true );
	
	
	
?>
<div class="main-tile">
<div id="collection_data">
  <div class="main-tile">
    <label for="myplugin_field">Price</label>
  </div>
  <input type="text" name="price_dish" value="<?php echo $price_dish; ?>" placeholder="Preis" />
  <br />
  <br />
</div>
<?php
	
}
add_action( 'save_post', 'myplugin_save_postdata' );
function myplugin_save_postdata( $post_id ) {
	
    if ( array_key_exists('below', $_POST ) ) {
         update_post_meta( $post_id,
           '_below',
            htmlentities($_POST['below'])
        );
		
		update_post_meta( $post_id,
           '_title_1_1',
            htmlentities($_POST['title_1_1'])
        );
		 update_post_meta( $post_id,
           '_desc_1_1',
            htmlentities($_POST['desc_1_1'])
        );
		 update_post_meta( $post_id,
           '_price_1_1',
            htmlentities($_POST['price_1_1'])
        );
		
		update_post_meta( $post_id,
           '_title_1_2',
            htmlentities($_POST['title_1_2'])
        );
		 update_post_meta( $post_id,
           '_desc_1_2',
            htmlentities($_POST['desc_1_2'])
        );
		 update_post_meta( $post_id,
           '_price_1_2',
            htmlentities($_POST['price_1_2'])
        );
		
		update_post_meta( $post_id,
           '_title_1_3',
            htmlentities($_POST['title_1_3'])
        );
		 update_post_meta( $post_id,
           '_desc_1_3',
            htmlentities($_POST['desc_1_3'])
        );
		 update_post_meta( $post_id,
           '_price_1_3',
            htmlentities($_POST['price_1_3'])
        );
		
		
		update_post_meta( $post_id,
           '_title_1_4',
            htmlentities($_POST['title_1_4'])
        );
		 update_post_meta( $post_id,
           '_desc_1_4',
            htmlentities($_POST['desc_1_4'])
        );
		 update_post_meta( $post_id,
           '_price_1_4',
            htmlentities($_POST['price_1_4'])
        );
		 
		
		
		update_post_meta( $post_id,
           '_title_1_5',
            htmlentities($_POST['title_1_5'])
        );
		 update_post_meta( $post_id,
           '_desc_1_5',
            htmlentities($_POST['desc_1_5'])
        );
		 update_post_meta( $post_id,
           '_price_1_5',
            htmlentities($_POST['price_1_5'])
        );
		
		
		update_post_meta( $post_id,
           '_title_1_6',
            htmlentities($_POST['title_1_6'])
        );
		 update_post_meta( $post_id,
           '_desc_1_6',
            htmlentities($_POST['desc_1_6'])
        );
		 update_post_meta( $post_id,
           '_price_1_6',
            htmlentities($_POST['price_1_6'])
        );
		 
		
		update_post_meta( $post_id,
           '_title_1_7',
            htmlentities($_POST['title_1_7'])
        );
		 update_post_meta( $post_id,
           '_desc_1_7',
            htmlentities($_POST['desc_1_7'])
        );
		 update_post_meta( $post_id,
           '_price_1_7',
            htmlentities($_POST['price_1_7'])
        );
		 
		
		update_post_meta( $post_id,
           '_title_1_8',
            htmlentities($_POST['title_1_8'])
        );
		 update_post_meta( $post_id,
           '_desc_1_8',
            htmlentities($_POST['desc_1_8'])
        );
		 update_post_meta( $post_id,
           '_price_1_8',
            htmlentities($_POST['price_1_8'])
        );
		 
		 
		 update_post_meta( $post_id,
           '_title_1_9',
            htmlentities($_POST['title_1_9'])
        );
		 update_post_meta( $post_id,
           '_desc_1_9',
            htmlentities($_POST['desc_1_9'])
        );
		 update_post_meta( $post_id,
           '_price_1_9',
            htmlentities($_POST['price_1_9'])
        );
		 
		 
		 update_post_meta( $post_id,
           '_title_1_10',
            htmlentities($_POST['title_1_10'])
        );
		 update_post_meta( $post_id,
           '_desc_1_10',
            htmlentities($_POST['desc_1_10'])
        );
		 update_post_meta( $post_id,
           '_price_1_10',
            htmlentities($_POST['price_1_10'])
        );
    }
	if ( array_key_exists('price_dish', $_POST ) ) {  update_post_meta( $post_id,
           '_price_dish',
            htmlentities($_POST['price_dish'])
        ); }
	 if ( array_key_exists('below_2', $_POST ) ) {
         update_post_meta( $post_id,
           '_below_2',
            htmlentities($_POST['below_2'])
        );
		
		update_post_meta( $post_id,
           '_title_2_1_2',
            htmlentities($_POST['title_2_1_2'])
        );
		 
		
		update_post_meta( $post_id,
           '_desc_2_1_3',
            htmlentities($_POST['desc_2_1_4'])
        );
		
		update_post_meta( $post_id,
           '_price_2_1_4',
            htmlentities($_POST['price_2_1_3'])
        );
		
		
		
		update_post_meta( $post_id,
           '_title_2_1_5',
            htmlentities($_POST['title_2_1_5'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_7',
            htmlentities($_POST['desc_2_1_7'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_6',
            htmlentities($_POST['price_2_1_6'])
        );
		
		update_post_meta( $post_id,
           '_title_2_1_8',
            htmlentities($_POST['title_2_1_8'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_10',
            htmlentities($_POST['desc_2_1_10'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_9',
            htmlentities($_POST['price_2_1_9'])
        );
		
		
		update_post_meta( $post_id,
           '_title_2_1_11',
            htmlentities($_POST['title_2_1_11'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_13',
            htmlentities($_POST['desc_2_1_13'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_12',
            htmlentities($_POST['price_2_1_12'])
        );
		 
		
		
		update_post_meta( $post_id,
           '_title_2_1_14',
            htmlentities($_POST['title_2_1_14'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_16',
            htmlentities($_POST['desc_2_1_16'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_15',
            htmlentities($_POST['price_2_1_15'])
        );
		
		
		update_post_meta( $post_id,
           '_title_2_1_17',
            htmlentities($_POST['title_2_1_17'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_19',
            htmlentities($_POST['desc_2_1_19'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_18',
            htmlentities($_POST['price_2_1_18'])
        );
		 
		
		update_post_meta( $post_id,
           '_title_2_1_20',
            htmlentities($_POST['title_2_1_20'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_22',
            htmlentities($_POST['desc_2_1_22'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_21',
            htmlentities($_POST['price_2_1_21'])
        );
		 
		
		update_post_meta( $post_id,
           '_title_2_1_23',
            htmlentities($_POST['title_2_1_23'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_25',
            htmlentities($_POST['desc_2_1_25'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_24',
            htmlentities($_POST['price_2_1_24'])
        );
		 
		 
		 update_post_meta( $post_id,
           '_title_2_1_26',
            htmlentities($_POST['title_2_1_26'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_28',
            htmlentities($_POST['desc_2_1_28'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_27',
            htmlentities($_POST['price_2_1_27'])
        );
		 
		 
		 update_post_meta( $post_id,
           '_title_2_1_29',
            htmlentities($_POST['title_2_1_29'])
        );
		 update_post_meta( $post_id,
           '_desc_2_1_31',
            htmlentities($_POST['desc_2_1_31'])
        );
		 update_post_meta( $post_id,
           '_price_2_1_30',
            htmlentities($_POST['price_2_1_30'])
        );
    }
}




	function wpslr_admin_actions() {  
		
		
	} 
	function myplugin_deactivate(){
			
	}

	function wpslr_admin__register()
	{
	
?>
<?php
	
	$args_menu = array ('post_type' =>'tgmenu','order'=>'DESC', 'paged' => $paged, 'post_status' => 'publish','posts_per_page' =>1, 'suppress_filters' => false  );
   	$all_menu_items = new WP_Query( $args_menu );
	//print_r($all_menu_items->posts);
	foreach($all_menu_items->posts  as $mmitems){
		//echo $mmitems->ID;
	$below_2 = get_post_meta( $mmitems->ID, '_below', true );
	$value_28 = get_post_meta( $mmitems->ID, '_title_1_1', true );	
	
	$value1 = get_post_meta( $mmitems->ID, '_desc_1_1', true );
	$value2 = get_post_meta( $mmitems->ID, '_price_1_1', true );
	$value2_1 = get_post_meta( $mmitems->ID, '_title_1_2', true );	
	$value2_2 = get_post_meta( $mmitems->ID, '_price_1_2', true );
	$value2_3 = get_post_meta( $mmitems->ID, '_desc_1_2', true );
	$value3_1 = get_post_meta( $mmitems->ID, '_title_1_3', true );	
	$value3_2 = get_post_meta( $mmitems->ID, '_price_1_3', true );
	$value3_3 = get_post_meta( $mmitems->ID, '_desc_1_3', true );
	$value4_1 = get_post_meta( $mmitems->ID, '_title_1_4', true );	
	$value4_2 = get_post_meta( $mmitems->ID, '_price_1_4', true );
	$value4_3 = get_post_meta( $mmitems->ID, '_desc_1_4', true );
	$value5_1 = get_post_meta( $mmitems->ID, '_title_1_5', true );	
	$value5_2 = get_post_meta( $mmitems->ID, '_price_1_5', true );
	$value5_3 = get_post_meta( $mmitems->ID, '_desc_1_5', true );
	$value6_1 = get_post_meta( $mmitems->ID, '_title_1_6', true );	
	$value6_2 = get_post_meta( $mmitems->ID, '_price_1_6', true );
	$value6_3 = get_post_meta( $mmitems->ID, '_desc_1_6', true );
	$value7_1 = get_post_meta( $mmitems->ID, '_title_1_7', true );	
	$value7_2 = get_post_meta( $mmitems->ID, '_price_1_7', true );
	$value7_3 = get_post_meta( $mmitems->ID, '_desc_1_7', true );
	
	$value8_1 = get_post_meta( $mmitems->ID, '_title_1_8', true );	
	$value8_2 = get_post_meta( $mmitems->ID, '_price_1_8', true );
	$value8_3 = get_post_meta( $mmitems->ID, '_desc_1_8', true );
	
	$value9_1 = get_post_meta( $mmitems->ID, '_title_1_9', true );	
	$value9_2 = get_post_meta( $mmitems->ID, '_price_1_9', true );
	$value9_3 = get_post_meta( $mmitems->ID, '_desc_1_9', true );
	
	$value10_1 = get_post_meta( $mmitems->ID, '_title_1_10', true );	
	$value10_2 = get_post_meta( $mmitems->ID, '_price_1_10', true );
	$value10_3 = get_post_meta( $mmitems->ID, '_desc_1_10', true );
	// Second form data
	
	$below_22 = get_post_meta( $mmitems->ID, '_below_2', true );
	$value2_1_2 = get_post_meta( $mmitems->ID, '_title_2_1_2', true );
	$value2_1_3 = get_post_meta( $mmitems->ID, '_desc_2_1_3', true );
	$value2_1_4 = get_post_meta( $mmitems->ID, '_price_2_1_4', true );
	$value2_1_5 = get_post_meta( $mmitems->ID, '_title_2_1_5', true );	
	$value2_1_6 = get_post_meta( $mmitems->ID, '_price_2_1_6', true );
	$value2_1_7 = get_post_meta( $mmitems->ID, '_desc_2_1_7', true );
	$value2_1_8 = get_post_meta( $mmitems->ID, '_title_2_1_8', true );	
	$value2_1_9 = get_post_meta( $mmitems->ID, '_price_2_1_9', true );
	$value2_1_10 = get_post_meta( $mmitems->ID, '_desc_2_1_10', true );
	$value2_1_11 = get_post_meta( $mmitems->ID, '_title_2_1_11', true );	
	$value2_1_12 = get_post_meta( $mmitems->ID, '_price_2_1_12', true );
	$value2_1_13 = get_post_meta( $mmitems->ID, '_desc_2_1_13', true );
	$value2_1_14 = get_post_meta( $mmitems->ID, '_title_2_1_14', true );	
	$value2_1_15 = get_post_meta( $mmitems->ID, '_price_2_1_15', true );
	$value2_1_16 = get_post_meta( $mmitems->ID, '_desc_2_1_16', true );
	$value2_1_17 = get_post_meta( $mmitems->ID, '_title_2_1_17', true );	
	$value2_1_18 = get_post_meta( $mmitems->ID, '_price_2_1_18', true );
	$value2_1_19 = get_post_meta( $mmitems->ID, '_desc_2_1_19', true );
	$value2_1_20 = get_post_meta( $mmitems->ID, '_title_2_1_20', true );	
	$value2_1_21 = get_post_meta( $mmitems->ID, '_price_2_1_21', true );
	$value2_1_22 = get_post_meta( $mmitems->ID, '_desc_2_1_22', true );
	$value2_1_23 = get_post_meta( $mmitems->ID, '_title_2_1_23', true );	
	$value2_1_24 = get_post_meta( $mmitems->ID, '_price_2_1_24', true );
	$value2_1_25 = get_post_meta( $mmitems->ID, '_desc_2_1_25', true );
	
	$value2_1_26 = get_post_meta( $mmitems->ID, '_title_2_1_26', true );	
	$value2_1_27 = get_post_meta( $mmitems->ID, '_price_2_1_27', true );
	$value2_1_28 = get_post_meta( $mmitems->ID, '_desc_2_1_28', true );
	
	$value2_1_29 = get_post_meta( $mmitems->ID, '_title_2_1_29', true );	
	$value2_1_30 = get_post_meta( $mmitems->ID, '_price_2_1_30', true );
	$value2_1_31 = get_post_meta( $mmitems->ID, '_desc_2_1_31', true );
	  ?>
      <h2 class="paddingtop"><?php echo $mmitems->post_title; ?></h2>;
<div class="col-md-5">
  <h2 class="paddingtop"><?php echo $below_2; ?></h2>
  <?php if($value_28) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value_28 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value1; ?></td>
        <td class="price"><?php echo $value2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_3; ?></td>
        <td class="price"><?php echo $value2_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value3_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php $quantityTermObject = get_term_by( 'id', absint( $value3_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;
		?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value3_3; ?></td>
        <td class="price"><?php echo $value3_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value4_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value4_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value4_3; ?></td>
        <td class="price"><?php echo $value4_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value5_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value5_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;		 ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value5_3; ?></td>
        <td class="price"><?php echo $value5_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value6_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value6_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;
		?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value6_3; ?></td>
        <td class="price"><?php echo $value6_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value7_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value7_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;
		 ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value7_3; ?></td>
        <td class="price"><?php echo $value7_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value8_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value8_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value8_3; ?></td>
        <td class="price"><?php echo $value8_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value9_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value9_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;		 ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value9_3; ?></td>
        <td class="price"><?php echo $value9_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value10_1) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value10_1 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value10_3; ?></td>
        <td class="price"><?php echo $value10_2; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
</div>
<div class="col-md-5 pullright">
  <h2 class="paddingtop"><?php echo $below_22; ?></h2>
  <?php if($value2_1_2) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_2 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;
		 ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_3; ?></td>
        <td class="price"><?php echo $value2_1_4; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_5) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_5 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;
		 ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_7; ?></td>
        <td class="price"><?php echo $value2_1_6; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_8) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_8 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_10; ?></td>
        <td class="price"><?php echo $value2_1_9; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_11) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_11 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_13; ?></td>
        <td class="price"><?php echo $value2_1_12; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_14) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_14 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_16; ?></td>
        <td  class="price"><?php echo $value2_1_15; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_17) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_17 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_19; ?></td>
        <td class="price"><?php echo $value2_1_18; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_20) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_20 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName;
		?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_22; ?></td>
        <td class="price"><?php echo $value2_1_21; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_23) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_23 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_25; ?></td>
        <td class="price"><?php echo $value2_1_24; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_26) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_26 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_28; ?></td>
        <td class="price"><?php echo $value2_1_27; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <?php if($value2_1_29) { ?>
  <table class="table">
    <thead class="thead-inverse">
      <tr>
        <th><?php 
		$quantityTermObject = get_term_by( 'id', absint( $value2_1_29 ), 'dish' );
	$quantityTermName = $quantityTermObject->name;
		echo $quantityTermName; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $value2_1_31; ?></td>
        <td class="price"><?php echo $value2_1_30; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
</div>
<?php } ?>
<?php }
register_deactivation_hook( __FILE__, 'myplugin_deactivate' ); //hook called on deactivation
add_action('admin_menu', 'wpslr_admin_actions'); //While activating plugin
add_shortcode('tagesmenue', 'wpslr_admin__register'); //Short code
?>