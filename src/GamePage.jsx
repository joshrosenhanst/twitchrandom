import React, { Component } from 'react';
import Helmet from 'react-helmet';
import AppHeader from './components/AppHeader/AppHeader';
import AppError from './components/AppError/AppError';
import GameList from './components/GameList/GameList';

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
    let page_output = "";
    if(this.state.hasError){
      page_output = <AppError>Error connecting to Twitch</AppError>;
    }else{
      page_output = (
        <main id="app-main">
          <GameList />
        </main>
      );
    }
    return (
      <React.Fragment>
        <Helmet>
          <title>Browse Games | TwitchRandom | Random Twitch.tv Streams - Find something unexpected</title>
          <meta name="desription" content="TwitchRandom.com - Browse all live games. Find something unexpected at https://twitchrandom.com!" />
        </Helmet>
        <AppHeader location={this.props.location} />
        {page_output}
        <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
      </React.Fragment>
    );
  }
}

export default GamePage;