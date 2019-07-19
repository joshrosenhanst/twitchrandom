import React from 'react';
import { Link } from 'react-router-dom';

function AppHeader(props) {
  return (
    <>
      <header id="app-header">
        <nav id="header-menu">
          <div className="nav-left">
            <Link to="/" id="logo" title="TwitchRandom Home Page">
              <span id="primary_logo">TwitchRandom</span>
              <span id="slogan">{props.slogan}</span>
            </Link>
          </div>
          <div className="nav-right">
            <Link to="/games/" className="menu-item" title="View All Games">Browse Games</Link>
            <Link to="/" className="menu-item" title="Get a Random Stream">Random Stream</Link>
          </div>
        </nav>
      </header>
      <noscript id="main-noscript">You need to enable JavaScript to view TwitchRandom</noscript>
    </>
  )
}

export default AppHeader;