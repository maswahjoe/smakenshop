(function($) {
"use strict";


$(document).ready(function() {

	/*==========================================================
			twitter api init
	======================================================================*/
	if ($('.xs-tweet').length > 0) {
        var user = typeof(twitter_data.username) !== 'undefined' ? twitter_data.username :'xpeedstudio';
        var loading = typeof(twitter_data.loading_text) !== 'undefined' ? twitter_data.loading_text :'loading';
		$('.xs-tweet').twittie({
			dateFormat: '%b. %d, %Y',
			template: '{{tweet}} <div class="date">{{date}}</div> <a href="{{url}}" target="_blank">Details</a>',
			count: 2,
			username: user,
			loadingText: loading,
		});
	}
});

})(jQuery);