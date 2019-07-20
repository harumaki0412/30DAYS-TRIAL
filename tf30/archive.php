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

                <div class="archive-head m_description">
                    <div class="archive-lead">ARCHIVE</div>
                    <h1 class="archive-title m_category"><?php the_archive_title(); //一覧ページ名を表示 ?></h1><!-- /archive-title -->
                    <div class="archive-description">
                        <p><?php the_archive_description(); //説明を表示 ?></p>
                    </div><!-- /archive-description -->
                </div><!-- /archive-head -->

                <?php
                //記事があればentriesブロック以下を表示
                //have_posts() : 投稿記事があればtrueを返す
                if(have_posts()): ?>

				<!-- entries -->
				<div class="entries m_horizontal">
                <?php

                    //記事がある間、記事表示を続ける
                    while(have_posts()):
                        the_post(); ?>

                        <!-- entry-item -->
                        <!-- the_permalink() : ループの中で処理されている投稿のパーマリンクのURLを表示 -->
                        <a href="<?php the_permalink(); ?>" class="entry-item">

                            <!-- entry-item-img -->
                            <div class="entry-item-img">
                                <?php
                                //アイキャッチ画像が設定されていればtrue
                                if(has_post_thumbnail()){
                                    //アイキャッチ画像をサイズ大で表示
                                    the_post_thumbnail("large");
                                }else{
                                    //なければnoimage画像をデフォルトで表示
                                    //esc_url : ホワイトリストに登録されているプロトコル以外を拒否し、使用不可な文字を省く
                                    //get_template_directory_uri :テーマディレクトリのパスを返す
                                    echo '<img src="'.esc_url(get_template_directory_uri()).'/img/noimg.png" alt="">';
                                }
                                ?>
                            </div><!-- /entry-item-img -->

                            <!-- entry-item-body -->
                            <div class="entry-item-body">
                                <div class="entry-item-meta">
                                    <?php
                                    //カテゴリー1つ目の名前を表示
                                    //get_the_category() : 現在の投稿が属するカテゴリーの情報をオブジェクトの配列で返す
                                    $category = get_the_category();

                                    //カテゴリー情報１件目があれば処理する
                                    if($category[0]){
                                        echo '<div class="entry-item-tag">'.$category[0]->cat_name.'</div><!-- /entry-item-tag -->';
                                    }
                                    ?>
                                    <!-- 公開日時を動的に表示する -->
                                    <time class="entry-item-published" datetime="<?php the_time("c");?>"><?php the_time("Y/n/j");?></time><!-- /entry-item-published -->
                                </div><!-- /entry-item-meta -->

                                <h2 class="entry-item-title"><?php the_title(); //タイトルを表示 ?></h2><!-- /entry-item-title -->
                                <div class="entry-item-excerpt">
                                    <?php the_excerpt()//抜粋を表示 ?>
                                </div><!-- /entry-item-excerpt -->
                            </div><!-- /entry-item-body -->
                        </a><!-- /entry-item -->
                    <?php endwhile; ?>
                </div><!-- /entries m_horizontal-->
                <?php endif ?>

                <!-- pagenation.phpの読み込み -->
                <?php get_template_part('template-parts/pagenation'); ?>

			</main><!-- /primary -->

			<!-- secondary -->
			<!-- secondaryから下をget_sidebar()に置き換える -->
            <?php get_sidebar(); ?>

		</div><!-- /inner -->
	</div><!-- /content -->

<!-- footer-menuから下をget_footer()に置き換える -->
<?php get_footer(); ?>