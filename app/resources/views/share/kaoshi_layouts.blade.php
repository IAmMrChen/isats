<!DOCTYPE html>
<html>
<style>
  [v-cloak]{
      display:none
  }
</style>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>ISATS-@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{ getenv('HTML_WEB') }}/css/hzstyle.css?v={{ getenv('VIEW_VERSION') }}" />
	<link rel="stylesheet" type="text/css" href="{{ getenv('JS_LIBS') }}/element-ui@2.4.6/index.css" />

  <style type="text/css">
  </style>
</head>
<body>
	<div class="top">
  	<div class="head">
  		<div class="logo">
        <a href="index.html">
          <img src="{{ getenv('HTML_WEB') }}/images/logo.png"/>
        </a>
      </div>
      <div class="header">
      	<img src="{{ getenv('HTML_WEB') }}/images/header.jpg" />
        <span>Emirates</span>
      </div>
    </div>
  </div>
  <div class="main">
  	<div class="con">
      <div class="title" id="title">
      	<p class="tit">ISATS TEST</p>
        <!-- <p class="type">Mathematics</p> -->
        <p class="type"><span v-cloak style="margin-left: -95px;">@{{ current_type }}<span style="margin-left: 10px; font-size: 20px;" v-if="remain_time_m >= 0">(Remaining time: @{{ remain_time_m }}m @{{ remain_time_s }}s)</span></span></p>
        <!-- <p class="exit"><a href="#">Exit</a><img src="{{ getenv('HTML_WEB') }}/images/exit_img.png" class="exit_img" /></p> -->
      	<p class="exit">
          <a v-show="total_question">
            <span style="font-size: 25px; margin-right: -5px;">@{{ currrent_question }}</span>
            <span>/</span>
            <span style="font-size: 20px; margin-left: -5px;">@{{ total_question }}</span>
          </a>
        </p>
      </div>
      <!-- <div class="con">
      <div class="title">
        <p class="tit">ISATS TEST</p>
        <p class="exit"><a href="#">Exit</a><img src="images/exit_img.png" class="exit_img" /></p>
      </div> -->

      <div class="content container" id="container_body" v-cloak unselectable="on" style="-moz-user-select:none;" onselectstart="return false;">
          @yield('content')
      </div>
      <div class="footer" unselectable="on" style="-moz-user-select:none;" onselectstart="return false;">
        <!-- <p>Copyright © 2018 中澳时代（厦门）教育咨询有限公司 | 隐私声明 | 用户协议 | 闽ICP备11456789号 </p> -->
      	<p>Copyright © 2018 | 隐私声明 | 用户协议 | 闽ICP备11456789号 </p>
      </div>
    </div>
  </div>

  @component('share.require_js')
  @endcomponent

  <script type="text/javascript">
    var content_value = {
      current_type: '',
      remain_time_m: -1,
      remain_time_s: 0,
      total_question: '',
      currrent_question: 1,
    };

    require(['JQuery', 'vue'], function ($, vue) {
      (function ($) {
        var vm = new vue({
          data: content_value,
          el: "#title",
          methods: {
          },
          created: function () {
          },
          mounted: function () {
          }
        });
      })(jQuery);
    });

    /**
     * 动态加载JS
     * @param {string} url 脚本地址
     * @param {function} callback  回调函数
     */
    function dynamicLoadJs(url, callback) {
      var head = document.getElementsByTagName('head')[0];
      var script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = url;
      if(typeof(callback)=='function'){
          script.onload = script.onreadystatechange = function () {
              if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete"){
                  callback();
                  script.onload = script.onreadystatechange = null;
              }
          };
      }
      head.appendChild(script);
    }

  </script>

  @yield('script')
</body>
</html>
