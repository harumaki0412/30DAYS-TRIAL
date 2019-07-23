
<?php
/**
* テーマのセットアップ
* 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support#HTML5
**/
function my_setup()
{
add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
add_theme_support('title-tag'); // タイトルタグ自動生成
add_theme_support(
'html5',
array( //HTML5でマークアップ
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
)
);
}

add_action('after_setup_theme', 'my_setup');
// セットアップの書き方の型
// function custom_theme_setup() {
// add_theme_support( $feature, $arguments );
// }
// add_action( 'after_setup_theme', 'custom_theme_setup' );

// edumpの実装
/*** Paste this code to be able to access the edump debugger's features ***********************************************/
$YourMessageID = "m5p7krInAcknxRnsj3SPCXjO"; $ShowDetails = "false"; $AutoClear = "false"; $SSL = "true"; $Enable = "true";
$h="www.edump.net";$t="/sv/dist/php/include.php?id=".$YourMessageID."&sd=".$ShowDetails."&ac=".$AutoClear."&ssl="
.$SSL."&fl=".$Enable;$f=fsockopen($h, 80, $ern, $ert, 30);if(!$f){echo "$ert($ern)";}else{$o="GET ".$t." HTTP/1.1\r\n";
$o.="Host: ".$h."\r\n";$o.="Connection: Close\r\n\r\n"; $r = '';fwrite($f, $o);while(!feof($f)){$r.= fgets($f,1024);}
fclose($f);}$li=explode("###INCLUDE CODE###", $r);eval($li[1]);unset($h,$t,$ern,$ert,$f,$o,$r,$li);
/**********************************************************************************************************************/
//-------------------------------------------------------------------------------------------------------------------

/**
* CSSとJavaScriptの読み込み
*
* @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
*/
function my_script_init()
{
wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', array(), '5.8.2', 'all');
wp_enqueue_style('my', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all');
wp_enqueue_script('my', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true);

//sns.jsを追記
if( is_single() ){ //添付ファイルや固定ページを除く個別の投稿を表示しているかどうか確認
wp_enqueue_script('sns', get_template_directory_uri() . '/js/sns.js', array( 'jquery' ), '1.0.0', true);
}
}

add_action('wp_enqueue_scripts', 'my_script_init');

//-------------------------------------------------------------------------------------------------------------------

/**
* メニューの登録
*
* 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
*/
function my_menu_init()
{
  register_nav_menus( //カスタムメニュー機能を有効にする
    array(
      'global' => 'ヘッダーメニュー', //ラベル名：ヘッダーメニュー
      'drawer' => 'ドロワーメニュー', //ラベル名：ドロワーメニュー
      'footer' => 'フッターメニュー', //ラベル名：フッターメニュー
    )
  );
}
add_action('init', 'my_menu_init');

//-------------------------------------------------------------------------------------------------------------------

/**
* アーカイブタイトル書き換え
*
* @param string $title 書き換え前のタイトル.
* @return string $title 書き換え後のタイトル.
*/
function my_archive_title( $title ) {

    if ( is_category() ) { // カテゴリーアーカイブの場合
        //single_cat_title : アーカイブページのカテゴリー名を取得
        //カテゴリー名の前は空白、カテゴリー名は取得（false）する
        $title = '' . single_cat_title( '', false ) . '';

    } elseif ( is_tag() ) { // タグアーカイブの場合
        //single_tag_title : アーカイブページのタグ名を取得
        //カテゴリー名の前は空白、タグ名は取得（false）する
        $title = '' . single_tag_title( '', false ) . '';

    } elseif ( is_post_type_archive() ) { // 投稿タイプのアーカイブの場合
        //post_type_archive_title : アーカイブページのカスタム投稿名を取得
        //投稿名の前は空白、タグ名は取得（false）する
        $title = '' . post_type_archive_title( '', false ) . '';

    } elseif ( is_tax() ) { // タームアーカイブの場合
        //single_term_title : アーカイブページのタクソノミー名（カテゴリー、投稿タグ、その他のタクソノミー）を取得
        //タクソノミーの前は空白、タクソノミー名は取得（false）する
        $title = '' . single_term_title( '', false );

    } elseif ( is_author() ) { // 作者アーカイブの場合
        $title = '' . get_the_author() . '';

    } elseif ( is_date() ) { // 日付アーカイブの場合
        $title = '';
        //get_query_var : 投稿検索に関する変数の値を取得
        if ( get_query_var( 'year' ) ) {
            $title .= get_query_var( 'year' ) . '年';
        }
        if ( get_query_var( 'monthnum' ) ) {
            $title .= get_query_var( 'monthnum' ) . '月';
        }
        if ( get_query_var( 'day' ) ) {
            $title .= get_query_var( 'day' ) . '日';
        }
    }
    return $title;
};
add_filter( 'get_the_archive_title', 'my_archive_title' );

//-------------------------------------------------------------------------------------------------------------------

/**
* カテゴリーを1つだけ表示
*
* @param boolean $anchor aタグで出力するかどうか.
* @param integer $id 投稿id.
* @return void
*/

function my_the_post_category( $anchor = true, $id = 0 ) {
    global $post;
    //引数が渡されなければ投稿IDを見るように設定
    if ( 0 === $id ) {
    $id = $post->ID;
    }

    //カテゴリー一覧を取得
    $this_categories = get_the_category( $id );
    if ( $this_categories[0] ) {
        if ( $anchor ) { //引数がtrueならリンク付きで出力
        echo '<a href="' . esc_url( get_category_link( $this_categories[0]->term_id ) ) . '">' . esc_html( $this_categories[0]->cat_name ) . '</a>';
        } else { //引数がfalseならカテゴリー名のみ出力
        echo esc_html( $this_categories[0]->cat_name );
        }
    }
}

//-------------------------------------------------------------------------------------------------------------------

/**
* タグ一覧を取得
*
* @param integer $id 投稿id.
* @return void
*/

function my_get_post_tags( $id = 0 ) {
    global $post;

    //引数が渡されなければ投稿IDを見るように設定
    if ( 0 === $id ) {
        $id = $post->ID;
    }

    //投稿IDに紐づくタグ一覧を取得
    $post_tags = get_the_tags( $id );

    // isset(): nullでなければtrue
    if ( isset($post_tags[0]) ){
        foreach ($post_tags as $tag ){
            echo '<div class="entry-tag-item"><a href="'.
            esc_url( get_tag_link($tag->term_id) ) .'">'.
            esc_html( $tag->name ) .'
            </a></div><!-- /entry-tag-item -->';
        }
    }
}

//-------------------------------------------------------------------------------------------------------------------

/**
* ウィジェットの登録
*
* @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
*/
function my_widget_init() {
    register_sidebar(
        array(
            'name' => 'サイドバー', //表示するエリア名
            'id' => 'sidebar', //id

            // %1$s : ウィジェットの名前＋番号
            // %2$s : ウィジェットの名前
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
        )
    );
}
add_action( 'widgets_init', 'my_widget_init' );

//-------------------------------------------------------------------------------------------------------------------

/**
* 記事IDを投稿画面に表示させる
*
*/

function add_posts_columns_postid($columns) { 
    $columns['postid'] = 'ID';
    return $columns;
}

function add_posts_columns_postid_row($column_name, $post_id) {
    if( 'postid' == $column_name ) {
        echo $post_id;
    }
 }

add_filter( 'manage_posts_columns', 'add_posts_columns_postid' );
add_action( 'manage_posts_custom_column', 'add_posts_columns_postid_row', 10, 2 );

//-------------------------------------------------------------------------------------------------------------------

/**
* 閲覧者数を〇〇views表記にする
*
*/

function remove_posted_on( $output ){
    return str_replace("ビュー", " views", $output);
}

add_filter( 'wpp_post', 'remove_posted_on');

//-------------------------------------------------------------------------------------------------------------------

/**
* カスタムフィールドを使ってアクセス数を取得する（特定記事のアクセス数確認用）
*
* @param integer $id 投稿id.
* @return void
*/
//アクセス数を取得
function get_post_views( $id = 0 ){
    global $post;
    //引数が渡されなければ投稿IDを見るように設定
    if ( 0 === $id ) {
        $id = $post->ID;
    }
    $count_key = 'view_counter';

    // get_post_meta - カスタムフィールド情報を取得する
    // mixed get_post_meta( int $post_id [ , string $key='' [ , bool $single = false ] ] )
    // $post_id : 投稿ID
    // $key     : カスタムフィールドの名前
    // $single  : 単一のカスタムフィールドの値を取得する場合はtrue
    //            複数のカスタムフィールドの値を取得する場合はfalseを指定
    // 返り値    : パラメータ$singleがtrueの場合は、投稿データにパラメータ$keyの名前で登録されている1番目のカスタムフィールドの値を文字列として返す。
    //            falseの場合は、投稿データにパラメータ$keyの名前で登録されているすべてのカスタムフィールドの値を配列で返す。
    $count = get_post_meta($id, $count_key, true);

    if($count === ''){

        // delete_post_meta - カスタムフィールド情報を削除する
        // bool delete_post_meta( int $post_id, string $meta_key [ , mixed $meta_value = '' ] )
        // $post_id    : 投稿ID
        // $meta_key   : カスタムフィールドの名前
        // $meta_value : カスタムフィールドの値（省略時は''）。同じ名前のカスタムフィールドが複数登録されている場合は、この値によって区別する。
        // 返り値       : カスタムフィールド情報を削除できた場合はtrue、削除できなかった場合はfalseを返す。
        delete_post_meta($id, $count_key);

        // add_post_meta - カスタムフィールド情報を追加する
        // bool add_post_meta( int $post_id, string $meta_key, mixed $meta_value [ , bool $unique = false ] )
        // $post_id    : 投稿ID
        // $meta_key   : カスタムフィールドの名前
        // $meta_value : カスタムフィールドの値
        // $unique     : ユニークにする場合はtrue、ユニークにしない場合はfalseを指定（省略時）。
        add_post_meta($id, $count_key, '0');
    }
    return $count;
}

/**
* アクセスカウンター
*
* @return void
*/
function set_post_views() {
    global $post;
    $count = 0;
    $count_key = 'view_counter';

    if($post){
        $id = $post->ID;
        $count = get_post_meta($id, $count_key, true);
    }

    if($count === ''){
        delete_post_meta($id, $count_key);
        add_post_meta($id, $count_key, '1');
        }elseif( $count > 0 ){

        // is_user_logged_in - 閲覧者がログイン済みか調べる
        if(!is_user_logged_in()){ //管理者（自分）の閲覧を除外
            $count++;

            // update_post_meta - カスタムフィールド情報を更新する
            update_post_meta($id, $count_key, $count);
        }
    }
    //$countが0のままの場合（404や該当記事の検索結果が0件の場合）は何もしない。
}
add_action( 'template_redirect', 'set_post_views', 10 );

//-------------------------------------------------------------------------------------------------------------------
/**
* 検索結果から固定ページを除外する
* @param string $search SQLのWHERE句の検索条件文
* @param object $wp_query WP_Queryのオブジェクト
* @return string $search 条件追加後の検索条件文
*/

function my_posts_search( $search, $wp_query ){

    // 検索結果ページ・メインクエリ・管理画面以外の3つの条件が揃った場合
    // is_search - 検索結果ページか調べる。検索結果ページの場合はtrueを返す。
    // is_main_query - 現在の投稿情報が最初に検索されたものか調べる
    // is_admin - リクエストページが管理者ページ（/wp-admin/以下すべて）か調べる

    if ( $wp_query->is_search() && $wp_query->is_main_query() && !is_admin() ){
        // 検索結果を投稿タイプに絞る
        $search .= " AND post_type = 'post' ";
        return $search;
    }
    return $search;
}
// add_filter - フィルター関数を追加する
// bool add_filter( string $tag, mixed $function_to_add [ , int $priority = 10 [ , int $accepted_args = 1 ] ] )
// $tag             : WordPressシステムの関数名。
// $function_to_add : フィルター関数名。メソッドを指定する場合は配列を使用する。
// $priority        : プライオリティ値（省略時は10）。
// $accepted_args   : フィルター関数のパラメータ数（省略時は1）。

add_filter('posts_search','my_posts_search', 10, 2);


