import React, { Component } from 'react';
import { Helmet } from 'react-helmet';
import AppHeader from '../components/AppHeader/AppHeader';
import StreamContainer from '../components/StreamContainer/StreamContainer';
import { AppGallery, FeaturedGallery } from '../components/AppGallery/AppGallery';
import AppError from '../components/AppError/AppError';
import { API_KEY, RENDER_AD, getRandomSlogan } from '../utilities';
import GoogleAd from '../components/GoogleAd/GoogleAd';

function MetaTags(props){
  return (
    <Helmet>
      <title>{props.title || "TwitchRandom | Random Twitch.tv Streams - Find something unexpected!"}</title>
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
    this.handleSetName = this.handleSetName.bind(this);
  }

  handleSetHistory(url) {
    this.props.history.push(url);
  }

  handleSetName(name) {
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
      this.handleSetName(this.props.match.params.stream)
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
    let galleryTitle = this.props.match.params.game ? this.props.match.params.game + " Streams" : "Random Streams";

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
            onSetName={this.handleSetName}
          />
          {
            RENDER_AD && 
            <section className="horizontal_ad">
              <GoogleAd 
                adStyle={{ display: "inline-block", width: "100%", height: "90px" }}
                client="ca-pub-1737596577801120"
                slot="1996115942"
                responsive="true"
              />
            </section>
          }
          <FeaturedGallery />
          <AppGallery game={this.props.match.params.game} galleryTitle={galleryTitle} />
        </main>
        <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
      </>
    );
  }
}

export default StreamPage;
