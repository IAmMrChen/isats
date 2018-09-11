<script type="text/javascript" src="{{ getenv('STATIC_HOST') }}/js/require.js"></script>
<script type="text/javascript">
  require.config({
    baseUrl: "{{ getenv('RESOURCE_MODEL_ROOT') }}",
    paths: {
      JQuery: "/js/jquery.min",
      jquery: "/js/jquery.min",
      cookie: "/js/jquery.cookie",
      vue: "/js/vue.min",
      MD5: "/js/MD5",
      main: "/js/main.js?v={{ getenv('VIEW_VERSION') }}",
      ELEMENT: "{{ getenv('JS_LIBS') }}/element-ui@2.4.6/index",
      vueinit: "/js/vueinit.js?v={{ getenv('VIEW_VERSION') }}",
      'element/locale/en': "{{ getenv('JS_LIBS') }}/element-ui@2.4.6/en"
    },
    "shim": {
    },
    waitSeconds: 0
  });
</script>