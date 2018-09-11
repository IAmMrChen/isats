@extends('share.kaoshi_layouts')

@section('title', '')

@section('content')
  <div class="content">
    <span class="time">40 Second</span>
		<div>
    	<div class="video">
        <!-- <video width="240" height="280" controls style="width:100%; height:100%; object-fit: fill">
          <source src="http://ods71oubn.bkt.clouddn.com/job_00066.mp4" type="video/mp4">
        </video> -->
        视频
      </div>
      <div class="video1">视频</div>
    </div>
    <p class="button"><a href="test2.html">Next</a></p>
  </div>
@endsection
@section('script')
<script type="text/javascript">
  var value = {
  };

  require(['JQuery', 'vue', 'main', 'vueinit', 'ELEMENT'], function ($, vue, main, vueinit, ELEMENT) {
    (function ($) {
      var vm = new vue({
        data: value,
        el: "#container_body",
        methods: {
        },
        created: function () {

        },
        mounted: function () {
          content_value.current_type = 'ISAST考试面试部分';
        }
      });
    })(jQuery);
  });
</script>
@endsection