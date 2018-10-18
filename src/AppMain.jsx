import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import './sass/inline_styles.sass';
import StreamContainer from './components/StreamContainer/StreamContainer';
import AppGallery from './components/AppGallery/AppGallery';
import { ENDPOINTS, fetchTwitchEndpoint, API_KEY } from './TwitchAPI';
import { ReactComponent as Logo} from './logo.svg';
import shuffle from 'lodash/shuffle';

class AppMain extends Component {
  constructor(props){
    super(props);
    this.state = {
      stream: props.match.params.stream || null,
      game: props.match.params.game || null,
      channel_data: null,
      channel_offline: false,
      galleryChannels: [],
      featuredStreams: [],
      hasError: false
    };
    console.log(this.state.stream);
    console.log(this.state.game);
    this.handleRequestStream = this.handleRequestStream.bind(this);
    this.handleRequestGallery = this.handleRequestGallery.bind(this);
  }

  handleRequestStream() {
    this.getRandomStream();
  }
  handleRequestGallery() {
    this.getRandomGalleryChannels();
  }

  caughtError(error) {
    this.setState({
      hasError: true
    });
    console.log(error);
  }

  /*
    shuffleAndSlice(array, limit) - Shuffle an array and then return a limited number of cells. Uses the lodash shuffle function (which uses a version of the Fisher-Yates shuffle )
  */
  shuffleAndSlice(array, limit){
    if(limit > array.length) limit = array.length;

    return shuffle(array).slice(0, limit);
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
    getRandomStream() - fetch details for a live stream, requested from a random offset.
    There are thousands of live streams at any time, so we can just plug a random offset in and grab a game.
  */
  getRandomStream(game = null) {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.setState({
      stream: null,
      channel_data: null
    });
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=1&offset=" + randomNumber)
      .then(data => {
        if(data._total > 0){
          this.setState({
            channel_data: this.getStreamData(data.streams[0]),
            channel_offline: false
          });
        }else{
          this.caughtError("Unable to get random stream.");
        }
      })
      .catch(error => {
        this.caughtError(error);
      });
  }

  /*
    getRandomStreamByGame() - fetch details for a live stream, filtered by game name.
    Grab the top 100 streams for this game, then shuffle and return 1 stream using shuffleAndSlice(). 
  */
  getRandomStreamByGame(game){
    this.setState({
      stream: null,
      channel_data: null
    });
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=100&game=" + game)
      .then(data => {
        if(data._total > 0){
          let streams = this.shuffleAndSlice(data.streams, 1);
          this.setState({
            channel_data: this.getStreamData(streams[0]),
            channel_offline: false
          });
        }else{
          this.caughtError("No streams available for this game.");
        }
      })
      .catch(error => {
        this.caughtError(error);
      });
  }

  /*
    getChannelID(name) - v5 of the Twitch API requires a channel ID to get stream info, rather than a channel name. getChannelID(name) sends a query with the name and returns a promise with the ID.
  */
  async getChannelID(name) {
    return fetchTwitchEndpoint(ENDPOINTS.USERS, "?login="+name)
      .then(data => {
        if(data._total > 0){
          return data.users[0]._id;
        }else{
          return false;
        }
      });
  }

  /*
    getStream() - fetch details for a stream, specified by channel name.
  */
  getStream(stream) {
    this.setState({
      channel_data: null
    });
    this.getChannelID(stream)
      .then(id => fetchTwitchEndpoint(ENDPOINTS.STREAMS + id))
      .then(data => {
        if(data.stream){
          this.setState({
            channel_data: this.getStreamData(data.stream),
            channel_offline: false
          });
        }else{
          this.setState({
            channel_offline: true
          });
        }
      })
      .catch(error => {
        this.caughtError(error);
      });
  }

  /*
    getRandomGalleryChannels() - fetch details for 8 live streams, requested from a random offset.
  */
  getRandomGalleryChannels() {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.setState({
      galleryChannels: []
    });
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=8&offset=" + randomNumber)
      .then(data => {
        this.setState({
          galleryChannels: this.getGalleryData(data.streams)
        });
      })
      .catch(error => {
        this.caughtError(error);
      });
  }

  /*
    getFeaturedGalleryChannels() - fetch details for the top 3 featured streams.
  */
  getFeaturedGalleryChannels() {
    fetchTwitchEndpoint(ENDPOINTS.FEATURED_STREAMS, "?limit=3")
      .then(data => {
        this.setState({
          featuredStreams: this.getFeaturedStreamData(data.featured)
        });
      })
      .catch(error => {
        this.caughtError(error);
      });
  }

  componentDidMount() {
    if(this.state.stream){
      console.log("get stream");
      console.log(ENDPOINTS.STREAMS + this.state.stream)
      this.getStream(this.state.stream);
    }else if(this.state.game){
      console.log("get game");
      this.getRandomStreamByGame(this.state.game);
    }else{
      console.log("get random");
      this.getRandomStream();
    }
    this.getRandomGalleryChannels();
    this.getFeaturedGalleryChannels();
  }
  componentDidCatch(error, info) {
    this.setState({
      hasError: true
    });
    console.log(error, info);
  }
  render() {
    if(!API_KEY || this.state.hasError){
      return (
        <div id="app-error">
          <h2>Error connecting to Twitch</h2>
        </div>
      );
    }
    if(this.state.channel_offline){
      return (
        <div id="app-error">
          <h2>Channel Offline</h2>
          <Link to="/" className="main-button"><Logo /> Go to the Home Page</Link>
        </div>
      );
    }
    return (
      <div id="app-main">
        <StreamContainer 
          channel={this.state.channel_data}
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
