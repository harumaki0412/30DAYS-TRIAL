<!-- pickup -->
	<div id="pickup">
		<div class="inner">
			<div class="pickup-items">
                <?php
                //条件の設定
                $args = Array(
                    'post_type' => 'post',      // 投稿
                    'post_status' => 'publish', // 公開された投稿、または固定ページを表示(デフォルト)
                    'posts_per_page' => 3,      // 表示する投稿数(-1を指定すると全投稿を表示)
                    'order'   => 'DESC',        // DESCで最新から表示
                    'orderby' => 'modified',    // 更新日でソート
                    'tag'     => 'pickup',      // 表示したいタグのスラッグを指定
                );
                $pickup = get_posts( $args );
                ?>

                <?php foreach ( $pickup as $post ) : ?>
                    <?php setup_postdata( $post ); ?>
                    <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="pickup-item">
                    <div class="pickup-item-img">
                        <?php
                            // 投稿記事に指定idのサムネイルがある場合はサイズ大で表示
                            // ない場合はno-img.pngを表示
                            if ( has_post_thumbnail( $post->ID ) ) {
                                echo get_the_post_thumbnail( $post->ID, 'large' );
                            } else {
                                echo '<img src="' . esc_url( get_template_directory_uri() ) . '/img/noimg.png" alt="">';
                            }
                        ?>
                        <div class="pickup-item-tag"><?php my_the_post_category( false, $post->ID ); ?></div><!-- /pickup-item-tag -->
                    </div><!-- /pickup-item-img -->

                    <div class="pickup-item-body">
                        <h2 class="pickup-item-title"><?php echo esc_html( get_the_title( $post->ID ) ); ?></h2><!-- /pickup-item-title -->
                    </div><!-- /pickup-item-body -->
                    </a><!-- /pickup-item -->
                <?php endforeach; wp_reset_postdata();?>

			</div><!-- /pickup-items -->
		</div><!-- /inner -->
	</div><!-- /pickup -->