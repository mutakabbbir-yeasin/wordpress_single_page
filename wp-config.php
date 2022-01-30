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
define( 'DB_NAME', 'nagortech-6' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '~XJBjooCId8sV9kU9?pgo!<T=3)]}/:?Lb9*u!RS~z73Vpr6lt!@e}^-SEXTCgIz' );
define( 'SECURE_AUTH_KEY',  'dXRB3Pk?YV:mt[e?S=H*c*9O]`e&(OpeHM@Srrio~R06_bD`6>bZMhjLr~71.+Q ' );
define( 'LOGGED_IN_KEY',    'S:XG>2aa3m&x@{aLsEQ1h:T9o 6!cDQ)a*TgniT8.Syn};w[aiDiTNtncl8Q))jH' );
define( 'NONCE_KEY',        '|~oESe=$rC[]qxdqZlta{Q`3P_ToVN}Tj~@tR<_cfu _/F[r?cc!w=D*+?bqZ%I}' );
define( 'AUTH_SALT',        '#U)q/,@8j|91lSc[UWJd8l:^kljFh<,1=a=B,O#YK^~&yI1ee[[]YjZzG^]F`xA-' );
define( 'SECURE_AUTH_SALT', 'p8vk[+f36Iox 8y}ACNPhm{7a?3b*jI2+Uw$umK6p!7,o-XQw_30Ia[Aa?V!WFO}' );
define( 'LOGGED_IN_SALT',   '~7!f:g!2zh3Lt&UT=j84]7{_-eB@W/v?;H/7I2$owVu,8P.x?Y636$0SPMf Hij@' );
define( 'NONCE_SALT',       '3>^SHWFofyX$C=L&r#{AQBSFRZIH#H:(Z]CX]WlMy?17fOWMHQGNxHw7NR5g[!U-' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
