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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'id17546271_wp_3397d15a2349f99eb8c9e160b6f146f3' );

/** MySQL database username */
define( 'DB_USER', 'id17546271_wp_3397d15a2349f99eb8c9e160b6f146f3' );

/** MySQL database password */
define( 'DB_PASSWORD', '0f99ed5629d73c132cf033d8033786660826971a' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'pU^!E+8JQ/wb!VmxQAjXtaW0w^kOO+sT9Hfs)-EXLn6y7fi&1s~ZUR5>cP}vZbE1' );
define( 'SECURE_AUTH_KEY',   ' 4jpZKnRW7bf>fo/p@,NE>E*r2wpM v><)6)BE6tAu?65sUMHg$4Fhtroh)K_$5S' );
define( 'LOGGED_IN_KEY',     'YOdy,AF`e? r+.es;NQGEYa]|TX00f0%fC|cH3.i!)r!lF$tGJ&Ylv@k|aA<s6G;' );
define( 'NONCE_KEY',         '$Zx7AG}w;)sypS(X[K]7.ZF/yeCV0H:2JprdmWJoB%rIVkk)MHsE]g=9H#$1Mk,p' );
define( 'AUTH_SALT',         'yFdJD=_(@:-t[Aw#5@z,?JQgfM]J<Pt}ZkIg39lN=kE[HU(vBp-.&H_V;DT.}4OV' );
define( 'SECURE_AUTH_SALT',  '/Fmp>#Z9S/TbkJ.`A%@.9zm&Z3J48+p;G@$r&V@-t/Uo=D]eEA]<b<YKf^i1dNI.' );
define( 'LOGGED_IN_SALT',    '&i_P@QqtG!7z+^uWo5 9eZ46Oi[35,Wq8P(>)}G*DuD.)T/a(uHpCCQw/Eu^(mC;' );
define( 'NONCE_SALT',        '<>7|doRew0b.le<u0VVfFmq0o :@y+UBD;5 ,_zv@X$L~eN/-l:i$ tK}Y~@[}8l' );
define( 'WP_CACHE_KEY_SALT', 'C@!D#xMmocJ3)P~6Kmp.qeQtG )9Q(Qx7r:fI;2GG~}GF8jqY</3jDIHCPee%(St' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
