define(["JQuery", "cookie", 'ELEMENT'],function($, cookie, ELEMENT) {
  return (function ($) {
    var loading = null;
    var ajaxCnt = 0;
    var loads = [];
    var htmlObject = null;
    var eleLoading = 0;
    
    $.ajaxSetup({
      headers: {
        'X-XSRF-TOKEN': $.cookie('XSRF-TOKEN')
      },
      beforeSend: function () {
        if (eleLoading == 0) {
          eleLoading = ELEMENT.Loading.service({
            lock: true,
            text: 'Loading',
            background: 'rgba(255, 255, 255, 0.7)'
          });
        }

        ajaxCnt++;

        ajaxLock = true;
      },
      complete: function (XMLHttpRequest,status) {
        ajaxCnt--;

        if (ajaxCnt == 0) {
          eleLoading.close();

          eleLoading = 0;
        }

        if (ajaxCnt <= 0) {
          ajaxCnt = 0;
        }

        ajaxLock = false;
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        ajaxCnt--;

        if (ajaxCnt == 0) {
          eleLoading.close();

          eleLoading = 0;
        }

        if (ajaxCnt <= 0) {
          ajaxCnt = 0;
        }

        ajaxLock = false;
      }
    });

    var main = {
    };

    return main;
  })(jQuery);
});