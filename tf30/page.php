<!-- header-navまでをget_header()に置き換える -->
<?php get_header(); ?>

	<!-- content -->
	<div id="content">
		<div class="inner">

			<!-- primary -->
			<main id="primary">

                <?php if( function_exists('bcn_display')): //関数bcn_displayが定義されている場合 ?>
                    <!-- パンくずリストの表示 -->
                    <!-- breadcrumb -->
                    <div class="breadcrumb">
                        <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
                    </div><!-- /breadcrumb -->
                <?php endif ?>

                <?php
                //記事があればentriesブロック以下を表示
                //have_posts() : 投稿記事があればtrueを返す
                if(have_posts()):
                    //記事がある間、記事表示を続ける
                    while(have_posts()):
                        the_post(); ?>

                        <!-- entry -->
                        <article class="entry">

                        <!-- entry-header -->
                        <div class="entry-header">
                            <?php
                            //カテゴリー1つ目の名前を表示
                            //get_the_category() : 現在の投稿が属するカテゴリーの情報をオブジェクトの配列で返す
                            $category = get_the_category();

                            //カテゴリー情報１件目があれば処理する
                            if($category[0]): ?>
                            <div class="entry-label"><a href="<?php esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo $category[0]->cat_name; ?></a></div><!-- /entry-item-tag -->
                            <?php endif?>
                            <!-- <div class="entry-label"><a href="#">カテゴリ名</a></div> -->

                            <h1 class="entry-title"><?php the_title(); //タイトルを表示 ?></h1><!-- /entry-title -->
                            <!-- <h1 class="entry-title">記事のタイトルが入ります記事のタイトルが入ります記事のタイトルが入ります<h1> -->

                            <!-- entry-meta -->
                            <div class="entry-meta">
                                 <!-- 公開日時を動的に表示する -->
                                <time class="entry-published" datetime="<?php the_time('c');?>">公開日 <?php the_time('Y/n/j');?></time><!-- /entry-item-published -->

                                <!-- 最終更新時刻を動的に表示する -->
                                <!-- get_the_modified_time() : 現在の投稿の最終更新時刻を取得 -->
                                <!-- get_the_time() : 投稿時刻を取得 -->
                                <?php if ( get_the_modified_time( 'Y-m-d' ) !== get_the_time( 'Y-m-d' ) ) : ?>
                                <time class="entry-updated" datetime="<?php the_modified_time( 'c' ); ?>">最終更新日 <?php the_modified_time( 'Y/n/j' ); ?></time>
                                <?php endif; ?>

                            </div><!-- /entry-meta -->

                            <!-- entry-img -->
                            <div class="entry-img">
                                <!-- has_post_thumbnail() : 投稿記事にアイキャッチ画像が指定されているか調べる -->
                                <?php if(has_post_thumbnail()){
                                    the_post_thumbnail('large');
                                }
                                ?>
                            </div><!-- /entry-img -->
                        </div><!-- /entry-header -->

                        <!-- entry-body -->
                        <div class="entry-body">
                            <?php
                            //本文の表示
                            the_content(); ?>
                            <?php
                            //改ページを有効にするための記述
                            //wp_link_pages : ページ分割された投稿（<!--nextpage-->を1つ以上含む）についてページリンクを表示する
                            // 'before' : リンクの前のテキスト
                            // 'after'  : リンクの後のテキスト
                            // 'link before : リンクテキストの前のテキスト
                            // 'link_after  : リンクテキストの後のテキスト
                            // 'next_or_number : ページ番号を使用するかどうかを指定する
                            // 'separetor'     : ページ番号の間のテキスト
                                wp_link_pages(
                                    array(
                                    'before' => '<nav class="entry-links">',
                                    'after' => '</nav>',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'next_or_number' => 'number',
                                    'separator' => '',
                                    )
                                );
                            ?>
                        </div><!-- /entry-body -->
                </article> <!-- /entry -->
                <?php endwhile; endif;?>
			</main><!-- /primary -->
		</div><!-- /inner -->
	</div><!-- /content -->

<!-- footer-menuから下をget_footer()に置き換える -->
<?php get_footer(); ?>