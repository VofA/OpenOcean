function stateChange(id, status) {
	var element = '#step' + id + ' .collapsible-done';

	if (status == 'none') {
		$(element + ' > div').addClass('hide');
		$(element + ' > i').addClass('hide');
	} else if (status == 'load') {
		$(element + ' > div').removeClass('hide');
		$(element + ' > i').addClass('hide');
	} else if (status == 'done') {
		$(element + ' > div').addClass('hide');
		$(element + ' > i').removeClass('hide');
	}
}

function languageLoad(filePath) {
	$.get(filePath, function(data) {
		for (var key in data) {
			$('#' + key).text(data[key]);
		}
	});
}

$(document).ready(function() {
	$('.collapsible').unbind('click');
	$('select').material_select();

	var languageDefault = $("#ls-s option:selected").val();

	// Select language next
	$("#ls-n").click(function(e) {
		stateChange('0', 'load');

		var languageSelected = $('#ls-s option:selected').val();

		if (languageSelected != languageDefault) {
			languageLoad('languages/' + languageSelected + '.json');
		}

		$('.collapsible').collapsible('open', 1);
		stateChange('0', 'done');
	});

	// Welcome next
	$("#w-n").click(function(e) {
		$('.collapsible').collapsible('open', 2);
		stateChange('1', 'done');
	});

	// Port enabled checkbox
	$('#sp-p-cb').click(function() {
		if ($('#sp-p-cb').is(':checked')) {
			$('#port').prop('disabled', false);
		} else {
			$('#port').prop('disabled', true);
		}
	});

	// Setup database next
	$("#sd-n").click(function() {
		stateChange('2', 'load');

		var proceed = true;

		$("#sd-f input:required").toArray().forEach(function(item) {
			if ($(item).val() === '') {
				$(item).addClass("invalid");
				stateChange('2', 'none');
				proceed = false;
				return;
			}
		});

		if (!proceed) {
			return;
		}

		$.ajax({
			type: "POST",
			url: "databaseSetup.php",
			data: $("#sd-f").serialize(),
			success: function(data) {
				if (data == "true") {
					$('.collapsible').collapsible('open', 3);
					stateChange('2', 'done');
				} else {
					stateChange('2', 'none');
					alert("try");
				}
			}
		})
	});

	$('#aa-pwv').click(function(){
		$(this).text(function(a, b){
			return b === 'visibility' ? 'visibility_off' : 'visibility'
		});
		// заменить type=password на type=text
	});

	function readURL(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#aa-i').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#aa-n').on('click', function() {
		var formData = new FormData(document.querySelector("#aa-f"));

		$.ajax({
			type: "POST",
			url: "AdminAccount.php",
			processData: false,
			contentType: false,
			data: formData,
			success: function(data) {
				console.log(data);
			}
		});
	});

	$("#aa-a").change(function(){
		readURL(this);
	});
	
	$('.after').on('click', function() {
		$('#aa-a').trigger('click');
	});

});