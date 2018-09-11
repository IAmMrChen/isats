@extends('share.kaoshi_layouts')

@section('title', 'Stage6')

@section('content')
<div style="color: black; padding: 50px" v-if="show_position == 1">
  <ul>
    <li v-for="(item, index) in name_data">
      @{{ item.examination_name }}
      <ul style="margin-left: 45px;">
        <li style="margin-top: 10px;cursor: pointer;" v-for="temp in item.examination_and_paper_ref"><a v-on:click="jump_to_examination(item.examination_id, temp.examination_paper_id, temp.examination_paper.examination_paper_name)" style="color: black;font-style:italic;">@{{ temp.examination_paper.examination_paper_name }}</a></li>
      </ul>
    </li>
  </ul>
</div>
<div v-if="show_position == 2" style="color: black; padding: 200px 200px 200px 369px;font-size: 35px;">
  <span>No examination paper information</span>
</div>

@endsection
@section('script')
<script type="text/javascript">
  var value = {
    name_data: [],
    show_position: 0, // 不显示
  };

  require(['JQuery', 'vue', 'main', 'vueinit', 'ELEMENT'], function ($, vue, main, vueinit, ELEMENT) {
    (function ($) {
      var vm = new vue({
        data: value,
        el: "#container_body",
        methods: {
          getExaminationName: function () {

            $.post('/examination/getexaminationname', function (data) {
              if (data.status_code == 200) {
                value.name_data = data.data;
                value.show_position = 1; // 显示列表
              } else {
                value.name_data = [];
                value.show_position = 2; // 显示没有信息的提示
              }
            }, 'json');
          },
          jump_to_examination: function (examination_id, examination_paper_id, examination_paper_name) {
            location.href = "/examination/startexami?examination_id=" + examination_id + "&examination_paper_id=" + examination_paper_id + "&examination_paper_name=" + examination_paper_name;
          }
        },
        created: function () {
          this.getExaminationName();
        },
        mounted: function () {
          content_value.current_type = 'ISAST-Stage6';
        }
      });
    })(jQuery);
  });
</script>
@endsection
