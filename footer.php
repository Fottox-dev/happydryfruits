<?php $theme_options = miti_get_theme_options(); ?>
<div class="clear"></div>
</div><!-- #main .wrapper -->
<div class="clear"></div>
	<?php if( !is_page_template('page-templates/blank-page-template.php') && $theme_options['ts_footer_block'] ): ?>
	<footer id="colophon" class="footer-container footer-area">
		<div class="container">
			<?php miti_get_footer_content( $theme_options['ts_footer_block'] ); ?>
		</div>
	</footer>
	<?php endif; ?>
</div><!-- #page -->

<?php 
if( ( !wp_is_mobile() && $theme_options['ts_back_to_top_button'] ) || ( wp_is_mobile() && $theme_options['ts_back_to_top_button_on_mobile'] ) ): 
?>
<div id="to-top" class="scroll-button">
	<a class="scroll-button" href="javascript:void(0)" title="<?php esc_attr_e('Back to Top', 'miti'); ?>"><?php esc_html_e('Back to Top', 'miti'); ?></a>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>