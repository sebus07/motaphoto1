<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'motaphoto' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost:3307' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^)#Y ov&%zH(2DsNp1.=6K4!!~UBUp#Dkx>xWTmf}CoocuHA||=cCHtG_R$CMQ6-' );
define( 'SECURE_AUTH_KEY',  '3nkHibrF:;X`Uats56^MDMc:]u8QCJF*;%8_0|<tMmh8WyD Id4]Ydr}(iXR*PSJ' );
define( 'LOGGED_IN_KEY',    'w` D%Q *7vy~cnw:MIG~m|bK^uSzNNJa7O<oBRO(a;az=wrtu/rFl0jZDLd8e6(t' );
define( 'NONCE_KEY',        '[n%+goc#h,pyY_ocn1:XzQaw5>jxGH1i 61GWf}vU%uvPs|?=CCd3HCKTF5sxQVy' );
define( 'AUTH_SALT',        '.e84]yIZ8>SxOVqiVdS}Z%YVx teXNCc1>5>pB4fYVn3Qj>Lkfrxit?P(pZ^+{HH' );
define( 'SECURE_AUTH_SALT', 'oHg{BZ;cVgIIUtt^rdNV@Tdm ,H-4A|!WoyHyGb.Z@:17]>kE3aIb aYo{X,O3<^' );
define( 'LOGGED_IN_SALT',   'Vo9Hf:*`o6/uAJv{$|^TD,cd$[BXWYtg3aneUI^&_P<g)3~4oLs<qe<P`?Fb_/Ja' );
define( 'NONCE_SALT',       'jAz1ZiH-:v7q{=Wa v?9A3mkO[<NpgxjG[(`M`BnJ!x 0($eqB+Yz=q)gY@XlNG~' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
