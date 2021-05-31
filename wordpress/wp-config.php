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
define( 'DB_NAME', 'wptestsite' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'rMh~z!8u,yPT;;GmFRg5)m8EJVrt>l,Q;^<RYOM3{6rR6QoXY /.)TDjV5x1UN$x' );
define( 'SECURE_AUTH_KEY',  'w6Q;B.W*pd:WO[&~x2jN(Kx=dH+l;)0N{ib2i$lc$QYLgPur7ViF*0_}|<yA,+WJ' );
define( 'LOGGED_IN_KEY',    'fuCX3+.._p.E1*qPl7,`STW#s|fd pfBYE!/U$(4S*J)o) J*:rPigCv,me>Uc,2' );
define( 'NONCE_KEY',        'n->4tB]b9^5M~+/!*lF92Q@Me.-y6Ks&gQLviK-s_sa[KBOo)8h%]@*RUj=jAze6' );
define( 'AUTH_SALT',        'QBtRzd/%B/d[f?@sQ3$IR=EkJ%.3%eKLN~Z06Yun%%zp9{d%[=X:h71cXi/Yo<~J' );
define( 'SECURE_AUTH_SALT', '/vf0]G0`$GKC]]&9Ufs`diZhP4x3l$`iB.C:2{B_i#jyp<M 3|dI]Q!tiJ5YQ^5}' );
define( 'LOGGED_IN_SALT',   '+e^JTa@_<Dhp$v> =YjMJA^<O9+8dJs5.iNp!m#U`e]7;0LO`U<rlN`uC:99uceJ' );
define( 'NONCE_SALT',       '`c:v3YJc%>/KIOzVY=LXYP|Pu,xXI^i6j6Zl,ALz*mn6bE|^%E[OG!Y5`vBE6e h' );

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
