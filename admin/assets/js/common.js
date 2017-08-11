function languageLoad(filePath) {
	$.get(filePath, function(data) {
		for (var key in data) {
			$('#' + key).text(data[key]);
		}
	});
}