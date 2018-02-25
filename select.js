var url_string = window.location.href;
var url = new URL(url_string);
var language_select = url.searchParams.get("language");
$('#language')
  .dropdown({
      onChange: function (value, text, choice) {
          var language = value;
          if (language == "default") {
              document.location.href = '/';
          } else {
              document.location.href = '/?language=' + language;
          };
      }
  })
;
if (language_select != null) {
    $('#language').val(language_select);
}
/*
$('#language').change(function () {
    var language = $('#language').val();
    if (language == "default") {
        document.location.href = '/';
    } else {
        document.location.href = '/?language=' + language;
    };
});
*/
