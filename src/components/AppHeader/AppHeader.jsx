import React, { Component } from 'react';
import { Link } from 'react-router-dom';

const sloganList = [
    "Find Something Unexpected","Mid or feed", "Putting the rude in Darude", "Entire team is babies", "Where is Mankrik's wife?", "Eh! Steve!", "Sexy Wisp Cosplay", "Spline Reticulators Inc", "Excessive Donger Spam", "༼つ ◕_◕ ༽つ", "Do a Barrel Roll", "Diagnosis: Delicious"
];

class AppHeader extends Component {
  constructor(props){
    super(props);
    this.state = {
      randomSlogan: this.getRandomSlogan()
    };
  }

  getRandomSlogan() {
    return sloganList[Math.floor(Math.random() * sloganList.length)];
  }

  componentDidUpdate(prevProps) {
    if(this.props.location.pathname !== "/" && this.props.location !== prevProps.location){
      // location has changed, get a new slogan
      this.setState({
        randomSlogan: this.getRandomSlogan()
      });
    }
  }

  render() {
    return (
      <React.Fragment>
        <header id="app-header">
          <nav id="header-menu">
            <div className="nav-left">
              <Link to="/" id="logo" title="TwitchRandom Home Page">
                <span id="primary_logo">TwitchRandom</span>
                <span id="slogan">{this.state.randomSlogan}</span>
              </Link>
            </div>
            <div className="nav-right">
              <Link to="/games/" className="menu-item" title="View All Games">Browse Games</Link>
              <Link to="/" className="menu-item" title="Get a Random Stream">Random Stream</Link>
            </div>
          </nav>
        </header>
        <noscript id="main-noscript">You need to enable JavaScript to view TwitchRandom</noscript>
      </React.Fragment>
    );
  }
}

export default AppHeader;
