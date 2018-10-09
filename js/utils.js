function hashed(x) {
	return $.md5(x);
}

function getResolutionHeight() {
	return window.screen.availHeight
}

function getResolutionWidth() {
	return window.screen.availWidth
}

function getColorDepth() {
	return screen.colorDepth;
}

function getDateandTime() {
	return Intl.DateTimeFormat().resolvedOptions().timeZone;
}

function getLanguage() {
	return navigator.language;
}

function logUser(url, canvasHash, resHeight, resWidth, colorDepth, lang, timeZone) {

	var data = {
		canvasHash: canvasHash,
		resHeight: resHeight,
		resWidth: resWidth,
		colorDepth: colorDepth,
		lang: lang,
		timeZone: timeZone
	};

	$.ajax({
		url: url,
		type: 'POST',
		data: data,
		success: function(result) {
			console.log(result);
		}
	});
}
