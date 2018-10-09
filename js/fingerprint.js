function getCanvasHash(getHashed) {
	"use strict";
	var N, strOnError, strCText, strText, strOut, responses;

	getHashed = getHashed === undefined ? true : getHashed;

	N = 3;
	strOnError = "";
	strCText = null;
	strText = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ`~1!2@3#4$5%6^7&8*9(0)-_=+[{]}|;:',<.>/?";
	strOut = null;
	responses = [];

	for (var index = 0; index < N; index++) {
		try {
			var canvas = document.createElement('canvas');
			strCText = canvas.getContext('2d');
			strCText.textBaseline = "top";
			strCText.font = "14px 'Arial'";
			strCText.textBaseline = "alphabetic";
			strCText.fillStyle = "#f60";
			strCText.fillRect(125, 1, 62, 20);
			strCText.fillStyle = "#069";
			strCText.fillText(strText, 2, 15);
			strCText.fillStyle = "rgba(102, 204, 0, 0.7)";
			strCText.fillText(strText, 4, 17);
			strOut = canvas.toDataURL();
			
			responses.push(strOut);
		} catch (err) {
			responses.push(strOnError);
		}
	}

	if (getHashed) {
		var temp = "";
		for (var i = 0; i < N; i++)
			temp += hashed(responses[i]);
		return hashed(temp);
	} else {
		return responses;
	}
}
