@extends('share.kaoshi_layouts')

@section('title', $examination_paper_name)

@section('content')
<div class="content">
  <span class="wel">Welcome to ISATS test .</span>
  <div style="float: left; margin-left: -20px;"><img src="{{ getenv('HTML_WEB') }}/images/msg_img.png" class="msg_img" /></div>
  <div style="float: left; width: 100%;"><img src="{{ getenv('HTML_WEB') }}/images/wel_header.jpg" class="wel_header" /></div>
  <p class="button" v-on:click="start"><a>Start</a></p>
</div>

@endsection
@section('script')
<script type="text/javascript">
  var examination_id = "{{ $examination_id }}";
  var examination_paper_name = "{{ $examination_paper_name }}";
  var examination_paper_id = "{{ $examination_paper_id }}";
  var value = {

  };

  require(['JQuery', 'vue', 'main', 'vueinit', 'ELEMENT'], function ($, vue, main, vueinit, ELEMENT) {
    (function ($) {
      var vm = new vue({
        data: value,
        el: "#container_body",
        methods: {
          start: function () {
            location.href = "/examination/examinationquestions?examination_id=" + examination_id + "&examination_paper_id=" + examination_paper_id + "&examination_paper_name=" + examination_paper_name;
          },
        },
        created: function () {

        },
        mounted: function () {
          content_value.current_type = 'ISAST-' + examination_paper_name;
        }
      });
    })(jQuery);
  });
</script>
@endsection
