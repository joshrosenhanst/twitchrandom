import React, { Component } from 'react';
import './sass/inline_styles.sass';
import StreamContainer from './components/StreamContainer/StreamContainer';
import AppGallery from './components/AppGallery/AppGallery';
import AppError from './components/AppError/AppError';
import { ENDPOINTS, fetchTwitchEndpoint, API_KEY, TwitchException, TwitchRandomException } from './TwitchAPI';
import shuffle from 'lodash/shuffle';

class AppMain extends Component {
  constructor(props){
    super(props);
    this.state = {
      channel_data: null,
      channel_offline: false,
      galleryChannels: [],
      featuredStreams: [],
      // error states
      connection_error: !API_KEY,
      stream_error: false,
      gallery_error: false,
      featured_gallery_error: false
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

  caughtError(error) {
    if(error instanceof TwitchException){
      console.log(`Twitch Status ${error.status} - ${error.type}: ${error.message}`);
    }else if(error instanceof TwitchRandomException) {
      console.log(error.message);
      switch(error.status){
        case "NO_KEY":
          this.setState({
            connection_error: true
          });
          break;
        case "NO_STREAM":
        case "NO_USER":
          this.setState({
            stream_error: true,
            connection_error: false
          });
          break;
        case "NO_GALLERY":
          this.setState({
            gallery_error: true,
            connection_error: false
          });
          break;
        case "NO_FEATURED_GALLERY":
          this.setState({
            featured_gallery_error: true,
            connection_error: false
          });
          break;
        default:
          this.setState({
            connection_error: true
          });
          console.log("Error: no matching status.");
      }
    }else{
      console.log(error);
    }
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
          throw new TwitchRandomException("NO_STREAM","Unable to get random stream.");
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
      channel_data: null
    });
    console.log(game);
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=100&game=" + encodeURIComponent(game))
      .then(data => {
        if(data._total > 0){
          let streams = this.shuffleAndSlice(data.streams, 1);
          this.setState({
            channel_data: this.getStreamData(streams[0]),
            channel_offline: false,
            stream_error: false
          });
        }else{
          throw new TwitchRandomException("NO_STREAM","No streams available for this game.");
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
          throw new TwitchRandomException("NO_USER","User not found.");
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
            channel_offline: false,
            stream_error: false
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
    getRandomGalleryChannels() - fetch details for 50 live streams, requested from a random offset. shuffleAndSlice() down to 8 results.
  */
  getRandomGalleryChannels() {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.setState({
      galleryChannels: []
    });
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=100&offset=" + randomNumber)
      .then(data => {
        if(data._total > 0){
          let gallery_streams = this.shuffleAndSlice(data.streams, 8);
          this.setState({
            galleryChannels: this.getGalleryData(gallery_streams),
            gallery_error: false
          });
        }else{
          throw new TwitchRandomException('NO_GALLERY','Unable to fetch gallery.');
        }
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
        if(data.featured.length > 0){
          this.setState({
            featuredStreams: this.getFeaturedStreamData(data.featured),
            featured_gallery_error: false
          });
        }else{
          throw new TwitchRandomException("NO_FEATURED_GALLERY","Unable to fetch featured gallery.");
        }
      })
      .catch(error => {
        this.caughtError(error);
      });
  }

  componentDidMount() {
    if(this.props.match.params.stream){
      this.getStream(this.props.match.params.stream);
    }else if(this.props.match.params.game){
      this.getRandomStreamByGame(this.state.game);
    }else{
      this.getRandomStream();
    }
    this.getRandomGalleryChannels();
    this.getFeaturedGalleryChannels();
  }
  componentDidCatch(error, info) {
    this.caughtError(error);
    console.log(error, info);
  }
  render() {
    console.log("render");
    let stream_template = "";
    let gallery_template = "";
    let featured_gallery_template = "";
    if(this.state.connection_error){
      return (
        <AppError>Error connecting to Twitch</AppError>
      );
    }

    // Get the template for the StreamContainer
    if(this.state.stream_error){
      stream_template = <AppError>Stream Unavailable</AppError>;
    }else if(this.state.channel_offline){
      stream_template = <AppError>Channel Offline</AppError>;
    } else {
      stream_template = (
        <StreamContainer 
          stream={this.props.match.params.stream}
          game={this.props.match.params.game}
          channel={this.state.channel_data}
          onRequestRandom={this.handleRequestStream}
        ></StreamContainer>
      );
    }

    // Get the template for the Featured Gallery
    if(!this.state.featured_gallery_error){
      featured_gallery_template = (
        <AppGallery 
          items={this.state.featuredStreams}
          galleryTitle="Featured Streams"
          featured={true}
        ></AppGallery>
      );
    }

    // Get the template for the Random Gallery
    if(!this.state.gallery_error){
      gallery_template = (
        <AppGallery 
          items={this.state.galleryChannels}
          galleryTitle="Random Streams"
          onRequestRandom={this.handleRequestGallery}
        ></AppGallery>
      );
    }

    return (
      <div id="app-main">
        {stream_template}
        {featured_gallery_template}
        {gallery_template}
      </div>
    );
  }
}

export default AppMain;
