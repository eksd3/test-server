			function validateForename(field) {
				if (field == "") return "No forename was entered.\n";
				else return "";
			}
			
			function validateSurname(field) {
				if (field == "") return "No surname was entered.\n";
				else return "";
			}
			
			function validateUsername(field) {
				if (field == "") return "No username was entered.\n";
				else if (field.length < 5)
					return "Your username must be at least 5 characters long.\n";
				else if (/[^a-zA-Z9-9_-]/.test(field))
					return "Only a-z, A-Z, 0-9, - and _ allowed in usernames.\n";
				else return "";
			}
	
			function validatePassword(field) {
				if (field == "") return "No password was entered.\n";
				else if (field.length < 6)
					return "Your password must be at least 6 characters long.\n";
				else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
					return "Passwords must contain one of each a-z, A-Z and 0-9.\n";
				else return "";
			}

			function validateAge(field) {
				if (isNaN(field)) return "No age was entered.\n";
				if (field < 18 || field > 110)
					return "Age must be between 18 and 110.\n";
				else return "";
			}

			function validateEmail(field) {
				if (field == "") return "No email was entered.\n";
				else if (!((field.indexOf(".") > 0) &&
					(field.indexOf("@") > 0)) ||
					/[^a-zA-z0-9.@_-]/.test(field))
					return "Invalid email.\n";
				else return "";
			}

			function validate(form) {
				fail = validateForename(form.forename.value);
				fail += validateSurname(form.surname.value);
				fail += validateUsername(form.username.value);
				fail += validatePassword(form.password.value);
				fail += validateAge(form.age.value);
				fail += validateEmail(form.email.value);

				if (fail == "") return true;
				else {
					alert(fail);
					return false;
				}
			}
