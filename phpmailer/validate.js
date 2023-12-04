/* <![CDATA[ */

/// Jquery validate newsletter
$('#newsletter_form').submit(function () {

	var action = $(this).attr('action');

	$("#message-newsletter").slideUp(750, function () {
		$('#message-newsletter').hide();

		$('#submit-newsletter')
			.attr('disabled', 'disabled');

		$.post(action, {
				email_newsletter: $('#email_newsletter').val()
			},
			function (data) {
				document.getElementById('message-newsletter').innerHTML = data;
				$('#message-newsletter').slideDown('slow');
				$('#submit-newsletter').removeAttr('disabled');
				if (data.match('success') != null) $('#newsletter_form').slideUp('slow');

			}
		);

	});
	return false;
});

// Jquery validate form contact
$('#bookingform').submit(function () {

	var action = $(this).attr('action');

	$("#message-booking").slideUp(750, function () {
		$('#message-booking').hide();

		$('#submit-booking')
			.attr('disabled', 'disabled');

		$.post(action, {
				date_booking: $('#date_booking').val(),
				rooms_booking: $('#rooms_booking').val(),
				adults_booking: $('#adults_booking').val(),
				childs_booking: $('#childs_booking').val(),
				name_booking: $('#name_booking').val(),
				email_booking: $('#email_booking').val(),
				verify_booking: $('#verify_booking').val()
			},
			function (data) {
				document.getElementById('message-booking').innerHTML = data;
				$('#message-booking').slideDown('slow');
				$('#submit-booking').removeAttr('disabled');
				if (data.match('success') != null) $('#bookingform').slideUp('slow');

			}
		);

	});
	return false;
});

// Jquery validate form contact
$('#contactform').submit(function () {

	var action = $(this).attr('action');

	$("#message-contact").slideUp(750, function () {
		$('#message-contact').hide();

		$('#submit-contact')
			.attr('disabled', 'disabled');

		$.post(action, {
				name_contact: $('#name_contact').val(),
				lastname_contact: $('#lastname_contact').val(),
				email_contact: $('#email_contact').val(),
				phone_contact: $('#phone_contact').val(),
				message_contact: $('#message_contact').val(),
				verify_contact: $('#verify_contact').val()
			},
			function (data) {
				document.getElementById('message-contact').innerHTML = data;
				$('#message-contact').slideDown('slow');
				$('#submit-contact').removeAttr('disabled');
				if (data.match('success') != null) $('#contactform').slideUp('slow');

			}
		);

	});
	return false;
});

/* ]]> */