<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>中澳（成人）在线测试</title>
	<link rel="stylesheet" type="text/css" href="{{ getenv('HTML_WEB') }}/css/hzstyle.css?v={{ getenv('VIEW_VERSION') }}" />
  <link rel="stylesheet" type="text/css" href="{{ getenv('JS_LIBS') }}/element-ui@2.4.6/index.css" />
</head>
<style type="text/css">
  [v-cloak]{
    display:none
  }
</style>
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
  <div class="main" id="main">
  	<div class="con">
      <div class="title">
      	<p class="tit">ISATS TEST</p>
        <p class="exit" style="width: 960px;"></p>
      	<!-- <p class="exit"><a href="#">Exit</a><img src="images/exit_img.png" class="exit_img" /></p> -->
      </div>
      <div v-cloak class="content" style="min-height: 0px;" v-for="(item, index) in value.examination_data.Mathematics">
        <span v-if="index == 0" class="title-type">Mathematics</span>
        <span v-if="item.length > 1" class="txt" style="font-size: 18px; font-weight: bold;" v-html="item[0].subject_cat.cat_content"></span>
              
        <div v-for="(temp, subject_index) in item">
          <span class="txt" style="font-size: 16px; font-weight: bold; padding: 3px 50px 10px 50px;" v-html="temp.subject.subject_content"></span>

          <div class="sel" v-if="temp.subject_type == 2">
            <textarea v-model="temp.user_answer" style="width: 30%;display: block;float: left;height: 100px;"></textarea>
          </div>

          <el-radio-group v-if="temp.subject_type == 1" v-model="temp.user_answer" class="sel" disabled >
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject.subject_detail" :label="subject_detail.detail_id" class="width-100-percent" :class="{'before-last-answer': subject_detail_index+1 < temp.subject.subject_detail.length}">
              <span v-html="subject_detail.detail_content" class="_select_item"></span>
            </el-radio>
          </el-radio-group>
          
          <div class="sel">
            <span class="seltxt" style="margin-top: 30px;font-size: 20px;color: #1c3866;float: none;display: block;padding-bottom: 10px;">right answer:
            </span>
            <span style="width: 90%; display: block; color: black !important; margin-bottom: 10px; padding-bottom: 50px; border-bottom: 1px solid black;" v-html="temp.subject.subject_answers?temp.subject.subject_answers.detail_content:temp.subject.subject_answer"></span>
          </div>
        </div>
        <div class="clear"></div>
      </div>

      <div v-cloak class="content" style="min-height: 0px;" v-for="(item, index) in value.examination_data.English">
        <span v-if="index == 0" class="title-type">English</span>
        <span v-if="item.length > 1" class="txt" style="font-size: 18px; font-weight: bold;" v-html="item[0].subject_cat.cat_content"></span>
              
        <div v-for="(temp, subject_index) in item">
          <span class="txt" style="font-size: 16px; font-weight: bold; padding: 3px 50px 10px 50px;" v-html="temp.subject.subject_content"></span>

          <div class="sel" v-if="temp.subject_type == 2">
            <textarea v-model="temp.user_answer" style="width: 30%;display: block;float: left;height: 100px;"></textarea>
          </div>

          <el-radio-group v-if="temp.subject_type == 1" v-model="temp.user_answer" class="sel" disabled>
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject.subject_detail" :label="subject_detail.detail_id" class="width-100-percent" :class="{'before-last-answer': subject_detail_index+1 < temp.subject.subject_detail.length}">
              <span v-html="subject_detail.detail_content" class="_select_item"></span>
            </el-radio>
          </el-radio-group>
          
          <div class="sel">
            <span class="seltxt" style="margin-top: 30px;font-size: 20px;color: #1c3866;float: none;display: block;padding-bottom: 10px;">right answer:
            </span>
            <span style="width: 90%; display: block; color: black !important; margin-bottom: 10px; padding-bottom: 50px; border-bottom: 1px solid black;" v-html="temp.subject.subject_answers?temp.subject.subject_answers.detail_content:temp.subject.subject_answer"></span>
          </div>
        </div>
        <div class="clear"></div>
      </div>

      <div v-cloak class="content" style="min-height: 0px;" v-for="(item, index) in value.examination_data.Logic">
        <span v-if="index == 0" class="title-type">Logic</span>
        <span v-if="item.length > 1" class="txt" style="font-size: 18px; font-weight: bold;" v-html="item[0].subject_cat.cat_content"></span>
              
        <div v-for="(temp, subject_index) in item">
          <span class="txt" style="font-size: 16px; font-weight: bold; padding: 3px 50px 10px 50px;" v-html="temp.subject.subject_content"></span>

          <div class="sel" v-if="temp.subject_type == 2">
            <textarea v-model="temp.user_answer" style="width: 30%;display: block;float: left;height: 100px;"></textarea>
          </div>

          <el-radio-group  v-if="temp.subject_type == 1" v-model="temp.user_answer" class="sel" disabled>
            <el-radio  v-for="(subject_detail, subject_detail_index) in temp.subject.subject_detail" :label="subject_detail.detail_id" class="width-100-percent" :class="{'before-last-answer': subject_detail_index+1 < temp.subject.subject_detail.length}">
              <span v-html="subject_detail.detail_content" class="_select_item"></span>
            </el-radio>
          </el-radio-group>
          
          <div class="sel">
            <span class="seltxt" style="margin-top: 30px;font-size: 20px;color: #1c3866;float: none;display: block;padding-bottom: 10px;">right answer:
            </span>
            <span style="width: 90%; display: block; color: black !important; margin-bottom: 10px; padding-bottom: 50px; border-bottom: 1px solid black;" v-html="temp.subject.subject_answers?temp.subject.subject_answers.detail_content:temp.subject.subject_answer"></span>
          </div>
        </div>
        <div class="clear"></div>
      </div>

      <div v-cloak v-if="show_no_exam" class="content" style="min-height: 0px;">
        <span class="title-type" style="min-height: 510px;line-height: 417px;">No student exam information</span>
      </div>

      <div class="footer">
      	<p>Copyright © 2018 中澳时代（厦门）教育咨询有限公司 | 隐私声明 | 用户协议 | 闽ICP备11456789号 </p>
      </div>
    </div>
  </div>
    <script src="js/test2.js"></script>
</body>
</html>
@component('share.require_js')
@endcomponent

<script type="text/javascript">
  var user_id = 2; 
  var examination_id = 2; 
  var value = {
    examination_data: [],
    show_textarea: false,
    show_no_exam: false
  };

  require(['JQuery', 'vue', 'main', 'vueinit', 'ELEMENT'], function ($, vue, main, vueinit, ELEMENT) {
    (function ($) {
      var vm = new vue({
        data: value,
        el: "#main",
        methods: {
          getExamination: function () {
            var params = {
              examination_id: examination_id,
              user_id: user_id,
            };

            $.post('/examination/getexaminationanswer', params, function (data) {
              if (data.status_code == 200) {
                value.examination_data = data.data;
              } else {
                value.examination_data = [];
                value.show_no_exam = true;
              }
            }, 'json')
          }
        },
        created: function () {
          this.getExamination();
        },
        mounted: function () {
        }
      });
    })(jQuery);
  });

</script>
