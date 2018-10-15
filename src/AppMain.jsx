import React, { Component } from 'react';
import './AppMain.sass';
import StreamContainer from './components/StreamContainer/StreamContainer';
import AppGallery from './components/AppGallery/AppGallery';

const API_KEY = process.env.REACT_APP_TWITCH_API_KEY;
const API_URL = "https://api.twitch.tv/kraken";
const ENDPOINTS = {
  STREAMS: "/streams/",
  FEATURED_STREAMS: "/streams/featured/",
  GAMES: "/games/"
}
const AUTH_HEADERS = {
  headers: {
    'Client-ID': API_KEY
  }
};

class AppMain extends Component {
  constructor(props){
    super(props);
    this.state = {
      channel: null,
      galleryChannels: [],
      featuredStreams: []
    };
    this.handleRequestRandom = this.handleRequestRandom.bind(this)
  }
  getStreamData(stream) {
    return {
      id: stream.channel._id,
      name: stream.channel.name,
      title: stream.channel.status,
      logo: stream.channel.logo,
      game: stream.game,
      viewers: stream.viewers,
      banner: stream.channel.profile_banner,
      preview: stream.preview.large
    };
  }
  getGalleryData(streams) {
    return streams.map(item => this.getStreamData(item))
  }
  getFeaturedStreamData(streams){
    return streams.map(item => this.getStreamData(item.stream))
  }
  handleRequestRandom() {
    this.getRandomChannels();
  }
  
  /*
    getRandomChannels() - get details about 4 live streams, requested from a random offset. The first item becomes the embedded stream, the other items become the random gallery.
  */
  getRandomChannels() {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.setState({
      channel: null,
      galleryChannels: []
    });
    fetch(API_URL+ENDPOINTS.STREAMS + "?limit=9&offset=" + randomNumber, AUTH_HEADERS)
      .then(response => response.json())
      .then((data) => {
        console.log(data);
        let mainChannel = data.streams.shift();
        this.setState({
          channel: this.getStreamData(mainChannel),
          galleryChannels: this.getGalleryData(data.streams)
        });
      })
      .catch(error => console.log(error));
  }

  getFeaturedGalleryChannels() {
    fetch(API_URL+ENDPOINTS.FEATURED_STREAMS + "?limit=3", AUTH_HEADERS)
      .then(response => response.json())
      .then(data => {
        this.setState({
          featuredStreams: this.getFeaturedStreamData(data.featured)
        });
      })
      .catch(error => console.log(error));
  }

  componentDidMount() {
    this.getRandomChannels();
    this.getFeaturedGalleryChannels();
  }
  render() {
    return (
      <div id="app-main">
        <StreamContainer 
          channel={this.state.channel}
          onRequestRandom={this.handleRequestRandom}
        ></StreamContainer>
        <AppGallery 
          items={this.state.featuredStreams}
          galleryTitle="Featured Streams"
          featured={true}
        ></AppGallery>
        <AppGallery 
          items={this.state.galleryChannels}
          galleryTitle="Random Streams"
          onRequestRandom={this.handleRequestRandom}
        ></AppGallery>
      </div>
    );
  }
}

export default AppMain;
// <StreamContainer></StreamContainer>
