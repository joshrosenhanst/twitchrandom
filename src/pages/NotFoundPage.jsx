import React, { useState } from 'react';
import AppHeader from '../components/AppHeader/AppHeader';
import AppError from '../components/AppError/AppError';
import { getRandomSlogan } from '../slogans';

function NotFoundPage(props) {
  const [slogan] = useState(getRandomSlogan());

  return (
    <>
      <AppHeader slogan={slogan} />
      <AppError>Page Not Found</AppError>
      <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
    </>
  );
}

export default NotFoundPage;