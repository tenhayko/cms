import React, {Component} from 'react';

const FormError = (props) => {
	const isInputValid = (props.errorMessage.length > 0) ? false : true; 
  	if (isInputValid) {return null;}
	return (
	    <div className="form-warning">
	        {props.errorMessage}
	    </div>
	)
}
export default FormError;