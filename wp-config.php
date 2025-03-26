<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */


define('STRIPE_SECRET_KEY', 'sk_test_51R6pNCDAWlyIto8u5Hrhm09HiU3dgwSzvpDiCJFkJmKrqNx5yKcg7yE0NiqcFDugN3pSxXd4q8x8K2keIYnlm8GZ00QXcVvPTm');


// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'stripe_project' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '@8@l0{aL(<P?xlpP6wZJ&j[b@qKkpiilpnjor623UK6!{eH3?uP%[&9KjBO;2|k&' );
define( 'SECURE_AUTH_KEY',  '4l8ZY5C?t-~0Li}N.$9rapaQUH>P:-Y~g=xIQ1Oe88gDD:Qjgrb@,f`nXnDjU!sG' );
define( 'LOGGED_IN_KEY',    'Y:GyX.1 PV{A-O8[WjT-hR0ymb0o7bu(HTjkWI8PM0!|uP2mi+f!|L~F3CZPLT`i' );
define( 'NONCE_KEY',        '?(C2y[)j-wZBUiu=(%jW*$)p,&%_T^a39yYt=d_Z&Z&];p[2EW$<(qU9w{cF|C+.' );
define( 'AUTH_SALT',        '[?sXQ:Cdo&>4Hfps 97+Pce-xEWm.P.xyOsb!p/lRV<n]Xf36_/SS^#n;F1$n,0z' );
define( 'SECURE_AUTH_SALT', ':bi/|VEIuG-+@qO$@5WfUUnYMLD_MfG^|!c}oa:FCc|dAV`;/gAxP0ON8Fp@Ae@^' );
define( 'LOGGED_IN_SALT',   'v$S(q/fy4 HaHj8qkwG<fVN J3_|Bd5vs}*Qxv5nl0 6~[)|#3hKJkb}%.`&kUho' );
define( 'NONCE_SALT',       'JS^`f}Se3jsI>/DoYixbJ*!I_{ShQKE!C[IFHuDI=_w;l<]T}!U&25cY3K%hZA,a' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
