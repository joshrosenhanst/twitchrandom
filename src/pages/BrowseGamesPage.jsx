import React, { Component } from 'react';
import { Helmet } from 'react-helmet';
import AppHeader from '../components/AppHeader/AppHeader';
import AppError from '../components/AppError/AppError';
import GameList from '../components/GameList/GameList';
import { getRandomSlogan } from '../utilities';

function MetaTags(props){
  return (
    <Helmet>
      <title>{props.title || "Browse Games | TwitchRandom"}</title>
    </Helmet>
  );
}

class BrowseGamesPage extends Component {
  constructor(props) {
    super(props);
    this.state = {
      hasError: false,
      slogan: getRandomSlogan()
    };
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
        <>
          <MetaTags />
          <AppHeader slogan={this.state.slogan} />
          <AppError>Error connecting to Twitch</AppError>
          <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
        </>
      );
    }
    return (
      <>
        <MetaTags />
        <AppHeader slogan={this.state.slogan} />
        <main id="app-main">
          <GameList />
        </main>
        <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
      </>
    );
  }
}

export default BrowseGamesPage;