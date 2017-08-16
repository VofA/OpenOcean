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

function readURL(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#aa-i').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

$(function() {
	$('.collapsible').unbind('click');
	$('select').material_select();

	var languageDefault = $("#ls-s option:selected").val();

	// Step 'Language select'
	// Click button 'Next'
	$("#ls-n").click(function() {
		stateChange('0', 'load');

		var languageSelected = $('#ls-s option:selected').val();

		if (languageSelected != languageDefault) {
			languageLoad('languages/' + languageSelected + '.json');
		}

		$('.collapsible').collapsible('open', 1);
		stateChange('0', 'done');
	});

	// Step 'Welcome'
	// Click button 'Next'
	$("#w-n").click(function() {
		$('.collapsible').collapsible('open', 2);
		stateChange('1', 'done');
	});

	// Step 'Database setup'
	// Click checkbox 'Port enabled/disabled'
	$('#sp-p-cb').click(function() {
		$('#port').prop('disabled', !$('#sp-p-cb').is(':checked'));
	});
	// Click button 'Next'
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

	// Step 'Account setup'
	// Click button 'Password show/hide'
	$('#aa-pwv').click(function() {
		$(this).text(function(a, b){
			return b === 'visibility' ? 'visibility_off' : 'visibility'
		});
		// заменить type=password на type=text
	});
	// Change selected account photo
	$("#aa-a").change(function() {
		readURL(this);
	});
	// Click button 'Select account photo'
	$('.after').on('click', function() {
		$('#aa-a').trigger('click');
	});
	// Click button 'Finish'
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
});