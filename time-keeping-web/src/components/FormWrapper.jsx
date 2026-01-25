import React from "react";

function FormWrapper({ title, children, onSubmit }) {
  return (
    <form onSubmit={onSubmit} className="form-wrapper">
      {title && <h2>{title}</h2>}
      {children}
    </form>
  );
}

export default FormWrapper;
