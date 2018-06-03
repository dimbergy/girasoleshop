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
define('DB_NAME', 'girasoleshop');

/** MySQL database username */
define('DB_USER',       'dimbergy');

/** MySQL database password */
define('DB_PASSWORD',       '52QXI8pr@!');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',       'xPc5YZPB%2&z*LfvbT5QhKLNDeV9S)JcBd8Wy&h^h&icpZiVU&zLgq8SNh9cAYSA');
define('SECURE_AUTH_KEY',       'ufebZaEUlcNbxxA5Ts!Yz0SmTZ7C0g44eu1gqFz1Z%&UyfBdGQaV3aOvdJqDf9tD');
define('LOGGED_IN_KEY',       '!A^9Nwap!KX#xNA8ZO06ShAmpw!wTYC580FGfypw3GTOmusqA83HR1ccdyERevAo');
define('NONCE_KEY',       'VAiyAsd8fAD9vgxr)4!6pxd^%ZO@J3)UzlpVc&)K1kCDLzIVvhhJmBubgPLIn%Us');
define('AUTH_SALT',       'fJw)z3i8HOydd8q0r3qAhBleCKWFC7FUpCdV&umJvl8Nq7&k*4OdMLEm8ojjrW^e');
define('SECURE_AUTH_SALT',       'Jl(SnTpD)aE@6AoWO@HqZ2UkW2U)GCgBY!kV&I3E2(fD*yOTELyW7^*3w(whHdzA');
define('LOGGED_IN_SALT',       'a3aSGl8TSV4V)ZlH&^fbcyfM@*H57(#R67kJtOES#iu%(ST%Qrzxi^XhfYSo7Ig*');
define('NONCE_SALT',       'HphC2Z)Hswlh7H^6l(MahzZdvWiIRkMjH(JB9RCy82xYEBpxk(zwL*hVBlaU@QN9');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
