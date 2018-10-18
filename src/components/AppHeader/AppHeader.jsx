import React, { Component } from 'react';

const sloganList = [
    "Find Something Unexpected","Mid or feed", "Putting the rude in Darude", "Entire team is babies", "Where is Mankrik's wife?", "Eh! Steve!", "Sexy Wisp Cosplay", "Spline Reticulators Inc", "Excessive Donger Spam", "༼つ ◕_◕ ༽つ", "Do a Barrel Roll", "Diagnosis: Delicious"
];

class AppHeader extends Component {
  constructor(props){
    super(props);
    this.randomSlogan = this.getRandomSlogan();
  }

  getRandomSlogan() {
    return sloganList[Math.floor(Math.random() * sloganList.length)];
  }

  render() {
    return (
      <nav id="header-menu">
        <div className="nav-left">
          <a href="/" id="logo" title="TwitchRandom Home Page">
            <span id="primary_logo">TwitchRandom</span>
            <span id="slogan">{this.randomSlogan}</span>
          </a>
        </div>
        <div className="nav-right">
          <a href="/games" className="menu-item" title="View All Games">Browse Games</a>
          <a href="/random" className="menu-item" title="Get a Random Stream">Random Stream</a>
        </div>
      </nav>
    );
  }
}

export default AppHeader;
