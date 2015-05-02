jQuery(document).ready(function($){
	if( $('.floating-labels').length > 0 ) floatLabels();

	var inputFields = $('.floating-labels .cd-label').next();
	inputFields.each(function(){
		var singleInput = $(this);
		(singleInput.val() != '') ? singleInput.prev('.cd-label').addClass('float') : singleInput.prev('.cd-label').removeClass('float');
	});

	function floatLabels() {
		var inputFields = $('.floating-labels .cd-label').next();
		inputFields.each(function(){
			var singleInput = $(this);
			//check if user is filling one of the form fields 
			//~ checkVal(singleInput);
			//~ singleInput.on('change keyup', function(){
			singleInput.on('click', function(){
				//~ checkVal(singleInput);
				singleInput.prev('.cd-label').addClass('float');
			});
		});
	}

	//~ function checkVal(inputField) {
		//~ ( inputField.val() == '' ) ? inputField.prev('.cd-label').removeClass('float') : inputField.prev('.cd-label').addClass('float');
	//~ }
});
