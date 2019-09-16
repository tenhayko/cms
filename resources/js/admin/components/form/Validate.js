const validateInput = (type, checkingText) => {
	if (type === "phonenumber") {
        const regexp = /^\d{10,11}$/;
	    const checkingResult = regexp.exec(checkingText);
	    if (checkingResult !== null) {
	        return { isInputValid: true,
	                 errorMessage: ''};
	    } else {
	        return { isInputValid: false,
	                 errorMessage: 'Số điện thoại phải có 10 - 11 chữ số.'};
	    }
    }

    if (type === "fullname") {
        return { isInputValid: true,
	                 errorMessage: ''};
    }
}

export default validateInput;