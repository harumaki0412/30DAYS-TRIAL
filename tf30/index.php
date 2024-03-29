<!-- header-navまでをget_header()に置き換える -->
<?php get_header(); ?>

    <!-- pickup -->
    <?php get_template_part('template-parts/pickup'); ?>

	<!-- content -->
	<div id="content">
		<div class="inner">

			<!-- primary -->
			<main id="primary">

                <!-- entryを置き換える -->
                <?php
                //記事があればentriesブロック以下を表示
                if (have_posts()):?>

                    <!-- entries -->
                    <div class="entries">
                    <?php
                    //記事文ループ
                    while(have_posts()):
                        the_post(); ?>

                    <!-- entry-item -->
                    <a href="<?php the_permalink(); //記事のリンクを表示 ?>" class="entry-item">

                        <!-- entry-item-img -->
                        <div class="entry-item-img">
                            <?php
                                if (has_post_thumbnail()){
                                    // アイキャッチ画像が設定されてれば大サイズで表示
                                    the_post_thumbnail('large');
                                }else {
                                    // なければnoimage画像をデフォルトで表示
                                    echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
                                }
                            ?>
                        </div><!-- /entry-item-img -->

                        <!-- entry-item-body -->
                        <div class="entry-item-body">
                            <div class="entry-item-meta">

                                <!-- カテゴリー1つ目の名前を表示 -->
                                <!-- trueを引数として渡すとリンク付き、falseを渡すとリンクなし -->
                                <div class="entry-item-tag"><?php my_the_post_category( false ); ?></div><!-- /entry-item-tag -->

                                <!-- 公開日時を動的に表示する -->
                                <time class="entry-item-published" datetime="<?php the_time('c'); ?>"> <!-- 全ての日付/時刻 -->
                                <?php the_time('Y/n/j'); ?></time><!-- /entry-item-published -->
                            </div><!-- /entry-item-meta -->

                            <h2 class="entry-item-title"><?php the_title(); //タイトルを表示 ?></h2><!-- /entry-item-title -->
                            <div class="entry-item-excerpt">
                                <?php the_excerpt(); //抜粋を表示 ?>
                            </div><!-- /entry-item-excerpt -->
                        </div><!-- /entry-item-body -->
                    </a><!-- /entry-item -->

                    <?php endwhile; ?>
                    </div><!-- /entries -->
                <?php endif; ?>

                <!-- pagenation.phpの読み込み -->
                <?php get_template_part('template-parts/pagenation'); ?>

			</main><!-- /primary -->

            <!-- secondaryから下をget_sidebar()に置き換える -->
            <?php get_sidebar(); ?>

		</div><!-- /inner -->
    </div><!-- /content -->

<!-- footer-menuから下をget_footer()に置き換える -->
<?php get_footer(); ?>