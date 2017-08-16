function stateChange(id, status) {
	var element = '#' + id + ' .collapsible-done';

	if (status === 'none') {
		$(element + ' > div').addClass('hide');
		$(element + ' > i').addClass('hide');
	} else if (status === 'load') {
		$(element + ' > div').removeClass('hide');
		$(element + ' > i').addClass('hide');
	} else if (status === 'done') {
		$(element + ' > div').addClass('hide');
		$(element + ' > i').removeClass('hide');
	}
}

function languageLoad(filePath) {
	$.getJSON(filePath, function(data) {
		for (var key in data) {
            if (data.hasOwnProperty(key)) {
                $('#' + key).text(data[key]);
            }

		}
	});
}

function readURL(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#as-f-i').attr('src', e.target.result);
		};

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
		stateChange('ls', 'load');

		var languageSelected = $('#ls-s option:selected').val();

		if (languageSelected != languageDefault) {
			languageLoad('languages/' + languageSelected + '.json');
		}

		$('.collapsible').collapsible('open', 1);
		stateChange('ls', 'done');
	});

	// Step 'Welcome'
	// Click button 'Next'
	$("#w-n").click(function() {
		stateChange('w', 'load');

		$('.collapsible').collapsible('open', 2);

		stateChange('w', 'done');
	});

	// Step 'Database setup'
	// Click checkbox 'Port enabled/disabled'
	$('#ds-f-p-cb').click(function() {
		$('#ds-f-port').prop('disabled', !$('#ds-f-p-cb').is(':checked'));
	});
	// Click button 'Next'
	$("#ds-n").click(function() {
		stateChange('ds', 'load');

		var proceed = true;

		$("#ds-f input:required").toArray().forEach(function(item) {
			if ($(item).val() === '') {
				$(item).addClass("invalid");
				stateChange('ds', 'none');
				proceed = false;
				return;
			} else {
				$(item).removeClass("invalid");
			}
		});

		if (!proceed) {
			return;
		}

		$.ajax({
			type: "POST",
			url: "databaseSetup.php",
			data: $("#ds-f").serialize(),
			success: function(data) {
				if (data == "true") {
					$('.collapsible').collapsible('open', 3);
					stateChange('ds', 'done');
				} else {
					stateChange('ds', 'none');
				}
			}
		})
	});

	// Step 'Account setup'
	// Click button 'Select account photo'
	$('.overlay').on('click', function() {
		$('#as-f-f').trigger('click');
	});
	// Change selected account photo
	$("#as-f-f").change(function() {
		readURL(this);
	});
	// Change password input
	$("#as-f-password-show").on("change paste keyup", function() {
		$("#as-f-password").val($(this).val());
	});
	// Change show password input
	$("#as-f-password").on("change paste keyup", function() {
		$("#as-f-password-show").val($(this).val());
	});
	// Click button 'Password show/hide'
	$('#as-f-p-v').click(function() {
		var status = $(this).text();

		$(this).text(status === 'visibility' ? 'visibility_off' : 'visibility');

		if (status === 'visibility') {
			$('#as-f-password-show').removeClass('hide');
			$('#as-f-password').addClass('hide');
			$('#as-f-p').attr('for', 'as-f-password-show')
		} else {
			$('#as-f-password-show').addClass('hide');
			$('#as-f-password').removeClass('hide');
			$('#as-f-p').attr('for', 'as-f-password')
		}
	});
	// Click button 'Finish'
	$('#as-n').on('click', function() {
		var proceed = true;

		$("#as-f input:required").toArray().forEach(function(item) {
			if ($(item).val() === '') {
				$(item).addClass("invalid");
				stateChange('as', 'none');
				proceed = false;
				return;
			} else {
				$(item).removeClass("invalid");
			}
		});

		if (!proceed) {
			return;
		}

		var formData = new FormData(document.querySelector("#as-f"));

		$.ajax({
			type: "POST",
			url: "accountSetup.php",
			processData: false,
			contentType: false,
			data: formData,
			success: function(data) {
				if (data == "true") {
					$('.collapsible').collapsible('close', 3);
					stateChange('as', 'done');
				} else {
					stateChange('as', 'none');
				}
			}
		});
	});
});