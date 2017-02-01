Twig.extendFilter("backwords", function(value) {
	console.log(this);
	return value.split(" ").reverse().join(" ");
});
Twig.extendFilter("i18n", function(value) {
	return jsI18n.get(value);
});
Twig.extendFilter("shortest", function(value,length) {
 return value.substring(0, length)+'...';
});
Twig.extendFunction("getUserfile", function(value) {
	return (value.indexOf("http") < 0) ? MEDIA + 'userfiles/' + value: value;
});

$("script[type='text/twig']").each(function() {
	var id = $(this).attr("id"),
		data = $(this).text();

	twig({
		id: id,
		data: data,
		allowInlineIncludes: true
	});
});