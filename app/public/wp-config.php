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


define('WPLANG', 'en_US');

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
define('AUTH_KEY',         'zjhYeMSCLbce5HVbfVizYSWj5ioLaZ6qRPi76sKuqFpoXYaInQ0s42IJ3juTU4jloDsWgAEW9VJ0jPtCKuEYEg==');
define('SECURE_AUTH_KEY',  'E71IK3qH7+U0nSW3tO3Fzh2MReRUdSvEg8NcESLrJ6H9A7tTlSyp3KNoXH5ILY8LVf8St9VAZQzVpc78Ho/5MA==');
define('LOGGED_IN_KEY',    'LhDF0L8AftktSevRVqw0MwP+cWY5fLh0tuDZ++jyOByphjBVZmM32tIRuhwzDPDQltz2sQsaT7JTI+aiRHSzwA==');
define('NONCE_KEY',        'gopn+8PQNjYPUxwLZrRZBvaxAWAcu7RpOAetRsG+kri88MZm032pTuRe27rrJPzygFFQraet4jzCiRT18GpMfg==');
define('AUTH_SALT',        'ypQkKOYcfMrk7DwXTp1vyIkgp0Ty4Xn5Fr3FNZ5LpIQt06hg0XN+SJjwiblfDK5K3+hu31+DRQCRHKcgquppeg==');
define('SECURE_AUTH_SALT', 'z0D4sYMnonD6WehkoeWzhOf9hGV7ZBDcCwJCvzm0uTAs5yqAKbJl0VulLcnIC2dKeTMtMLeFFoK4u8uJseIK1g==');
define('LOGGED_IN_SALT',   'M1r6SggXzCxHvQSGkOhuwvA1ompbXMRpHDnZXE3a73/X2YSF4w7cJnuLnOdI04KREJqRDUSx7AVbLlxIheHC8g==');
define('NONCE_SALT',       'aFjdeW657DWkjSS0DQm63FKdzjfPIECZfbQNf3FFol7AE3pZB7n1MrpfN2SEd9v7rM4wwDCB6YhyQtCMk6qTqw==');

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
