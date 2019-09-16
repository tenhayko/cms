import React, {Component} from 'react';

const FormError = (props) => {
  if (props.isHidden) {return null;}
  return (
    <div className="form-warning">
        {props.errorMessage}
    </div>
  )
}
export default FormError;