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
define('DB_NAME', 'u0099327_wordpress_5');

/** MySQL database username */
define('DB_USER', 'u0099_wordpres_a');

/** MySQL database password */
define('DB_PASSWORD', 'i!4QjWTv68');

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
define('AUTH_KEY',         '%IXhf)UJH#%RvCMe4ii(J7gqM08F8RRykoN)lU5AvXLl7OsAc6Xei@rj%FSR2tZd');
define('SECURE_AUTH_KEY',  'VEe9VH7uFf5FrZ0MfRMCA%MpERXXNdU1e(M396470TuXdZKKqJQ7JIqwmgLx4m7z');
define('LOGGED_IN_KEY',    'kMnc%3DFE&pFHobHH0CtiyVPUisiTJpQ7GMh5O&K3yu2d(N(@RzK!nQtUo&d3BAa');
define('NONCE_KEY',        '3hOc(6XOSAP9P57SOpmyz0C#c2bPdjrCfA%24S3Wv@)0E%mA(cLuP9n8tM)Lg!KF');
define('AUTH_SALT',        'MyEd^YI&rQx1p9@3KXv5tyaGnYlJXWprUkBNN0VIwqsJnPFzYQVOo7b3nb6DJ@sf');
define('SECURE_AUTH_SALT', 'jQfx78Sn!P9yJAXboOoOKNpAKt2gDLRmxFpyzBHkPUFcF2^hwPUyyk5gRWpbJFN5');
define('LOGGED_IN_SALT',   '9DVsIN5ABquPerpW0*mCTG)8)o2aCe4U%Z*1KzLkdb^9GscFf84bvYgBQp7wYRWi');
define('NONCE_SALT',       'lmmGR)PeliD7FPu@xpwzUx!H*VZp*LxiVut@mG(3&qIi^7d*jekonp@7DVz9!@E0');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'G59er1K_';

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

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );
?>
