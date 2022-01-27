<?php 
get_header();

$theme_options = miti_get_theme_options();

$image_404 = $theme_options['ts_image_not_found'];
$image_404 = !empty($image_404['url'])?$image_404['url']:'';

$classes = array();
$classes[] = ($theme_options['ts_device_hide_image'])?'hide-image-device':'';
$classes[] = 'show_breadcrumb_' . $theme_options['ts_breadcrumb_layout'];

miti_breadcrumbs_title(true, false, '');
?>
	<div class="page-container <?php echo esc_attr(implode(' ', $classes)); ?>">
		<div id="main-content">	
			<div id="primary" class="site-content">
				<article>
					<div class="not-found">
						<div class="content-404 <?php echo ('' != $image_404)?'ts-col-12':'ts-col-24'; ?>">
							<h1><?php esc_html_e('404', 'miti'); ?></h1>
							<h5><?php esc_html_e('This page has been probably moved somewhere...', 'miti'); ?></h5>
							<p><?php esc_html_e('Please back to homepage or check our offer', 'miti'); ?></p>
							<a href="<?php echo esc_url( home_url('/') ) ?>" class="button"><?php esc_html_e('Back to homepage', 'miti'); ?></a>
						</div>
						
						<?php if( $image_404 ): ?>
							<div class="image-404 ts-col-12">
								<img src="<?php echo esc_url($image_404); ?>" alt="<?php esc_attr_e('404 image', 'miti'); ?>" />
							</div>
						<?php endif; ?>
					</div>
					<?php miti_new_arrival_products(); ?>
				</article>
			</div>
		</div>
	</div>
<?php
get_footer();