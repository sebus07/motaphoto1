<?php
define('WP_CACHE', true); // WP-Optimize Cache
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
define( 'DB_NAME', 'motaphoto1' );
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
define( 'AUTH_KEY',         '}Y$iAHC^yC-d-cc38a3Y2C9-)vglM7W-mzsn5Tg64z)u*Karu7XQv_XWa+7Bo0A5' );
define( 'SECURE_AUTH_KEY',  '7t_ovkG.WSnfn:cN^taq?Gm0uSsOLV^<U`mcZ,5:/c{4t^XP:@f/sn=.@{P7Ksa}' );
define( 'LOGGED_IN_KEY',    'ntRCpMVE}]!Ca2I2[5Yx?DhgV]e/<Xhysq_F?$`/-;at^F*>fraH=f)*-Y;.b<7E' );
define( 'NONCE_KEY',        'a]Nsz?>4`G$= (l8s;q02}S:4nLv!X15LHnqd4:VR<(d-VLB_J*-UqZ{QLyMs)`O' );
define( 'AUTH_SALT',        'X:7%DoId&l8mnEn?d6o+4k,,</}?f!RhDDcn5u6PrJt~&;X/(6~X)>Zlqm+tHJzy' );
define( 'SECURE_AUTH_SALT', 'NQe(%q|?C]jkXR*4Le?2<PAc[!4$d*1S(}u5>lgNb$dDMuhXos0>6|f;_Qh>kfo1' );
define( 'LOGGED_IN_SALT',   'eT3@LX`)Z vdO4~#T#JH_ekHCw}C/t[4QVm:?:J^pr<vH_5:MEutyh4B!z7.@7E8' );
define( 'NONCE_SALT',       'o;n:Y2B`iV=a%b/9d[e=xu]2x{Bw5wUu}]P3{|$7*Lzki56vm2R(YI)Z.w2*NX85' );
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
define('WP_DEBUG', false);
/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */
/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');