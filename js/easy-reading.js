/* Switch Styles*/
(function($) {
    $(document).ready(function() {

      var css_black = window.easy_reading_data.easy_reading_url+'css/easy-reading-black.css';
      var css_white = window.easy_reading_data.easy_reading_url+'css/easy-reading-white.css';
      var css_big = window.easy_reading_data.easy_reading_url+'css/easy-reading-big.css';
      var css_def = window.easy_reading_data.easy_reading_url+'css/easy-reading-default.css';


      $('link[id=style-color]').attr("href", css_def);
      $('link[id=style-big]').attr("href", css_def);


      var style_color = readCookie('style_color');
      var style_size  = readCookie('style_size');

      if (style_color) {
        if (style_color == "style-black")
          $('link[id=style-color]').attr("href", css_black);
       else
          $('link[id=style-color]').attr("href", css_white);
      } else {
        $('link[id=style-color]').attr("href", css_def);
      }

      if (style_size && style_size == "style-big") {
        $('link[id=style-big]').attr("href", css_big);
      } else {
        $('link[id=style-big]').attr("href", css_def);
      }


      $("#easy-reading-contrast").click(function(){
        if (!style_color || (style_color && style_color == "style-white")) {
          $('link[id=style-color]').attr("href", css_black);
          createCookie('style_color', "style-black", 365);
        } else {
          $('link[id=style-color]').attr("href", css_white);
          createCookie('style_color', "style-white", 365);
        }
      });

      $("#easy-reading-big").click(function(){
        if (!style_size) {
          $('link[id=style-big]').attr("href", css_big);
          createCookie('style_size', "style-big", 365);
        } else {
          $('link[id=style-big]').attr("href", css_def);
          eraseCookie('style_size');
        }
      });

      $("#easy-reading-off").click(function(){
        $('link[id=style-color]').attr("href", css_def);
        $('link[id=style-big]').attr("href", css_def);
        eraseCookie('style_size');
        eraseCookie('style_color');
      });
    });

})(jQuery);


/* cookie style core */
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    } else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}
