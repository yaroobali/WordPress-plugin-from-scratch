<?php
function dbsync_install(){
	global $wpdb;
	global $dbsync_db_version;
	
	// DB Sync tasks table
	$dbsync_tt_table = $wpdb->prefix."dbsync_tasks";
	
	$sql = "CREATE TABLE ".$dbsync_tt_table." (task_id bigint(20) NOT NULL AUTO_INCREMENT, 
	task_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
	task_initiator int(2) DEFAULT '0' NOT NULL,
	task_type int(32) DEFAULT '0' NOT NULL,
	task_warnings int(32) DEFAULT '0' NOT NULL,
	UNIQUE KEY task_id (task_id)
	);"; 
	
	require_once(ABSPATH. 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
	add_option("dbsync_db_version", $dbsync_db_version);
	dbsync_theme_additional();
}
?>