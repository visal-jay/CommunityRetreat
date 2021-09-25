document.querySelectorAll(".form-ctrl").forEach(ValidationMessages);

// function to show an error msg on a given field
function addErrorMsg(input, msg) {
	let span = input.closest(".field").querySelector(".field-msg");
	if (!span) {
		span = document.createElement("span");
		input.closest(".field").appendChild(span);
	}
	span.innerHTML = "<i class='fa-exclamation-circle far'></i> &nbsp" + msg;
	span.style.color = "red";
	span.classList.add("field-msg", "fade");
	input.style.borderColor = "red";
}

function clearErrorMsg(input) {
	let msg = input.closest(".field").querySelector(".field-msg");
	if (msg) {
		msg.remove();
	}
	input.style.borderColor = null;
}

function validateField(input) {
	clearErrorMsg(input);
	// validation using built in validations
	if (input.validationMessage) {
		addErrorMsg(input, input.validationMessage);
		return false;
	}

	// extra validation for emails
	if (input.type == "email" && !email_regex.test(input.value)) {
		addErrorMsg(input, "Please enter a valid email");
		return false;
	}

	return true;
}

function ValidationMessages(input) {
	console.log('ssdfsdfdsf');
	let timer;
	input.addEventListener("keyup", (event) => {
		clearTimeout(timer);
		if (event.keyCode != 9) {
			timer = setTimeout(() => validateField(input), 800);
		}
	});

	input.addEventListener("focusout", (event) => validateField(input));
}