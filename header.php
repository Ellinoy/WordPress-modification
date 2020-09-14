<?php
/**
 * ****************************************************************************
 *
 *   НЕ РЕДАКТИРУЙТЕ ЭТОТ ФАЙЛ
 *   DON'T EDIT THIS FILE
 *
 *   После обновления Вы потереяете все изменения. Используйте дочернюю тему
 *   After update you will lose all changes. Use child theme
 *
 *   https://docs.wpshop.ru/start/child-themes
 *
 * *****************************************************************************
 *
 * @package reboot
 */

// здесь мы взяли стандартный header и модифицировали его небольшим кусочкам кода, к которому будет стоять комментарий


global $wpshop_core;
global $class_advertising;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
    <?php $wpshop_core->the_option( 'code_head' ) ?>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(61845325, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/61845325" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
	</head>

<body <?php body_class(); ?>>
	<!-- Rating Mail.ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "3171000", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = "https://top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="https://top-fwz1.mail.ru/counter?id=3171000;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" />
</div></noscript>
<!-- //Rating Mail.ru counter -->
<?php $wpshop_core->check_license() ?>

<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
} ?>

<?php do_action( THEME_SLUG . '_after_body' ) ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', THEME_TEXTDOMAIN ); ?></a>

    <div class="search-screen-overlay js-search-screen-overlay"></div>
    <div class="search-screen js-search-screen">
        <?php get_search_form() ?>
    </div>

    <?php
    if ( $wpshop_core->is_show_element( 'header' ) ) {
        get_template_part( 'template-parts/header/header' );
    } ?>

    <?php get_template_part( 'template-parts/navigation/header' ) ?>

    <?php do_action( THEME_SLUG . '_before_site_content' ) ?>
	
	<?php  						 //вот этот участок кода был дописан, чтобы вызвать созданный файл с таблицей и данными с другого сайта
	if ( is_front_page() || is_home() ) {
		require_once("turkish.php");
	echo write_results();
	}
	?>

	<?php
	if ( is_front_page() || is_home() ) {
		$is_show_slider_on_paged = $wpshop_core->get_option( 'slider_show_on_paged' );
		if ( ! is_paged() || ( $is_show_slider_on_paged && is_paged() ) ) {
		    if ( $wpshop_core->get_option( 'slider_width' ) == 'fixed') echo '<div class="container">';
			get_template_part( 'template-parts/slider', 'posts' );
			if ( $wpshop_core->get_option( 'slider_width' ) == 'fixed') echo '</div>';
		}
	}
	?>

    <div id="content" class="site-content <?php echo apply_filters( THEME_SLUG . '_site_content_classes', 'fixed' ) ?>">

        <?php echo $class_advertising->show_ad( 'before_site_content' ) ?>

        <div class="site-content-inner">
