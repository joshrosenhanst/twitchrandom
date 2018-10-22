import React, { Component } from 'react';
import './sass/inline_styles.sass';
import Helmet from 'react-helmet';
import AppHeader from './components/AppHeader/AppHeader';
import StreamContainer from './components/StreamContainer/StreamContainer';
import { AppGallery, FeaturedGallery } from './components/AppGallery/AppGallery';
import AppError from './components/AppError/AppError';
import { API_KEY } from './utilities';

class StreamPage extends Component {
  constructor(props){
    super(props);
    this.state = {
      connection_error: !API_KEY,
    };

    this.handleSetHistory = this.handleSetHistory.bind(this);
  }

  handleSetHistory(url) {
    this.props.history.push(url);
  }

  componentDidCatch(error, info) {
    console.log(error, info);
  }

  render() {
    if(this.state.connection_error){
      return (
        <React.Fragment>
          <Helmet>
            <title>TwitchRandom | Random Twitch.tv Streams - Find something unexpected</title>
            <meta name="description" content="TwitchRandom.com finds random Twitch streams for you. Find something unexpected at https://twitchrandom.com!" />
          </Helmet>
          <AppHeader location={this.props.location} />
          <AppError>Error connecting to Twitch</AppError>
          <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
        </React.Fragment>
      );
    }

    return (
      <React.Fragment>
        <Helmet>
          <title>TwitchRandom | Random Twitch.tv Streams - Find something unexpected</title>
          <meta name="description" content="TwitchRandom.com finds random Twitch streams for you. Find something unexpected at https://twitchrandom.com!" />
        </Helmet>
        <AppHeader location={this.props.location} />
        <main id="app-main">
          <StreamContainer 
            location={this.props.location}
            stream={this.props.match.params.stream}
            game={this.props.match.params.game}
            onSetHistory={this.handleSetHistory}
          />
          <FeaturedGallery />
          <AppGallery />
        </main>
        <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
      </React.Fragment>
    );
  }
}

export default StreamPage;
