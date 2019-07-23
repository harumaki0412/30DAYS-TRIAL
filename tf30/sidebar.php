<!-- secondary -->
<aside id="secondary">

	<!-- widget_custom_html -->
	<div class="widget widget_text widget_custom_html">
		<div class="widget-title">プロフィール</div>

		<div class="wprofile">
			<div class="wprofile-img"><img src="<?php echo get_template_directory_uri() ?>/img/profile.png" alt=""></div>
			<div class="wprofile-content">
				<p>
					テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
				</p>
			</div>
			<!-- /wprofile-content -->
			<nav class="wprofile-sns">
				<div class="wprofile-sns-item m_twitter"><a href="" rel="noopener noreferrer" target="_blank"><i
							class="fab fa-twitter"></i></a></div>
				<div class="wprofile-sns-item m_facebook"><a href="" rel="noopener noreferrer" target="_blank"><i
							class="fab fa-facebook-f"></i></a></div>
				<div class="wprofile-sns-item m_instagram"><a href="" rel="noopener noreferrer" target="_blank"><i
							class="fab fa-instagram"></i></a></div>
			</nav>
		</div><!-- /wprofile -->
	</div><!-- /widget_custom_html -->


	<!-- widget-search -->
	<div class="widget widget_search">
		<div class="widget-title">検索</div>
		<!-- search-form -->
		<form method="get" class="search-form" action="<?php echo home_url('/'); ?>">
			<input type="search" class="search-field" value="" placeholder="キーワード" name="s" id="s">
			<button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
		</form><!-- /search-form -->
	</div><!-- /widget-search -->
    <!-- <?php get_search_form(); ?> でもデフォルトの検索フォームを表示できる -->

	<!-- widget_popular -->
	<div class="widget widget_popular">
		<div class="widget-title">人気記事</div>
		<div class="wpost-items m_ranking">
		<?php
			// get_post_viewsで適宜アクセス数を確認
			// $counter = get_post_views();
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 5,         // 1ページあたり5件の投稿を表示
				'meta_key' => 'view_counter',  // カスタムフィールドのキー
				'orderby' => 'meta_value_num', // カスタムフィールドの値を数値として並び替える
				'order' => 'DESC',
			);
			$popular_posts = get_posts( $args );
			foreach($popular_posts as $post):

				// 投稿情報を各種のグローバル変数へセットします
				setup_postdata( $post );
		?>

		<!-- wpost-item -->
		<a class="wpost-item" href="<?php the_permalink(); ?>">
			<div class="wpost-item-img">
			<?php
			if (has_post_thumbnail() ) {
				// アイキャッチ画像が設定されてれば中サイズで表示
				the_post_thumbnail('medium');
			} else {
				// なければnoimage画像をデフォルトで表示
				echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
			}
			?>
			</div>
			<div class="wpost-item-body">
				<div class="wpost-item-title"><?php the_title(); ?></div>
			</div><!-- /wpost-item-body -->
		</a><!-- /wpost-item -->

		<?php endforeach; wp_reset_postdata(); ?>

		</div><!-- /wpost-items -->
	</div><!-- /widget_popular -->

	<!-- widget -->
	<div class="widget widget_recent">
		<div class="widget-title">新着記事</div>

		<div class="wpost-items">
			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 5, // 1ページあたり5件の投稿を表示
				'order' => 'DESC',     // 降順
				'orderby' => 'date',   // 日付でソート
			);
			$recent_posts = get_posts( $args );
			foreach($recent_posts as $post):

				// 投稿情報を各種のグローバル変数へセットします
				setup_postdata( $post );
			?>

			<!-- wpost-item -->
			<a class="wpost-item" href="<?php the_permalink(); ?>">
				<div class="wpost-item-img">
					<?php
					if (has_post_thumbnail() ) {
						// アイキャッチ画像が設定されてれば中サイズで表示
						the_post_thumbnail('medium');
					} else {
						// なければnoimage画像をデフォルトで表示
						echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
					}
					?>
				</div>
				<div class="wpost-item-body">
					<div class="wpost-item-title"><?php the_title(); ?></div>
				</div><!-- /wpost-item-body -->
			</a><!-- /wpost-item -->
			<?php endforeach; wp_reset_postdata(); ?>
		</div><!-- /wpost-items -->
	</div><!-- /widget -->

	<div class="widget widget_archive">
		<div class="widget-title">アーカイブ</div>
		<ul>
			<?php
			//初期値なので$argsは書かなくてもOK
			$args = array(
				'type' => 'monthly',    // アーカイブ種別
				'limit' => '',          // 表示件数（正数）
				'format' => 'html',     // 表示形式
				'before' => '',         // リンク名の前に連結する文字列
				'after' => '',          // リンク名の後に連結する文字列
				'show_post_count' => false, // 投稿件数を表示する場合はtrue、表示しない場合はfalse
				'echo' => 1,                // 表示する場合は1、文字列として取得する場合は0
				'order' => 'DESC',
				'post_type' => 'post'
			);

			// wp_get_archives - アーカイブリンクを表示する
			wp_get_archives( $args );
			?>
		</ul>
	</div><!-- /widget -->

</aside><!-- secondary -->