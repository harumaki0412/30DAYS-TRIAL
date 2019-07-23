<!-- secondary -->
<aside id="secondary">
	<?php if ( is_active_sidebar( 'sidebar' ) ) : // ダイナミックサイドバーが有効か ?>
	<?php dynamic_sidebar( 'sidebar' ); // ダイナミックサイドバーを表示?>
	<?php endif; ?>
</aside><!-- secondary -->