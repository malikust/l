<?php
	defined( 'ABSPATH' ) OR exit;
	/**
	 * Plugin Name: LB-Subscription.
	 * Description: One time payment and monthly automated recuring billing.
	 * Version: 1.0
	 * Author: Muhammad Ali
	 * License: A short license name. Example: GPL2
	 */
	 // Plugin menu name and index file 
	 
	 add_action("admin_menu","LbLoadPlugin");
	 
	 function LbLoadPlugin() {
		
		add_menu_page("LB Subscriptin Plugin","LB Subscription","manage_options","LB-subscriptin-plugin","LbIndex",plugins_url( 'lb-subscription/images/icon.png' ), 6);
	  
	  }
	  
	  function LbIndex() {
	  
	  }
	  
	 // Plugin activation
	function createTable(){
		
		if ( ! current_user_can( 'activate_plugins' ) )
        	return;
		
		global $wpdb;
		$query = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix ."coupon  (
	   id  int(11) NOT NULL AUTO_INCREMENT,
	   coupon_code  varchar(30) NOT NULL,
	   type  enum('Fixed','Precentage') NOT NULL,
	   discount  decimal(10,2) NOT NULL,
	   to_apply  enum('Free Shipping','Total Amount','Only Product') NOT NULL,
	   fixed_discount  decimal(10,0) NOT NULL,
	   percent_discount  decimal(10,2) NOT NULL,
	   shipping_discount  decimal(10,2) NOT NULL,
	   number_to_be_used  int(11) NOT NULL DEFAULT '0',
	   number_used  int(11) NOT NULL DEFAULT '0',
	   last_used_date  date NOT NULL,
	   date_created  date NOT NULL,
	   date_updated  date NOT NULL,
	   status  int(11) NOT NULL DEFAULT '1',
	  PRIMARY KEY ( id )
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 " ;
	  
	  $wpdb->query($query);
	  
	  
	  $query = "CREATE TABLE IF NOT EXISTS  " . $wpdb->prefix ."order  (
	   id  int(11) NOT NULL AUTO_INCREMENT,
	   shipp_first_name  varchar(30) NOT NULL,
	   shipp_last_name  varchar(30) NOT NULL,
	   shipp_address  varchar(255) NOT NULL,
	   shipp_city  varchar(50) NOT NULL,
	   shipp_state  varchar(50) NOT NULL,
	   shipp_zip_code  int(11) NOT NULL,
	   shipp_country  varchar(250) NOT NULL,
	   shipp_phone  varchar(30) NOT NULL,
	   shipp_email  varchar(255) NOT NULL,
	   recipient_first_name  varchar(30) NOT NULL,
	   recipent_last_name  varchar(30) NOT NULL,
	   recipient_phone  varchar(30) NOT NULL,
	   recipient_email  varchar(30) NOT NULL,
	   sender_first_name  varchar(50) NOT NULL,
	   sender_last_name  varchar(50) NOT NULL,
	   sender_phone  varchar(30) NOT NULL,
	   sender_email  varchar(50) NOT NULL,
	   transaction_id  int(11) NOT NULL,
	   expiray  varchar(255) NOT NULL,
	   bill_first_name  varchar(155) NOT NULL,
	   bill_last_name  varchar(155) NOT NULL,
	   bill_address  varchar(355) NOT NULL,
	   bill_city  varchar(255) NOT NULL,
	   bill_state  varchar(255) NOT NULL,
	   bill_zip_code  int(11) NOT NULL,
	   bill_country  varchar(250) NOT NULL,
	   bill_email  varchar(255) NOT NULL,
	   bill_phone  varchar(30) NOT NULL,
	   country  varchar(255) NOT NULL,
	   type  enum('Gift Product','Product','Subscription') NOT NULL,
	   date_created  datetime NOT NULL,
	   date_updated  datetime NOT NULL,
	   manually  int(11) NOT NULL,
	  PRIMARY KEY ( id )
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
	
	 $wpdb->query($query);
	 
	$query = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix ."order_product  (
	   id  int(11) NOT NULL AUTO_INCREMENT,
	   product_id  int(11) NOT NULL,
	   order_id  int(11) NOT NULL,
	   product_title  varchar(255) NOT NULL,
	   product_price  decimal(10,2) NOT NULL,
	  PRIMARY KEY ( id ),
	  KEY  product_id  ( product_id ),
	  KEY  order_id  ( order_id )
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
	
	$wpdb->query($query);
	
	$query = "CREATE TABLE IF NOT EXISTS  " . $wpdb->prefix ."product_package  (
	   id  int(11) NOT NULL AUTO_INCREMENT,
	   product_id  int(11) NOT NULL,
	   price  int(11) NOT NULL,
	   frequency  int(11) NOT NULL,
	   description  tinytext NOT NULL,
	  PRIMARY KEY ( id ),
	  KEY  product_id  ( product_id )
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1
	";
	$wpdb->query($query);
	
	$query = " CREATE TABLE IF NOT EXISTS " . $wpdb->prefix ."subscription  (
	   id  int(11) NOT NULL AUTO_INCREMENT,
	   order_id  int(11) NOT NULL,
	   subscription_id  varchar(100) NOT NULL,
	   status  int(11) NOT NULL,
	  PRIMARY KEY ( id )
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126
	 ";
	$wpdb->query($query);
	 
	 $query = " CREATE TABLE IF NOT EXISTS  " . $wpdb->prefix ."subscription_transaction  (
	   id  int(11) NOT NULL AUTO_INCREMENT,
	   subscription_id  int(11) NOT NULL,
	   trasaction_id  varchar(100) NOT NULL,
	   subs_trans_status  varchar(50) NOT NULL,
	   trans_date  date NOT NULL,
	  PRIMARY KEY ( id ),
	  KEY  subscription_id  ( subscription_id )
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";
	
	$wpdb->query($query);
	
	 $query = " CREATE TABLE IF NOT EXISTS  " . $wpdb->prefix ."one_time_transaction  (
	   id  int(11) NOT NULL AUTO_INCREMENT,
	   order_id  int(11) NOT NULL,
	   trans_date  date NOT NULL,
	  PRIMARY KEY ( id ),
	  KEY  order_id  ( order_id )
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 
	 ";
	
	$wpdb->query($query);
	 
	 $query = " ALTER TABLE  " . $wpdb->prefix ."one_time_transaction 
	  ADD CONSTRAINT  one_time_transaction_ibfk_1  FOREIGN KEY ( order_id ) REFERENCES  order  ( id ) ON DELETE CASCADE ON UPDATE CASCADE";
	  $wpdb->query($query);
	   
	  $query = " ALTER TABLE  " . $wpdb->prefix ."product_package 
	  ADD CONSTRAINT  product_package_ibfk_1  FOREIGN KEY ( product_id ) REFERENCES  product  ( id ) ON DELETE CASCADE ON UPDATE NO ACTION
	 ";
	 
	 $wpdb->query($query);
	 
	 $query = " ALTER TABLE  " . $wpdb->prefix ."subscription_transaction 
	  ADD CONSTRAINT  subscription_transaction_ibfk_3  FOREIGN KEY ( subscription_id ) REFERENCES  subscription  ( id ) ON DELETE CASCADE ON UPDATE CASCADE ";
	 
	 $wpdb->query($query);
	 
	}
	
	function lbDeactivation ( ) {
		
		if ( ! current_user_can( 'activate_plugins' ) )
        	return;
		
	 echo "Do you want db deleted also";
	 return false;
	 
	 }
	
	register_activation_hook(__FILE__, 'createTable');
	register_deactivation_hook(__FILE__, 'lbDeactivation');
	  ?>