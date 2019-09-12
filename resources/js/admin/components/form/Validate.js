const validateInput = (checkingText) => {
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

export default validateInput;