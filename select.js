var url_string = window.location.href;
var url = new URL(url_string);
var language_select = url.searchParams.get("language");
$('#language').dropdown();
if (language_select != null) {
    $('#language').dropdown('set selected', language_select);
}
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
