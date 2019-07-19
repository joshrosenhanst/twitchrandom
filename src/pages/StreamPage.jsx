import React, { Component } from 'react';
import '../sass/inline_styles.sass';
import Helmet from 'react-helmet';
import AppHeader from '../components/AppHeader/AppHeader';
import StreamContainer from '../components/StreamContainer/StreamContainer';
import { AppGallery, FeaturedGallery } from '../components/AppGallery/AppGallery';
import AppError from '../components/AppError/AppError';
import { API_KEY } from '../utilities';
import { getRandomSlogan } from '../slogans';

function MetaTags(props){
  return (
    <Helmet>
      <title>{props.title || "TwitchRandom | Random Twitch.tv Streams - Find something unexpected!"}</title>
      <meta name="description" content="TwitchRandom finds random Twitch streams for you. Find something unexpected!" />
    </Helmet>
  );
}

class StreamPage extends Component {
  constructor(props){
    super(props);
    this.state = {
      connection_error: !API_KEY,
      slogan: getRandomSlogan(),
      title: null
    };

    this.handleSetHistory = this.handleSetHistory.bind(this);
    this.handleGetSlogan = this.handleGetSlogan.bind(this);
  }

  handleSetHistory(url, name=null) {
    this.props.history.push(url);
    if(name){
      this.setState({
        title: name + " | TwitchRandom"
      });
    }
  }

  handleGetSlogan() {
    this.setState({
      slogan: getRandomSlogan()
    });
  }

  componentDidCatch(error, info) {
    console.log(error, info);
  }

  componentDidMount() {
    if(this.props.match.params.stream){
      this.setState({
        title: this.props.match.params.stream + " | TwitchRandom"
      });
    }
  }

  render() {;
    if(this.state.connection_error){
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
        <MetaTags title={this.state.title} />
        <AppHeader slogan={this.state.slogan} />
        <main id="app-main">
          <StreamContainer 
            location={this.props.location}
            stream={this.props.match.params.stream}
            game={this.props.match.params.game}
            onSetHistory={this.handleSetHistory}
            onGetSlogan={this.handleGetSlogan}
          />
          <FeaturedGallery />
          <AppGallery />
        </main>
        <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
      </>
    );
  }
}

export default StreamPage;
