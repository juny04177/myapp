import './bootstrap';

// 1. jQueryの設定（Owl Carouselが使うので必須）
import $ from 'jquery';
window.jQuery = window.$ = $;

// 2. LazySizesの設定（読み込むだけで自動動作します）
import 'lazysizes';

// 3. Owl Carouselの設定（JSとCSS）
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

// 動作確認用のテストコード
$(document).ready(function(){
    console.log("jQuery & Owl Carousel 準備完了！");
});