@extends('share.kaoshi_layouts')

@section('title', '')

@section('content')
	<div><img src="{{ getenv('HTML_WEB')}}/images/msg_img.png" class="msg_img" /></div>
  <div class="count-down">
    <!-- <span class="count-down-number"><h5></h>@{{ start_count_time_m }}m</span> -->
    <!-- <span>m</span> -->
    <!-- <span class="count-down-number"><h5></h>@{{ start_count_time_s }}s</span> -->
    <!-- <span>s</span> -->
  </div>
  <p class=""><a href="/examination/testchooseexamination">Return</a></p>
  <div v-show="current_type == 'English'">
    <div v-for="(item, index) in question_data.English" v-show="current_question == item.order" >
      <p style="color: black; font-size: 18px;">@{{ item.cat_id }}</p>
      <div class="content-padding-50">
        <span class="txt font-size-20" v-show="item.subject_cat" v-html="item.subject_cat"></span>

        <div v-for="(temp, cat_index) in item.cat" :class="{'content-read-subject': item.subject_cat, 'content-subject': !item.subject_cat}">
          <span class="txt _timu subject-title" v-html="temp.subject"></span>
          <textarea class="last-answer subject-fill-in-answer" v-model="temp.answer_content" v-show="temp.subject_type == 2"></textarea>
          <!-- <div v-show="temp.subject_type == 1" v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}" class="sel">
            <input class="input" type="radio" v-model="temp.radio_checked" :value="subject_detail.detail_id" />
            <span class="seltxt" v-html="subject_detail.detail_content"></span>
          </div> -->

          <el-radio-group v-show="temp.subject_type == 1" v-model="temp.radio_checked" :class="{'content-read-subject-detail': item.subject_cat}">
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :label="subject_detail.detail_id" class="width-100-percent font-size-18" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}">
              <span v-html="subject_detail.detail_content" class="_select_item font-size-16"></span>
            </el-radio>
          </el-radio-group>
        </div>

        <p class="button" v-if="index != 0" style="left: 50px;" v-on:click="prev_question(index, question_data.Mathematics, 'English')"><a>Prev</a></p>
        <p v-if="!show_submit" class="button" v-on:click="next_question(index, question_data.English, 'English')"><a>Next</a></p>
        <p v-if="show_submit" class="button" v-on:click="submit(1)"><a>Submit</a></p>
        <div class="clear"></div>
      </div>
    </div>
  </div>


  <div v-show="current_type == 'Mathematics'">
    <div v-for="(item, index) in question_data.Mathematics" v-show="current_question == item.order">
      <p style="color: black; font-size: 18px;">@{{ item.cat_id }}</p>
      <div class="content-padding-50">
        <span class="txt font-size-20" v-show="item.subject_cat" v-html="item.subject_cat"></span>
        <div v-for="(temp, cat_index) in item.cat" :class="{'content-read-subject': item.subject_cat, 'content-subject': !item.subject_cat}">
          <span class="txt _timu subject-title" style="" v-html="temp.subject"></span>
          <textarea class="last-answer subject-fill-in-answer" v-model="temp.answer_content" v-show="temp.subject_type == 2"></textarea>
          <!-- <div v-show="temp.subject_type == 1" v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}" class="sel">
            <input class="input" type="radio" v-model="temp.radio_checked" :value="subject_detail.detail_id" />
            <span class="seltxt" v-html="subject_detail.detail_content"></span>
          </div> -->

          <el-radio-group v-show="temp.subject_type == 1" v-model="temp.radio_checked">
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :label="subject_detail.detail_id" class="width-100-percent font-size-18" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}">
              <span v-html="subject_detail.detail_content" class="_select_item font-size-16"></span>
            </el-radio>
          </el-radio-group>

        </div>
      </div>
      <p class="button" v-if="index != 0" style="left: 50px;" v-on:click="prev_question(index, question_data.Mathematics, 'Mathematics')"><a>Prev</a></p>
      <p v-if="!show_submit" class="button" v-on:click="next_question(index, question_data.Mathematics, 'Mathematics')"><a>Next</a></p>
      <p v-if="show_submit" class="button" v-on:click="submit(1)"><a>Submit</a></p>
      <div class="clear"></div>
    </div>
  </div>

  <div v-show="current_type == 'Logic'">
    <div v-for="(item, index) in question_data.Logic" v-show="current_question == item.order">
      <p style="color: black; font-size: 18px;">@{{ item.cat_id }}</p>
      <div class="content-padding-50">
        <span class="txt font-size-20" v-show="item.subject_cat" v-html="item.subject_cat"></span>
        <div v-for="(temp, cat_index) in item.cat" :class="{'content-read-subject': item.subject_cat, 'content-subject': !item.subject_cat}">
          <span class="txt _timu subject-title" v-html="temp.subject"></span>
          <textarea class="last-answer subject-fill-in-answer" v-model="temp.answer_content" v-show="temp.subject_type == 2"></textarea>
          <!-- <div v-show="temp.subject_type == 1" v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}" class="sel">
            <input class="input" type="radio" v-model="temp.radio_checked" :value="subject_detail.detail_id" />
            <span class="seltxt" v-html="subject_detail.detail_content"></span>
          </div> -->
          <el-radio-group v-show="temp.subject_type == 1" v-model="temp.radio_checked">
            <el-radio v-for="(subject_detail, subject_detail_index) in temp.subject_detail" :label="subject_detail.detail_id" class="width-100-percent font-size-18" :class="{'last-answer': (cat_index+1 == item.cat.length && subject_detail_index+1 == temp.subject_detail.length), 'before-last-answer': subject_detail_index+1 < temp.subject_detail.length}">
              <span v-html="subject_detail.detail_content" class="_select_item font-size-16"></span>
            </el-radio>
          </el-radio-group>

        </div>
        <p class="button" v-if="index != 0" style="left: 50px;" v-on:click="prev_question(index, question_data.Mathematics, 'Logic')"><a>Prev</a></p>
        <p v-show="!show_submit" class="button" v-on:click="next_question(index, question_data.Logic, 'Logic')"><a>Next</a></p>
        <p v-if="show_submit" class="button" v-on:click="submit(1)"><a>Submit</a></p>
        <div class="clear"></div>
      </div>
    </div>
  </div>


@endsection
@section('script')
<script type="text/javascript">
  var user_id = 2;
  var examination_id = "{{ $examination_id }}";
  var examination_paper_id = "{{ $examination_paper_id }}";
  var value_temp = {
    question_data: [],
    current_question: 1,
    current_type: 'Mathematics',
    show_submit: false,
    start_count_time_m: 112,
    start_count_time_s: 0,
    timer: '',

    current_index: 0,
    type_data: [],
    temp_type: 'Mathematics',
  };
  var vm = null;

  require(['JQuery', 'vue', 'main', 'vueinit', 'ELEMENT'], function ($, vue, main, vueinit, ELEMENT) {
    (function ($) {
      vm = new vue({
        data: value_temp,
        el: "#container_body",
        methods: {
          getQuestionDatas: function () {
            var obj = this;

            var params = {
              examination_id: examination_id,
              examination_paper_id: examination_paper_id,
            };

            $.post('/examination/getallexaminationsubjects', params, function (data) {
              if (data.status_code == 200) {
                value_temp.question_data = data.data;
                value_temp.type_data = data.data.Mathematics;

                obj.startCountDown();
                // content_value.total_question = value_temp.question_data.Mathematics.length; // 当三个种类的试卷集成在一份试卷的时候用

                // 当前是什么试卷就赋值对应的题目
                if (value_temp.question_data.Mathematics) {
                  content_value.total_question = value_temp.question_data.Mathematics.length;
                  value_temp.current_type = 'Mathematics';
                  content_value.current_type = 'Mathematics';
                  content_value.remain_time_m = 112;
                  value_temp.type_data = data.data.Mathematics;
                } else if (value_temp.question_data.English) {
                  content_value.total_question = value_temp.question_data.English.length;
                  value_temp.current_type = 'English';
                  content_value.current_type = 'English';
                  content_value.remain_time_m = 273;
                  value_temp.type_data = data.data.English;
                } else if (value_temp.question_data.Logic) {
                  content_value.total_question = value_temp.question_data.Logic.length;
                  value_temp.current_type = 'Logic';
                  content_value.current_type = 'Logic';
                  content_value.remain_time_m = 30;
                  value_temp.type_data = data.data.Logic;
                }

                setTimeout(function () {
                  dynamicLoadJs('https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML',function(){});
                }, 1000);
              } else {
                value_temp.question_data = [];
              }
            }, 'json');
          },
          next_question: function (index, type_data, type) {
            donext_question(index, type_data, type);
          },
          prev_question: function (index, type_data, type) {
            if (index == 0) {
              if (type == 'English') {
                value_temp.current_type = 'Mathematics';
                content_value.currrent_question = value_temp.question_data.Mathematics.length; // 上一题不会上一题到上一个类此处可不要
                content_value.total_question = value_temp.question_data.Mathematics.length;
              } else if (type == 'Logic') {
                value_temp.current_type = 'English';
                content_value.currrent_question = value_temp.question_data.English.length;
                content_value.total_question = value_temp.question_data.English.length;
              }
            } else {
              content_value.currrent_question--;
            }

            value_temp.show_submit = false;
            value_temp.current_question -= 1;
          },
          submit: function (origin) {
            // origin = 1正常点击提交， 2 时间到了强制提交s
            var result = [];
            var not_do_question = [];

            for (temp in value_temp.question_data) {
              for (var i = 0; i < value_temp.question_data[temp].length; i++) {
                
                var order_id = 0; //记录没做的题目的序号

                for (var j = 0; j < value_temp.question_data[temp][i].cat.length; j++) {

                  var temp_value = new Object();
                  
                  temp_value.subject_type = value_temp.question_data[temp][i].cat[j].subject_type;
                  temp_value.subject_id = value_temp.question_data[temp][i].cat[j].subject_id;
                  temp_value.examination_id = value_temp.question_data[temp][i].examination_id;
                  temp_value.examination_paper_id = value_temp.question_data[temp][i].examination_paper_id;
                  temp_value.group_type = value_temp.question_data[temp][i].group_type;

                  temp_value.group_id = value_temp.question_data[temp][i].group_id;
                  temp_value.cat_id = value_temp.question_data[temp][i].cat_id;
                  temp_value.created_at = this.timeFmtDate(Date.parse(new Date()));

                  temp_value.user_id = user_id;

                  if (i == value_temp.question_data[temp].length - 1) {
                    temp_value.remain_time = content_value.remain_time_m * 60 + content_value.remain_time_s // 获取最后一题的剩余时间
                  } else {
                    temp_value.remain_time = value_temp.question_data[temp][i].remain_time;
                  }

                  if (value_temp.question_data[temp][i].cat[j].subject_type == 1) {
                    temp_value.user_answer = value_temp.question_data[temp][i].cat[j].radio_checked?value_temp.question_data[temp][i].cat[j].radio_checked:'Unanswered';
                  } else if (value_temp.question_data[temp][i].cat[j].subject_type == 2) {
                    temp_value.user_answer = value_temp.question_data[temp][i].cat[j].answer_content?value_temp.question_data[temp][i].cat[j].answer_content:'Unanswered';
                  }

                  result.push(temp_value);

                  // 记录没做的题目的序号
                  if (temp_value.user_answer == 'Unanswered') {
                    order_id = value_temp.question_data[temp][i].order;
                  }
                }

                if (order_id > 0) {
                  not_do_question.push(order_id);
                }
              }
            }

            // 提示没做的题目
            if (origin == 1 && not_do_question.length > 0) {
              var string = not_do_question.join(',');

              ELEMENT.Message.success({
                message: "You still have questions that are not completed(" + string + "), are you sure to submit?",
                duration: 3000,
                onClose: function () {}
              });
            } else {
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
            }
          },
          startCountDown: function () {
            // 触发倒计时   
            value_temp.timer = setInterval("CountDown()", 1000);
          },
          timeFmtDate: function (obj) {
              var date =  new Date(obj);
              var y = 1900 + date.getYear();
              var m = "0" + (date.getMonth()+1);
              var d = "0" + date.getDate();
              var h = date.getHours();
              var min = date.getMinutes();
              var sec = date.getSeconds();
              return y + "-" + m.substring(m.length-2,m.length) + "-" + d.substring(d.length-2,d.length) + ' ' + h + ':' + min + ':' + sec;
          },
          remindMessage: function () {
            var obj = this;
            ELEMENT.Message.success({
              message: 'time up',
              duration: 1000,
              onClose: function () {
                // obj.submit();
              }
            });
          }
        },
        created: function () {
          this.getQuestionDatas();
        },
        mounted: function () {
        }
      });
    })(jQuery);
  });
// 倒计时
function CountDown() {
  if (content_value.remain_time_m > 0) {
    // 按题目种类倒计时
    // 秒数为0分钟减1,否则秒数减1
    if (content_value.remain_time_s == 0) {
      content_value.remain_time_m--;
      content_value.remain_time_s = 60;
    } else {
      content_value.remain_time_s--;
    }
  } else {
    if (content_value.remain_time_s == 0) {
      // 停止倒计时
      clearInterval(value_temp.timer);
      vm.remindMessage();
    } else {
      // 秒继续倒计时
      content_value.remain_time_s--;
    }
  }
}

function donext_question (index, type_data, type) {
  // 记录剩余时间 不包含最后一题 因为是在下一题时候触发的
  if (type == 'Mathematics') {
    value_temp.question_data.Mathematics[index].remain_time = content_value.remain_time_m*60 + content_value.remain_time_s;
  } else if (type == 'English') {
    value_temp.question_data.English[index].remain_time = content_value.remain_time_m*60 + content_value.remain_time_s;
  } else if (type == 'Logic') {
    value_temp.question_data.Logic[index].remain_time = content_value.remain_time_m*60 + content_value.remain_time_s;
  }

  // if ((index == type_data.length - 2) && type == 'Logic') { // 三个类型集成在一份试卷上时候用
  if (index == type_data.length - 2) {
    value_temp.show_submit = true;
  }

  if (index == type_data.length - 1) {
    if (type == 'Mathematics') {
      value_temp.current_type = 'English';
      value_temp.temp_type = 'English';
      value_temp.type_data = value_temp.question_data.English;
      content_value.current_type = 'English'; // 修改头部的考试种类信息
      content_value.remain_time_m = 273; // 切换种类切换时间
      content_value.remain_time_s = 0;
      content_value.total_question = value_temp.question_data.English.length; // 记录总题数
    } else if (type == 'English') {
      value_temp.current_type = 'Logic';
      content_value.current_type = 'Logic';
      value_temp.temp_type = 'Logic';
      value_temp.type_data = value_temp.question_data.Logic;
      content_value.remain_time_m = 30; // 切换种类切换时间
      content_value.remain_time_s = 0;
      content_value.total_question = value_temp.question_data.Logic.length;
    }

    content_value.currrent_question = 0;
    index = -1;
  }

  // 显示当前是第几题
  content_value.currrent_question++;

  value_temp.current_question += 1;

  // 记录当前页面所显示的题目在该类型数组中的下标
  value_temp.current_index = index + 1;

  // 时间复原回去,并再次触发倒计时
  // value_temp.start_count_time = 300;

  // 关闭倒计时，手动触发下一页时候需要再下一页的倒计时开始之前关闭当前的倒计时
  // clearInterval(value_temp.timer);
  // value_temp.timer = setInterval("CountDown()", 1000);
}

  
</script>
@endsection
