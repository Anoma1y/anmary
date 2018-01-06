$.ajax({
	url: 'getOrder',
	type: 'GET',
})
.done(function(data) {
	console.log(JSON.parse(data));
})
.fail(function() {
	console.log("error");
})
