import React from 'react';
import { ReactComponent as Logo } from '../../icons/logo.svg';
import { Link } from 'react-router-dom';

function AppError(props) {
  return (
    <main id="app-error">
      <h2>{props.children}</h2>
      <Link to="/" className="main-button"><Logo /> Go to the Home Page</Link>
    </main>
  );
}

export default AppError;