<?php
/** 
 * A configuração de base do WordPress
 *
 * Este ficheiro define os seguintes parâmetros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informação
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definições de MySQL são-lhe fornecidas pelo seu serviço de alojamento.
 *
 * Este ficheiro é usado para criar o script  wp-config.php, durante
 * a instalação, mas não tem que usar essa funcionalidade se não quiser. 
 * Salve este ficheiro como "wp-config.php" e preencha os valores.
 *
 * @package WordPress
 */

// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define('DB_NAME', 'database_name_here');

/** O nome do utilizador de MySQL */
define('DB_USER', 'username_here');

/** A password do utilizador de MySQL  */
define('DB_PASSWORD', 'password_here');

/** O nome do serviddor de  MySQL  */
define('DB_HOST', 'localhost');

/** O "Database Charset" a usar na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O "Database Collate type". Se tem dúvidas não mude. */
define('DB_COLLATE', '');

/**#@+
 * Chaves Únicas de Autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'YkSnAuZ.|s%eF=-$7R{]WB?.eP.R.oyP)+i;ywFoD_x- .]X-{!.dodZ}RR+hWg>');
define('SECURE_AUTH_KEY',  '/vKh*zh9Tc+v+Q|Xq.UNbrUBln]k2-|6p#%0Lc2|&[.UJd(H7N/;o}mv0S1aF0^H');
define('LOGGED_IN_KEY',    'C$!fQ;V8h8itl>{,17}q&oqLT+|#!.*hu$B)F:;T=+!|4U.~Zi!M7C[pi~$jP13 ');
define('NONCE_KEY',        'VIqC._GFiI-+-{ntwNASC%$}fk1K]qUj>wy(M8l}i6;R3^$4|L7=pU6Z-IYdCv/[');
define('AUTH_SALT',        '-r^lFuZDx6=9>!|`b+1R!Lft-7*4+~y%rLF<t][C|^]>^a!`]vZ/|-%p]dH3TRXk');
define('SECURE_AUTH_SALT', '_ZW?RwTq2KN+1F0p+@A7m_w0Nf9Vu^EoUfJn<#IUSd+5#SF,P^L%l6a.7hfM*a3Y');
define('LOGGED_IN_SALT',   'z*Fa)$rq1*%lS|qP?[e1Eh+[J$K9rL/T6N$!O Is@=#,8w_:-Ha77Xn7L-}^~9Ic');
define('NONCE_SALT',       '^EU-WaqBb+E#8ixJSY#4ag7twfzND*b}v6g+bXt3(cxGgB+KkG6(/&/uA=IG0Esx');

/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix  = 'wp_';

/**
 * Idioma de Localização do WordPress, Inglês por omissão.
 *
 * Mude isto para localizar o WordPress. Um ficheiro MO correspondendo ao idioma
 * escolhido deverá existir na directoria wp-content/languages. Instale por exemplo
 * pt_PT.mo em wp-content/languages e defina WPLANG como 'pt_PT' para activar o
 * suporte para a língua portuguesa.
 */
define('WPLANG', 'pt_PT');

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 */
define('WP_DEBUG', false);

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Define as variáveis do WordPress e ficheiros a incluir. */
require_once(ABSPATH . 'wp-settings.php');
