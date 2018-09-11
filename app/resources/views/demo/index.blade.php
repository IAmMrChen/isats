@extends('share.kaoshi_layouts')

@section('title', 'Index')

@section('content')

<span class="wel">Welcome to ISATS test .</span>
<div style="float: left; margin-left: -20px;"><img src="{{ getenv('HTML_WEB') }}/images/msg_img.png" class="msg_img" /></div>
<div style="float: left; width: 100%;"><img src="{{ getenv('HTML_WEB') }}/images/wel_header.jpg" class="wel_header" /></div>
<p class="button"><a href="test1.html">Start</a></p>

@endsection
@section('script')
<script type="text/javascript">
	var value = {};

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
        	ELEMENT.Message.success({
        		message: '恭喜你，这是一条成功消息'
        	});
        }
		  });
		})(jQuery);
	});

</script>
@endsection

