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
    'Client-ID': API_KEY,
    'Accept': 'application/vnd.twitchtv.v5+json'
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
    this.handleRequestStream = this.handleRequestStream.bind(this);
    this.handleRequestGallery = this.handleRequestGallery.bind(this);
  }

  handleRequestStream() {
    this.getRandomStream();
  }
  handleRequestGallery() {
    this.getRandomGalleryChannels();
  }

  /*
    getStreamData() - Map the properties in the stream object into a new object.
    stream - single object from the Twitch API JSON response.
  */
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

  /*
    getGalleryData() - Map all of the gallery streams in the array using getStreamData().
    streams - array of stream objects from the Twitch API JSON response.
  */
  getGalleryData(streams) {
    return streams.map(item => this.getStreamData(item))
  }

  /*
    getFeaturedStreamData() - Map all of the featured streams in the array using getStreamData().
    streams - array of stream objects from the Twitch API JSON response.
  */
  getFeaturedStreamData(streams){
    return streams.map(item => this.getStreamData(item.stream))
  }

  /*
    fetchTwitchEndpoint() - Use the Fetch API to request data from Twitch. Returns a promise which resolves to a JSON object.
  */
  async fetchTwitchEndpoint(endpoint, query){
    return fetch(API_URL + endpoint + query, AUTH_HEADERS)
      .then(response => response.json())
      .catch(error => console.log(error));
  }
  
  /*
    getRandomStream() - fetch details for 1 live stream, requested from a random offset.
  */
  getRandomStream() {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.setState({
      channel: null
    });
    this.fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=1&offset=" + randomNumber)
      .then(data => {
        this.setState({
          channel: this.getStreamData(data.streams[0])
        });
      })
  }

  /*
    getRandomGalleryChannels() - fetch details for 8 live streams, requested from a random offset.
  */
  getRandomGalleryChannels() {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.setState({
      galleryChannels: []
    });
    this.fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=8&offset=" + randomNumber)
      .then(data => {
        this.setState({
          galleryChannels: this.getGalleryData(data.streams)
        });
      });
  }

  /*
    getFeaturedGalleryChannels() - fetch details for the top 3 featured streams.
  */
  getFeaturedGalleryChannels() {
    this.fetchTwitchEndpoint(ENDPOINTS.FEATURED_STREAMS, "?limit=3")
      .then(data => {
        this.setState({
          featuredStreams: this.getFeaturedStreamData(data.featured)
        });
      });
  }

  componentDidMount() {
    this.getRandomStream();
    this.getRandomGalleryChannels();
    this.getFeaturedGalleryChannels();
  }
  render() {
    return (
      <div id="app-main">
        <StreamContainer 
          channel={this.state.channel}
          onRequestRandom={this.handleRequestStream}
        ></StreamContainer>
        <AppGallery 
          items={this.state.featuredStreams}
          galleryTitle="Featured Streams"
          featured={true}
        ></AppGallery>
        <AppGallery 
          items={this.state.galleryChannels}
          galleryTitle="Random Streams"
          onRequestRandom={this.handleRequestGallery}
        ></AppGallery>
      </div>
    );
  }
}

export default AppMain;
