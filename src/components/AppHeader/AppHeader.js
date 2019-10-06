import React from 'react';
import { Link } from 'react-router-dom';
import { ReactComponent as Logo } from '../../icons/logo.svg';

function AppHeader(props) {
  return (
    <>
      <header id="app-header">
        <nav id="header-menu">
          <div className="nav-left">
            <Link to="/" id="logo" title="TwitchRandom Home Page">
              <Logo />
              <div id="logo_text">
                <span id="primary_logo">TwitchRandom</span>
                <span id="slogan">{props.slogan}</span>
              </div>
            </Link>
          </div>
          <div className="nav-right">
            <Link to="/games/" className="menu-item" title="View All Games">Browse Games</Link>
            <Link to="/random" className="menu-item" title="Get a Random Stream">Random Stream</Link>
          </div>
        </nav>
      </header>
      <noscript id="main-noscript">You need to enable JavaScript to view TwitchRandom</noscript>
    </>
  )
}

export default AppHeader;