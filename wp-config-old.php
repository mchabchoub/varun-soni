<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/**
* Define type of server
*
* Depending on the type other stuff can be configured
* Note: Define them all, don't skip one if other is already defined
*/

define( 'DB_CREDENTIALS_PATH', dirname( ABSPATH ) ); // cache it for multiple use
define( 'WP_LOCAL_SERVER', file_exists( DB_CREDENTIALS_PATH . '/911-local-config/local-config.php' ) );
define( 'WP_DEV_SERVER', file_exists( DB_CREDENTIALS_PATH . '/dev-config.php' ) );
define( 'WP_STAGING_SERVER', file_exists( DB_CREDENTIALS_PATH . '/staging-config.php' ) );

/**
* Load DB credentials
*/

if ( WP_LOCAL_SERVER )
require DB_CREDENTIALS_PATH . '/911-local-config/local-config.php';
elseif ( WP_DEV_SERVER )
require DB_CREDENTIALS_PATH . '/dev-config.php';
elseif ( WP_STAGING_SERVER )
require DB_CREDENTIALS_PATH . '/staging-config.php';
else
require DB_CREDENTIALS_PATH . '/production-config.php';

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',        ')AAaAO;tc.j$*%:Y-%iTQg`Z+Za[J@=&:7-Oe14C{K2MR_aOWBXY-b$.8>_k>aI|');
define('SECURE_AUTH_KEY', '.^Y}||]g*z7Z`9%1og4]x0&i+R~g~ o}WR`DaE7d{.7*zOqHt4 4iE;HF/w]-W{9');
define('LOGGED_IN_KEY',   'x9?~B+FY!g,Vk=PwKyz+EGZPgB:~7+&7`yB(7(w=NZJ|K+mQO&ZKabs]ht==}|1!');
define('NONCE_KEY',       '[qC6hG:{YU:HH1qMvKVgW-!B)hDv{j=3P:GQBZ+CCI[B.:?=gju[-=P+FADH,Tqd');
/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/

$table_prefix = 'aNaTTa_';

/**
* WordPress Localized Language, defaults to English.
*
* Change this to localize WordPress. A corresponding MO file for the chosen
* language must be installed to wp-content/languages. For example, install
* de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
* language support.
*/

define( 'WPLANG', '' );

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*/

if ( WP_LOCAL_SERVER || WP_DEV_SERVER ) {

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
define( 'WP_DEBUG_DISPLAY', true );

define( 'SCRIPT_DEBUG', true );
define( 'SAVEQUERIES', true );

} else if ( WP_STAGING_SERVER ) {

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
define( 'WP_DEBUG_DISPLAY', false );

} else {

define( 'WP_DEBUG', false );
}


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');