app.filter('emoticons', function() {
	return function(content) {
		
		var emoticonsPath = "static/img/emoticons/";
		var emoticonsClass = "emoticon";

		var emoticons = [
			{
				regexp: /:\)/,
				title: ':)',
				img: 'smile.png'
			},
			{
				regexp: /:\(/,
				title: ':(',
				img: 'undecided.png'
			},
			{
				regexp: /:D/,
				title: ':D',
				img: 'laugh.png'
			},
			{
				regexp: /:P/,
				title: ':P',
				img: 'stickingout.png'
			},
			{
				regexp: /\|-\(/,
				title: '|-(',
				img: 'ambivalent.png'
			},
			{
				regexp: /:O/,
				title: ':O',
				img: 'largegasp.png'
			},
			{
				regexp: /\(up\)/,
				title: '(up)',
				img: 'thumbsup.png'
			},
			{
				regexp: /\(down\)/,
				title: '(down)',
				img: 'thumbsdown.png'
			},
			{
				regexp: /:\@/,
				title: ':@',
				img: 'veryangry.png'
			}
		];
		
		//replace all emoticons with their images
		emoticons.forEach(function (emoticon){
			var regexp = new RegExp(emoticon.regexp, "ig");
			content = content.replace(regexp, "<img title='"+emoticon.title+"' class='" + emoticonsClass + "' src='" + emoticonsPath + emoticon.img+"'>");
		});

		return content;
	};
});