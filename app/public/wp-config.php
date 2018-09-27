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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define('AUTH_KEY',         'TGZ2jvBjGY9AYsNfbk89IA9oo1073J2p+8S6uKHxvHwBKNy00e8bEXv7Qx+p2ah6zqpT9Oui6oost0JBgp/0aw==');
define('SECURE_AUTH_KEY',  '/EyOkDyEVS40QEeqTMS0CH9lv6PaLQx+jNWTTZiPa0Wqt5g3QLvRYmSoeuljHp32qyOr5q6Er5n4BToq63ampQ==');
define('LOGGED_IN_KEY',    'F1KWCsJal86x5Ir7U7FCJPdhh1WEhqWQxZSK4Od+5w4g9NMnyC0fpBKSsw9eU+1XA1SRJ3A8aL0xqs/Uf79DHA==');
define('NONCE_KEY',        'VBKSDF+cWRQdsN85EE3VxnWoql3HdkFFkoRu2InPTZumUa/6qkcnOgV4yiR8cTe+bv3RxPJQo4eCfomBG9h17g==');
define('AUTH_SALT',        'HR8lDPDNa12MVdwrDdSkrFqGvWqI4c68iJJWQZ1hqnIkcpB8jnTpCkE6MxfOZiJFolhuEyfGZ1yVo3909qDVPg==');
define('SECURE_AUTH_SALT', 'WAS3MqztMRYIL9uPsAH1IONPfaUOcLPMDaA3ypNfMHeT1D1fuzJMavsL8ogB/367A+GrNi0Vvl+adm0FSVUWzQ==');
define('LOGGED_IN_SALT',   'BvMll82WV7o57TCO/89TPoDMICgdbdr6yNasyAZ7ljmAnwWqomcr6SQ+AXlfz8oMYBexPbiniCGTE+nzk3TMuA==');
define('NONCE_SALT',       'Wb26jF8F2hrOnmSxFr/TNGYWyYjyIq40M/2wDiVQ2BSc+89OrBNDNaBHGfDk5UMo2nA3MqLpPSLnEbIf22IPIg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
