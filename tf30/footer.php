	<!-- footer-menu -->
	<div id="footer-menu">
		<div class="inner">
			<!--
            <div class="footer-logo"><a href="/">TF-30</a></div>
            <div class="footer-sub">サブタイトルが入りますサブタイトルが入ります</div>
            ここを動的に置き換える
            -->
            <?php if (is_home() || is_front_page() ) : //トップページではロゴをh1に、それ以外のページではdivに。 ?>
              <!-- esc_url          : URLをエスケープ（セキュリティ的に問題のない文字に加工）した文字を返す
                   home_url('/')    : トップページのURLに「/」を付加
                   bloginfo('name') : サイトのタイトル
                   bloginfo('description') : サイトのキャッチフレーズ
                -->
            <h1 class="footer-logo"><a href="<?php echo esc_url(home_url('/'));?>">　
              <?php bloginfo('name'); ?></a></h1><!-- /footer-logo -->
            <?php else : ?>
              <div class="footer-logo"><a href="<?php echo esc_url(home_url('/')); ?>">
              <?php bloginfo('name'); ?></a></><!-- /footer-logo -->
            <?php endif; ?>
            <div class="footer-sub"><?php bloginfo('description'); //ブログのdescriptionを表示 ?></div><!-- /footer-sub -->

			<!-- <nav class="footer-nav">
				<ul class="footer-list">
					<li class="menu-item"><a href="#">メニュー1</a></li>
					<li class="menu-item"><a href="#">メニュー2</a></li>
					<li class="menu-item"><a href="#">メニュー3</a></li>
					<li class="menu-item"><a href="#">メニュー4</a></li>
					<li class="menu-item"><a href="#">メニュー5</a></li>
				</ul>
            </nav> -->
            <?php
                //.footer-navを置き換えて、スマホ用メニューを動的に表示する
                // container : ナビゲーションメニューを囲むタグ名を指定
                // depth     : 階層数を指定（0はすべてを表示、1ならばメニューバーのみ）
                // theme_location  : テーマ内のロケーションIDを指定
                // container_class : ナビゲーションメニューを囲むタグのクラス名を指定
                // menu_class      : ナビゲーションメニューを囲むタグのクラス名を指定
            wp_nav_menu(
                array(
                    'depth' => 1,
                    'theme_location' => 'footer', //フッターメニューをここに表示すると指定
                    'container' => 'nav',
                    'container_class' => 'footer-nav',
                    'menu_class' => 'footer-list',
                )
                );
            ?>

		</div><!-- /inner -->
	</div><!-- /footer-menu -->

	<!-- footer -->
	<footer id="footer">
		<div class="inner">
			<div class="copy">&copy; daily-trial WordPress theme All rights reserved.</div><!-- /copy -->
			<div class="by">Presented by <a href="https://tokyofreelance.jp/" rel="noopener" target="_blank">東京フリーランス</a>
			</div><!-- /by -->
		</div><!-- /inner -->
	</footer><!-- /footer -->

    <!-- ここからが追記部分 -->
    <?php if(is_single()): ?>
      <?php get_template_part('template-parts/share-btn'); ?>
    <?php endif; ?>

	<div class="floating">
		<a href="#"><i class="fas fa-chevron-up"></i></a>
	</div>

	<!--
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/script.js"></script>
    ここを置き換える。jqueryはWPデフォで読み込まれるので消してOK。
    -->
    <?php wp_footer(); ?>
</body>

</html>