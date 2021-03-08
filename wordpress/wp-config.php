<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:1433' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'j;n*rPb*#NG8Wq~15X&pIN2UXwyTp%}g9t_B{SG.^(kt=~G,pqX]0]nlx:/6[@EI' );
define( 'SECURE_AUTH_KEY',  'l^|@QDo7NB^rZwCI&6Q=_n]w]Ub>Z&Rn+n>z1C1H#.@|W8Vd3|/+pe/_v(<FFW%0' );
define( 'LOGGED_IN_KEY',    'n<n~zsxoVAX@hqW,RykfY.]V^e+*H`;wgB8Ga;X0.l?CBtx?p0)i7eiI[VxRD.oo' );
define( 'NONCE_KEY',        '4*fAG!? Ucpg>S!xUmOa!tnxNmw`{uVmj9o}sGak#`1>s/7PJ}YmI%|;Ek y,19~' );
define( 'AUTH_SALT',        'Q!}5JNk!jK=rZ=Dt2k}Soi/_C.q~r@Dh=LwyH]BY$d(5yHR&;~6ECy!C^yc}&1<8' );
define( 'SECURE_AUTH_SALT', '#])ZI,Y:SuAH@KBUaxn87h6Iu)^S48 |g{oTmnC^,e8)H2H7b6>AIu<F{V@Q|hA`' );
define( 'LOGGED_IN_SALT',   '<,;@)3H;RMHZy1Tl-<kNhF,zQU?Bu[_9=Z*L6fW&}aSm$K(j(eTA3A0VpEP<@qGm' );
define( 'NONCE_SALT',       'Xj$XxJP|E4$@&z-*m}Q<)U,rb[U)oU1 wX=5bAv=xR&naF@xTzQ 80,W Gl%xZtS' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
