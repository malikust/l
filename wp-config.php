<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lbsubscription_WP_V');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/** Debugging mode **/
define('wp_DEBUG', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'BCPg-wVts-`*W|@ScQ#tomN~#2p$SO+f|$i=m|^s{epOmJ0u*D_wC3o:)>~fYpv$');
define('SECURE_AUTH_KEY',  '+BqJ@KDks8NBo{;j`+4fNwEiiMGAV58^l-xSE~,+OYbBvqApA/q @e?yyq<h.WHc');
define('LOGGED_IN_KEY',    'P|h+P05G Eh:sg]/b+q,,rXe6-*~x,jhy;8ZK668Pb|i:c)W]TeV!:aC:)&>szF}');
define('NONCE_KEY',        'D]|L,ao(lCHw8k-0XILZA:n34SP8R?F6ZB19`r@>U4.B(B|hH|A:}RW$e%5oGWk/');
define('AUTH_SALT',        '1s-`,)RV99Wa5u@Hb|JS?dppb,gt3bapqkMZ;F,c/qAVA,W^QRnx&c_R/U,-;VQp');
define('SECURE_AUTH_SALT', 'J@@ :q5Y,;s$,$+Q|ZMp-tgNc+:*#N(AVC?Zh9eLms{4;l|%;L[gJ|iH@R?D_[v:');
define('LOGGED_IN_SALT',   '?&puUBZ8%!dY:qpm`&w4S3I95_-Lci}6*aJ }Su|$vjtu%Fa;{b+6|KW=-C+yKue');
define('NONCE_SALT',       'iV+3`0@iD/t:OP! FF^cZoBpiz5:2%J)L#g,FKal#Z>k)+KxJU6Z[anhJ4Y0&i@)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
