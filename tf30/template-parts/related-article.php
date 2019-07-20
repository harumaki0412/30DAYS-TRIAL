<?php
$categories = get_the_category($post->ID); // 現在の記事のカテゴリー配列を取得
$category_ID = array(); // カテゴリIDをセットする配列を定義

// カテゴリIDのみを配列に格納
foreach($categories as $category):
    array_push( $category_ID, $category -> cat_ID);
endforeach ;

//条件の設定
$args = Array(
    'post_type' => 'post',      // 投稿
    'post_status' => 'publish', // 公開された投稿、または固定ページを表示(デフォルト)
    'posts_per_page' => 8,      // 表示する投稿数(-1を指定すると全投稿を表示)
    'orderby' => 'rand',         // ランダムの順番
    'post__not_in' => array($post -> ID), // 現在の投稿記事は対象外
    'category__in' => $category_ID
);
// クエリの定義
$query = new WP_Query( $args );

// 投稿記事分ループ
if( $query -> have_posts() ):
    while ($query -> have_posts()) :
            $query -> the_post();
?>

    <a class="related-item" href="<?php the_permalink(); ?>">
        <div class="related-item-img">
            <?php
            //アイキャッチ画像が設定されていればtrue
            if(has_post_thumbnail()){
                //アイキャッチ画像をサイズ中で表示
                the_post_thumbnail("medium");
            }else{
                //なければnoimage画像をデフォルトで表示
                //esc_url : ホワイトリストに登録されているプロトコル以外を拒否し、使用不可な文字を省く
                //get_template_directory_uri :テーマディレクトリのパスを返す
                echo '<img src="'.esc_url(get_template_directory_uri()).'/img/noimg.png" alt="">';
            }
            ?>
        </div><!-- /related-item-img -->
        <div class="related-item-title"><?php the_title(); //タイトルを表示 ?></div><!-- /related-item-title -->
    </a><!-- /related-item -->
<?php endwhile; endif;?>
<?php wp_reset_postdata(); ?>
