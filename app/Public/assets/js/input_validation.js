
const tel_regex= /^[+]?[0-9]{10,11}$/ ;
const password_regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

document.querySelectorAll(".form-ctrl").forEach(ValidationMessages);


// function to show an error msg on a given field
function addErrorMsg(input, msg) {
	let span = input.previousElementSibling;
	if(span)
		if (!span.classList.contains("input-error")) {
			span = document.createElement("span");
			input.insertAdjacentElement("beforebegin",span);
		}
	else{
		span = document.createElement("span");
		input.insertAdjacentElement("beforebegin",span);
	}
	
	span.classList.add("input-error");
	span.innerHTML = "<i class='fas fa-exclamation-circle'></i> &nbsp" + msg;
	span.style.color = "red";
	span.style.fontSize = "0.7rem";
	input.style.borderColor = "red";
}

function clearErrorMsg(input) {
	let msg = input.previousElementSibling;
	if (msg) {
	
		if (msg.classList.contains("input-error"))
			msg.remove();
	}
	input.style.borderColor = null;
}

async function validateField(input) {
	clearErrorMsg(input);
	// validation using built in validations
	if (input.validationMessage) {
		addErrorMsg(input, input.validationMessage);
		return false;
	}

	// extra validation for emails
	if (input.type == "email" && await checkMail(input.value)) {
		addErrorMsg(input, "Email already taken");
		return false;
	}

	if (input.type == "tel" && !tel_regex.test(input.value)) {
		addErrorMsg(input, "Please enter a valid telephone number");
		return false;
	}

	if (input.type == "password" && !password_regex.test(input.value) && input.classList.contains("password-error")) {
		addErrorMsg(input, "Strong password required Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols");
		return false;
	}

	if(input.name=="username" && input.value.length>=10){
		addErrorMsg(input, "Use less than 10 charachters");
		return false;
	}


	return true;
}

function ValidationMessages(input) {
	let timer;
	input.addEventListener("keyup", (event) => {
		clearTimeout(timer);
		if (event.keyCode != 9) {
			timer = setTimeout(() => validateField(input), 500);
		}
	});

	input.addEventListener("focusout", (event) => validateField(input));
}

function checkMail(email) {
	console.log("sdfsdfsdfsd");
	return new Promise((resolve,reject)=>{
		$.ajax({
			url: "/Signup/checkEmailAvailable", //the page containing php script
			type: "post", //request type,
			dataType: 'json',
			data: {
				email: email
			},
			success: function(result) {
				if (result.taken == true) {
					resolve(true);
					var err = "<i class='fas fa-exclamation-circle'></i> &nbsp Email already taken";
				} else
					resolve(false);
			}
		});
	})
}