$(function () { //readyイベント省略 HTMLの読み込み後にjQueryを実行する
    //初期化
    $('.faq-answer').hide();

    // ---------------------------- Q&A ----------------------------
    // Q&Aのアコーディオン
    $('.faq-list__item').click(function () { //faq-list__itemクラスのクリック時の処理
        var $faq_answer = $(this).find('.faq-answer'); //クリックしたfaq-answerクラスを特定

        if ($faq_answer.hasClass('open')) { //クリックしたfaq-answerクラスにopenクラス（フラグ）がある？

            //Answerを非表示にする処理
            $faq_answer.removeClass('open'); //openクラスを削除
            $faq_answer.slideUp(); //faq-answerクラスを非表示
            $(this).find('.faq-question__btn--img').attr('src', '/img/plus.svg'); //開閉ボタンを「＋」に変更

        } else {

            //Answerを表示する処理
            $faq_answer.addClass('open'); //openクラスを追加
            $faq_answer.slideDown(); //faq_answerクラスを表示
            $(this).find('.faq-question__btn--img').attr('src', '/img/minus.svg'); //開閉ボタンを「−」に変更
        }
    });
});