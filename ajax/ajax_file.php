<?php
include '../../../../wp-load.php';
global $wpdb;
$data	=	get_term_by( 'id',$_POST['name'], 'dish' );
echo $json_str =  '{"cont":"'.htmlentities($data->description).'"}';
?>