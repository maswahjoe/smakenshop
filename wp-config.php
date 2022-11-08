<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'epiz_32621923_w428' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost:8889' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('WP_DEBUG', 'true');

 
define( 'WP_DEBUG_LOG', true );
 
define( 'WP_DEBUG_DISPLAY', false );

@ini_set( 'display_errors', 0 );
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'dpc6yj0vdblioccz0ci7jwozqy1699mv1zml7lira4el2q96keppvh7vxscuhnnh' );
define( 'SECURE_AUTH_KEY',  'bkbirtyloaswlsd9oapmsusjxcpz1asxpaoko0nrwa4pz0s5culcsdgwuz0fesbc' );
define( 'LOGGED_IN_KEY',    'rihtl4elcgw6ajwazlqjpduowj6qavhgpldpqeupak3k5suyt6tpuqnjawegwsmm' );
define( 'NONCE_KEY',        'bvcsbjoouqqtmdjfdp2zn9kaiaqt7feahsi3z98gt4t2pf9ahdqf6qyoq1ymzerq' );
define( 'AUTH_SALT',        '7hywkhydbl21inbwxwrsglzdkhksjlmitzprajjv67rt5bjb9mem0udcn9x9qpgn' );
define( 'SECURE_AUTH_SALT', 'ykvcmftsybzjihjhpua2vmfhpqjvsprjd2y7nwjjnpgw8ucij1sp0ljawebcxyrz' );
define( 'LOGGED_IN_SALT',   'hcmd8vvj7ltum5nb6xags3y8mkz7jhumxvs9wvroa9hocddsesoghliyswsrkloz' );
define( 'NONCE_SALT',       'bdzrfsxm79nhsndnymmuvrkb9pgljrsnaqjaqzbk6adhhoig02487jyecls64ma3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp32_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
