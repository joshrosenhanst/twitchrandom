import React, { Component } from 'react';
import './sass/inline_styles.sass';
import AppHeader from './components/AppHeader/AppHeader';
import StreamContainer from './components/StreamContainer/StreamContainer';
import { AppGallery, FeaturedGallery } from './components/AppGallery/AppGallery';
import AppError from './components/AppError/AppError';
import { API_KEY } from './utilities';

class StreamPage extends Component {
  constructor(props){
    super(props);
    this.state = {
      reloadStream: false,
      connection_error: !API_KEY,
    };

    this.handleSetHistory = this.handleSetHistory.bind(this);
    this.handleDoneReload = this.handleDoneReload.bind(this);
  }

  handleSetHistory(url) {
    this.props.history.push(url);
  }

  handleDoneReload(e) {
    this.setState({
      reloadStream: false
    });
  }

  componentDidUpdate(prevProps) {
    if(this.props.forceReload && this.props.forceReload !== prevProps.forceReload){
      this.setState({
        reloadStream: true
      });
    }
  }

  componentDidCatch(error, info) {
    console.log(error, info);
  }

  render() {
    if(this.state.connection_error){
      return (
        <React.Fragment>
          <AppHeader />
          <AppError>Error connecting to Twitch</AppError>
          <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
        </React.Fragment>
      );
    }

    return (
      <React.Fragment>
        <AppHeader 
          reloadSlogan={this.state.reloadStream} 
        />
        <main id="app-main">
          <StreamContainer 
            stream={this.props.match.params.stream}
            game={this.props.match.params.game}
            onSetHistory={this.handleSetHistory}
            forceReload={this.state.reloadStream}
            onDoneReload={this.handleDoneReload}
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
