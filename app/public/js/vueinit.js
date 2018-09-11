define(["JQuery", 'vue', 'ELEMENT', 'element/locale/en'],function($, Vue, ElementUI, ELEMENTEN) {
  // console.log(ELEMENTEN);
  Vue.use(ElementUI);

  ElementUI.locale(ELEMENTEN);

  Vue.filter('time', function (value) {//value为13位的时间戳
    if (value == null || value == 0 || value.length == 0) return;
    function add0(m) {
        return m < 10 ? '0' + m : m
    }
    var time = new Date(parseInt(value) * 1000);
    var y = time.getFullYear();
    var m = time.getMonth() + 1;
    var d = time.getDate();

    return add0(d) + '/' + add0(m) + '/' + y;
  });

  Vue.filter('money', function (s) {
    if (parseFloat(s).toString() == "NaN") return '0.00';

    n = 2;
    s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
    var l = s.split(".")[0].split("").reverse(),
    r = s.split(".")[1];
    t = "";

    for(i = 0; i < l.length; i ++ ) {   
      t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");   
    }

    return t.split("").reverse().join("") + "." + r;
  });
  return null;
});
