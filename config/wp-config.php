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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'djcifamy_a0b' );

/** MySQL database username */
define( 'DB_USER', 'djcifamy_a0b' );

/** MySQL database password */
define( 'DB_PASSWORD', 'BEAD5F1s2z6bh07g4i9t3q8' );

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
define('AUTH_KEY',         'RI&<?3k(<dF<ci(u7wZD2S;1`i]|cg;XN]@*,jj%ciDD:Q|`b|x@=PLzw][|5c+f');
define('SECURE_AUTH_KEY',  '6]OH7?s-D[ocgMAEY#Hb1Ye_z|cc@:i7E!$yB/l|I3G$+zJWDIx9sqFT*5#XtL<:');
define('LOGGED_IN_KEY',    'y$Ev=y1xY*pNw|P3s3,^JKb+b-wh_[sgQnXv|TYm>yXI+4+T%6Vh^gV|~[%*@d@h');
define('NONCE_KEY',        'OKN&2}ZehXU{g3;:![g]h@8P7h:@_h6i<p{f+:0-Xh |w~]nK7>B0R1xV>QQ)f!/');
define('AUTH_SALT',        'ivt@|>x96_.bwo/y^wYl*K=5|3}/GJ3VuTtyu<)-1C+pH)nO(9CsR9;:g3oK>|_+');
define('SECURE_AUTH_SALT', '34-i+ pol{@q#OGWS(06hFdw/y%gGT)<tg?]Z^o-(fqj7:X90+SAR|TN}+c,u(!_');
define('LOGGED_IN_SALT',   'L2K7-- % rsWjS-!%eQ~[rvSLy-(-i=^0 t5em$ywenYO/Km@rgD3gBE?Dg5ua=~');
define('NONCE_SALT',       'EB<GY:U!ti8^!c?bAb+3-_Rdg.f8)J>Lv`3UNeKyV;Is-XkR;ldVnw=+|Y(KJj%B');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'a0b_';



define( 'AUTOSAVE_INTERVAL',    300  );
define( 'WP_POST_REVISIONS',    5    );
define( 'EMPTY_TRASH_DAYS',     7    );
define( 'WP_AUTO_UPDATE_CORE',  true );
define( 'WP_CRON_LOCK_TIMEOUT', 120  );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'djc.ifa.mybluehost.me');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
//** Debug Mode */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
