<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'pVCgMjYD2XdMHGSONKdiuUYVPZkvUMIlZ08r8GuH5KS3gg4EAarDtGthAmHGAz8U');
define('SECURE_AUTH_KEY',  'V0zpoc0230Hg5pW8aQOCoQYi3pEpjGONNdisWkkFS0GS7qrf17UvQVXNTlJgBnQ4');
define('LOGGED_IN_KEY',    'DCfOGNEHQsjMIF8kUvzGmywwUvE6o0TcfyqhegKhRUQr1iKRLRQEUZvrXhzhl0JH');
define('NONCE_KEY',        'G2I1DQtHUyCvzn9jMcbzjLoCndw68zYz2sVLor0ClLMetbII3czvd1tDYY2LcHWs');
define('AUTH_SALT',        'BVcsxzuxOkpyyDVtDg1WINE9N8kcbfrnVBz2sbTjpB077Ez6vYAUf7ads7byLD58');
define('SECURE_AUTH_SALT', 'IV61UHJK5gAotoe6CIggOy6t582oe42Y7GdTMtxIOHC8dj8bGTd6pCji4SeznwGV');
define('LOGGED_IN_SALT',   '0FrqSG1y32rDcOCWTuNPB5Gygdh9RMpcY1Gq1Rb7OhnmRaZUh689WVosW9LzcMiz');
define('NONCE_SALT',       '8mrDkghLRhzqxvUK1yv5YY2lGMM1JsH9bPel3oEIKkCB0yGvCqydgsYFAlSBBo8h');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
