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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'QE?`$y^5!Yh==_w2,nG@n&PeK%3Ut.D|bYVr#`&0DH*&B}}~adkJ0mrEoLvnR&dj' );
define( 'SECURE_AUTH_KEY',   '?W!nTm C]Q/N}8.9#M${KiKEG+.nwOz8f&!:kUmAPmO!PCxM5kbQQnaJcL:5=o>}' );
define( 'LOGGED_IN_KEY',     'J!r[Pnfx} ]?E[dHhTJfmg AyD->,IZ[a{>10=PRp0*Uh3>5&:B2p;Q*9mYZ%{V?' );
define( 'NONCE_KEY',         '/,0I51U&X/v?~f)ya#PPO^.Y`9S#%Sh:k&GZ~N;ejein|8T@(T53|U@G5VilR+UP' );
define( 'AUTH_SALT',         '}@mefPXb;U.cr%lA>A,{pkJwxup7n^v&<%!?hgGzly!iUzWWIj#D$ ;(/8-[c?EA' );
define( 'SECURE_AUTH_SALT',  'xHES#V},a;C_>:7f:7n34fQZ2on(fQBsQRfU2+B| CnkFb*Vf3FG)nwD:#n&][D4' );
define( 'LOGGED_IN_SALT',    'ez22*FE}5/[ap56GF%iC%6X`)S|Jmerx=NtP]|@r+#WN]2B,1C[0tr#;`I^Y{,NY' );
define( 'NONCE_SALT',        '<cV_4cG+8z9^9?N8bb,142;ZALe,LuKGO%NB&B~+jIs=FP9tgOV{k^-qz.%~kiok' );
define( 'WP_CACHE_KEY_SALT', 'hy,Ja^mr%%j>i9}mFvLmzRa9_vvBg+Q9cBuky@B4p,46u+~%d+%@VL/1PpKt4jw;' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );

// Credenciales de Google Login
define( 'GOOGLE_CLIENT_ID', '455630150149-41grlbh2ebfpha2sh2m3cfb72eq91o9i.apps.googleusercontent.com' );
define( 'GOOGLE_CLIENT_SECRET', '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' );
define( 'GOOGLE_REDIRECT_URI', 'http://mgwp.com/wp-login.php?action=google_callback' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
