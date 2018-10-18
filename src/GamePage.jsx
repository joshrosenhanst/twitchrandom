import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import GameList from './components/GameList/GameList';
import { ReactComponent as Logo} from './logo.svg';

class GamePage extends Component {
  constructor(props) {
    super(props);
    this.state = {
      hasError: false
    }
  }
  componentDidCatch(error, info) {
    this.setState({
      hasError: true
    });
    console.log(error, info);
  }
  render () {
    if(this.state.hasError){
      return (
        <div id="app-error">
          <h2>Error connecting to Twitch</h2>
          <Link to="/" className="main-button"><Logo /> Go to the Home Page</Link>
        </div>
      );
    }
    return (
      <div id="app-main">
        <GameList />
      </div>
    );
  }
}

export default GamePage;