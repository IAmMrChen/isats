@extends('share.kaoshi_layouts')

@section('title', '')

@section('content')
	<div><img src="{{ getenv('HTML_WEB')}}/images/msg_img.png" class="msg_img" /></div>
  <div class="count-down">
    <span class="count-down-number">@{{ start_count_time }}</span>
    <span>s</span>
  </div>
  <div v-show="current_type == 'English'">
    <div v-for="(item, index) in question_data.English" v-show="current_question == item.order">
    <p style="color: black; font-size: 18px;">@{{ item.cat_id }}</p>
      <div>
        <span class="txt" style="font-size: 18px; font-weight: bold;" v-show="item.subject_cat" v-html="item.subject_cat"></span>
        <!-- <textarea v-model="item.answer_content" v-show="item.subject_type == 2" style="display: block;float: left;margin-left: 50px;width: 500px;height: 100px;"></textarea>
        <div class="sel" v-show="item.subject_type == 1" v-for="temp in item.subject_detail">
          <input class="input" type="radio" v-model="item.radio_checked" :value="temp.detail_id">
          <span class="seltxt" v-html="temp.detail_content"></span>
        </div> -->

        <div v-for="(temp, cat_index) in item.cat" style="margin-left: 200px;">
          <span class="txt _timu" style="font-size: 16px; font-weight: bold; padding: 0px;" v-html="temp.subject"></span>
          <textarea v-model="temp.answer_content" v-show="temp.subject_type == 2" style="display: block;width: 500px;height: 100px;"></textarea>
          <!-- <div v-show="temp.subject_type == 1" v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}" class="sel">
            <input class="input" type="radio" v-model="temp.radio_checked" :value="subject_detail.detail_id" />
            <span class="seltxt" v-html="subject_detail.detail_content"></span>
          </div> -->

          <el-radio-group v-show="temp.subject_type == 1" v-model="temp.radio_checked">
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :label="subject_detail_index" style="width: 100%;line-height: 44px;max-height: 47px;">
              <span v-html="subject_detail.detail_content" class="_select_item"></span>
            </el-radio>
          </el-radio-group>
        </div>

        <p class="button" style="margin: 15px;float: left; position: unset;" v-on:click="prev_question(index, question_data.Mathematics, 'English')"><a>Prev</a></p>
        <p class="button" style="margin: 15px;float: right; position: unset;" v-on:click="next_question(index, question_data.English, 'English')"><a>Next</a></p>
      </div>
    </div>
  </div>


  <div v-show="current_type == 'Mathematics'">
    <div v-for="(item, index) in question_data.Mathematics" v-show="current_question == item.order">
      <p style="color: black; font-size: 18px;">@{{ item.cat_id }}</p>
      <div style="padding-top: 50px;">
        <span class="txt" style="font-size: 18px; font-weight: bold;" v-show="item.subject_cat" v-html="item.subject_cat"></span>
        <!-- <textarea v-model="item.answer_content" v-show="item.subject_type == 2" style="display: block;float: left;margin-left: 50px;width: 500px;height: 100px;"></textarea>
        <div class="sel" v-show="item.subject_type == 1" v-for="temp in item.subject_detail">
          <input class="input" type="radio" v-model="item.radio_checked" :value="temp.detail_id">
          <span class="seltxt" v-html="temp.detail_content"></span>
        </div> -->
        <div v-for="(temp, cat_index) in item.cat" style="margin-left: 200px;">
          <span class="txt _timu" style="font-size: 16px; font-weight: bold; padding: 0px;border-bottom: 1px solid #d9d9d9;padding-bottom: 15px;width: 80%;" v-html="temp.subject"></span>
          <textarea v-model="temp.answer_content" v-show="temp.subject_type == 2" style="display: block;width: 500px;height: 100px;"></textarea>
          <!-- <div v-show="temp.subject_type == 1" v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}" class="sel">
            <input class="input" type="radio" v-model="temp.radio_checked" :value="subject_detail.detail_id" />
            <span class="seltxt" v-html="subject_detail.detail_content"></span>
          </div> -->
          <el-radio-group v-show="temp.subject_type == 1" v-model="temp.radio_checked">
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :label="subject_detail_index" style="width: 100%;line-height: 44px;max-height: 47px;">
              <span v-html="subject_detail.detail_content" class="_select_item"></span>
            </el-radio>
          </el-radio-group>
        </div>
      </div>
      <p class="button" style="margin: 15px;float: left; position: unset;" v-on:click="prev_question(index, question_data.Mathematics, 'Mathematics')"><a>Prev</a></p>
      <p class="button" style="margin: 15px;float: right; position: unset;" v-on:click="next_question(index, question_data.Mathematics, 'Mathematics')"><a>Next</a></p>
      <div class="clear"></div>
    </div>
  </div>

  <div v-show="current_type == 'Logic'">
    <div v-for="(item, index) in question_data.Logic" v-show="current_question == item.order">
      <p style="color: black; font-size: 18px;">@{{ item.cat_id }}</p>
      <div>
        <span class="txt _timu" style="font-size: 18px; font-weight: bold;" v-show="item.subject_cat" v-html="item.subject_cat"></span>
        <div v-for="(temp, cat_index) in item.cat" style="margin-left: 200px;">
          <span class="txt" style="font-size: 16px; font-weight: bold; padding: 0px;" v-html="temp.subject"></span>
          <textarea v-model="temp.answer_content" v-show="temp.subject_type == 2" style="display: block;width: 500px;height: 100px;"></textarea>
          <!-- <div v-show="temp.subject_type == 1" v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}" class="sel">
            <input class="input" type="radio" v-model="temp.radio_checked" :value="subject_detail.detail_id" />
            <span class="seltxt" v-html="subject_detail.detail_content"></span>
          </div> -->

          <el-radio-group v-show="temp.subject_type == 1" v-model="temp.radio_checked">
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :label="subject_detail_index" style="width: 100%;line-height: 44px;max-height: 47px;">
              <span v-html="subject_detail.detail_content" class="_select_item"></span>
            </el-radio>
          </el-radio-group>
        </div>
        <p class="button" style="margin: 15px;float: left; position: unset;" v-on:click="prev_question(index, question_data.Mathematics, 'Logic')"><a>Prev</a></p>
        <p v-show="!show_submit" style="margin: 15px;float: right; position: unset;" class="button" v-on:click="next_question(index, question_data.Logic, 'Logic')"><a>Next</a></p>
        <p v-if="show_submit" class="button" v-on:click="submit"><a>Submit</a></p>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
  var user_id = 1;
  var valueTemp = {
    question_data: [],
    current_question: 1,
    current_type: 'Mathematics',
    show_submit: false,
    start_count_time: 3600*24,
    timer: '',

    current_index: 0,
    type_data: [],
    temp_type: 'Mathematics',
  };

  require(['JQuery', 'vue', 'main', 'vueinit', 'ELEMENT'], function ($, vue, main, vueinit, ELEMENT) {
    (function ($) {
      var vm = new vue({
        data: valueTemp,
        el: "#container_body",
        methods: {
          getQuestionDatas: function () {
            var obj = this;
            $.post('/examination/getallexaminationsubjects', function (data) {
              if (data.status_code == 200) {
                valueTemp.question_data = data.data;
                valueTemp.type_data = data.data.Mathematics;

                // obj.startCountDown();
                setTimeout(function () {
                  dynamicLoadJs('https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML',function(){});
                }, 1000);
              } else {
                valueTemp.question_data = [];
              }
            }, 'json');
          },
          next_question: function (index, type_data, type) {
            donext_question(index, type_data, type);
          },
          prev_question: function (index, type_data, type) {
            if (index == 0) {
              if (type == 'English') {
                valueTemp.current_type = 'Mathematics';
                content_value.current_type = 'Mathematics'; // 修改头部的考试种类信息

                valueTemp.temp_type = 'Mathematics';
                valueTemp.type_data = value.question_data.Mathematics;
              } else if (type == 'Logic') {
                valueTemp.current_type = 'English';
                content_value.current_type = 'English';
                valueTemp.temp_type = 'English';
                valueTemp.type_data = value.question_data.English;
              }
            }

            valueTemp.show_submit = false;
            valueTemp.current_question -= 1;

            // 时间复原回去,并再次触发倒计时
            valueTemp.start_count_time = 3600*24;

            // 关闭倒计时，手动触发下一页时候需要再下一页的倒计时开始之前关闭当前的倒计时
            clearInterval(valueTemp.timer);
            valueTemp.timer = setInterval("CountDown()", 1000);
          },
          submit: function () {
            var result = [];

            for (temp in valueTemp.question_data) {
              for (var i = 0; i < valueTemp.question_data[temp].length; i++) {

                for (var j = 0; j < valueTemp.question_data[temp][i].cat.length; j++) {

                  var temp_value = new Object();
                  
                  temp_value.subject_type = valueTemp.question_data[temp][i].cat[j].subject_type;
                  temp_value.subject_id = valueTemp.question_data[temp][i].cat[j].subject_id;
                  temp_value.examination_id = valueTemp.question_data[temp][i].examination_id;
                  temp_value.examination_paper_id = valueTemp.question_data[temp][i].examination_paper_id;

                  temp_value.group_id = valueTemp.question_data[temp][i].group_id;
                  temp_value.cat_id = valueTemp.question_data[temp][i].cat_id;

                  temp_value.user_id = user_id;

                  if (i == valueTemp.question_data[temp].length - 1) {
                    temp_value.remain_time = valueTemp.start_count_time // 获取最后一题的剩余时间
                  } else {
                    temp_value.remain_time = valueTemp.question_data[temp][i].remain_time;
                  }

                  if (valueTemp.question_data[temp][i].cat[j].subject_type == 1) {
                    temp_value.user_answer = valueTemp.question_data[temp][i].cat[j].radio_checked?valueTemp.question_data[temp][i].cat[j].radio_checked:'Unanswered';
                  } else if (valueTemp.question_data[temp][i].cat[j].subject_type == 2) {
                    temp_value.user_answer = valueTemp.question_data[temp][i].cat[j].answer_content?valueTemp.question_data[temp][i].cat[j].answer_content:'Unanswered';
                  }

                  result.push(temp_value);
                }

              }
            }

            $.post('/examination/adduserexaminationanswer', {result_array: result}, function (data) {
              if (data.status_code == 200) {
                ELEMENT.Message.success({
                  message: 'Submitted successfully, exam completed'
                });
              } else {
                ELEMENT.Message.success({
                  message: 'Submitted failed'
                });
              }
            }, 'json');
          },
          startCountDown: function () {
            // 触发倒计时   
            valueTemp.timer = setInterval("CountDown()", 1000);
          }
        },
        created: function () {
          this.getQuestionDatas();

        },
        mounted: function () {
          // ELEMENT.Message.success({
          //   message: '恭喜你，这是一条成功消息',
          //   duration: 1000,
          //   onClose: function () {
          //     console.log(1500);
          //     关闭时的回调函数
          //   }
          // });
        }
      });
    })(jQuery);
  });

  // 倒计时
  function CountDown() {
    if (valueTemp.start_count_time > 0) {
      valueTemp.start_count_time--;
    } else {
      // 停止倒计时
      clearInterval(valueTemp.timer);
      // 下一题
      if (valueTemp.show_submit) {
        // 最后一题就不下一题
      } else {
        donext_question(valueTemp.current_index, valueTemp.type_data, valueTemp.temp_type);
      }
    }
  }

  function donext_question (index, type_data, type) {
    // 记录剩余时间 不包含最后一题 因为是在下一题时候触发的
    if (type == 'Mathematics') {
      valueTemp.question_data.Mathematics[index].remain_time = valueTemp.start_count_time;
    } else if (type == 'English') {
      valueTemp.question_data.English[index].remain_time = valueTemp.start_count_time;
    } else if (type == 'Logic') {
      valueTemp.question_data.Logic[index].remain_time = valueTemp.start_count_time;
    }

    if ((index == type_data.length - 2) && type == 'Logic') {
      valueTemp.show_submit = true;
    }

    if (index == type_data.length - 1) {
      if (type == 'Mathematics') {
        valueTemp.current_type = 'English';
        content_value.current_type = 'English'; // 修改头部的考试种类信息
        valueTemp.temp_type = 'English';
        valueTemp.type_data = valueTemp.question_data.English;
      } else if (type == 'English') {
        valueTemp.current_type = 'Logic';
        content_value.current_type = 'Logic';
        valueTemp.temp_type = 'Logic';
        valueTemp.type_data = valueTemp.question_data.Logic;
      }

      index = -1;
    }

    valueTemp.current_question += 1;

    // 记录当前页面所显示的题目在该类型数组中的下标
    valueTemp.current_index = index + 1;

    // 时间复原回去,并再次触发倒计时
    valueTemp.start_count_time = 3600*24;

    // 关闭倒计时，手动触发下一页时候需要再下一页的倒计时开始之前关闭当前的倒计时
    clearInterval(valueTemp.timer);
    valueTemp.timer = setInterval("CountDown()", 1000);
  }
</script>
@endsection
