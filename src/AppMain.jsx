import React, { Component } from 'react';
import './sass/inline_styles.sass';
import StreamContainer from './components/StreamContainer/StreamContainer';
import { AppGallery, FeaturedGallery } from './components/AppGallery/AppGallery';
import AppError from './components/AppError/AppError';
import { API_KEY } from './utilities';
class AppMain extends Component {
  constructor(props){
    super(props);
    this.state = {
      galleryChannels: [],
      featuredStreams: [],
      // error states
      connection_error: !API_KEY,
      gallery_error: false,
      featured_gallery_error: false
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
        <AppError>Error connecting to Twitch</AppError>
      );
    }

    return (
      <div id="app-main">
        <StreamContainer 
          stream={this.props.match.params.stream}
          game={this.props.match.params.game}
          onSetHistory={this.handleSetHistory}
        />
        <FeaturedGallery />
        <AppGallery />
      </div>
    );
  }
}

export default AppMain;
