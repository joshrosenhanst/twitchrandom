import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import './StreamContainer.sass';
import StreamEmbed from '../StreamEmbed/StreamEmbed';
import ChatEmbed from '../ChatEmbed/ChatEmbed';
import AppError from '../AppError/AppError';
import { ENDPOINTS, fetchTwitchEndpoint, TwitchRandomException, getStreamData, shuffleAndSlice, getChannelID, getChatActive, updateLocalData } from '../../utilities';
import { ReactComponent as Logo } from '../../icons/logo.svg';
import { ReactComponent as CommentSlashIcon } from '../../icons/comment-slash.svg';

const ChatToggleButton = (props) => {
  if(props.active){
    return (
      <button className="toggle-chat active" onClick={props.toggleChat}><CommentSlashIcon /> Hide Chat</button>
    )
  }else{
    return null;
  }
};

class StreamContainer extends Component {
  constructor(props) {
    super(props);
    this.state = {
      stream_error: false,
      channel_offline: false,
      channel: {},
      chat_active: getChatActive() 
    }
    this.handleGetRandom = this.handleGetRandom.bind(this);
    this.toggleChat = this.toggleChat.bind(this);
  }

  handleGetRandom(e) {
    e.preventDefault();
    this.getRandomStream();
  }

  toggleChat() {
    let chat_active = !this.state.chat_active;
    this.setState({
      chat_active
    });
    updateLocalData('chat_active', chat_active);
  }

  /*
    getRandomStream() - fetch details for a live stream, requested from a random offset.
    There are thousands of live streams at any time, so we can just plug a random offset in and grab a game.
  */
  getRandomStream(updateURL = false) {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.props.onGetSlogan();
    this.setState({
      channel: null,
      stream_error: false,
      channel_offline: false
    });
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=1&offset=" + randomNumber)
      .then(data => {
        if(data._total > 0){
          this.setState({
            channel: getStreamData(data.streams[0])
          }, () => {
            if(updateURL){
              this.props.onSetHistory("/streams/"+this.state.channel.name);
            }
          });
        }else{
          throw new TwitchRandomException("NO_STREAM","Unable to get random stream.");
        }
      })
      .catch(error => {
        console.log(error);
        this.setState({
          stream_error: true
        });
      });
  }

  /*
    getRandomStreamByGame() - fetch details for a live stream, filtered by game name.
    Grab the top 100 streams for this game, then shuffle and return 1 stream using shuffleAndSlice(). 
  */
  getRandomStreamByGame(game){
    this.setState({
      channel: null,
      stream_error: false,
      channel_offline: false
    });
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=100&game=" + encodeURIComponent(game))
      .then(data => {
        if(data._total > 0){
          let streams = shuffleAndSlice(data.streams, 1);
          this.setState({
            channel: getStreamData(streams[0])
          });
        }else{
          throw new TwitchRandomException("NO_STREAM","No streams available for this game.");
        }
      })
      .catch(error => {
        console.log(error);
        this.setState({
          stream_error: true
        });
      });
  }

  /*
    getStream() - fetch details for a stream, specified by channel name.
  */
  getStream(stream) {
    this.setState({
      channel: null,
      channel_offline: false,
      stream_error: false
    });
    getChannelID(stream)
      .then(id => fetchTwitchEndpoint(ENDPOINTS.STREAMS + id))
      .then(data => {
        if(data.stream){
          this.setState({
            channel: getStreamData(data.stream)
          });
        }else{
          this.setState({
            channel_offline: true
          });
        }
      })
      .catch(error => {
        console.log(error);
        this.setState({
          stream_error: true
        });
      });
  }

  componentDidMount() {
    if(this.props.stream){
      this.getStream(this.props.stream);
    }else if(this.props.game){
      this.getRandomStreamByGame(this.props.game);
    }else{
      this.getRandomStream();
    }
  }

  componentDidUpdate(prevProps) {
    // if we just switched to the home page, get a random stream
    if(this.props.location.pathname === "/" && this.props.location !== prevProps.location){
      this.getRandomStream();
    }

    if(this.props.stream){
      // before we grab the stream, check that we aren't already displaying it
      if(this.state.channel && this.state.channel.name !== this.props.stream){
        if(this.props.stream !== prevProps.stream){
          this.getStream(this.props.stream);
          window.scrollTo(0,0);
        }
      }
    }else if(this.props.game){
      if(this.props.game !== prevProps.game){
        this.getRandomStreamByGame(this.props.game);
        window.scrollTo(0,0);
      }
    }
  }

  render() {
    if(this.state.stream_error){
      return <AppError>Stream Unavailable</AppError>;
    }
    
    if(this.state.channel_offline){
      return <AppError>Channel Offline</AppError>;
    }

    if(this.state.channel && this.state.channel.id){
      let bannerStyle = {
        backgroundImage: `url(${this.state.channel.banner})`
      }
      return (
        <section id="stream-embed-section" style={bannerStyle}>
          <div id="stream-container">
            <StreamEmbed id="stream-embed" channel={this.state.channel.name}></StreamEmbed>
            <div id="stream-info">
              <div id="stream-meta">
                <Link to={"/streams/"+this.state.channel.name} className="channel_logo">
                  <img src={this.state.channel.logo} alt={this.state.channel.name+" logo"} />
                </Link>
                <div className="channel_info">
                  <Link to={"/streams/"+this.state.channel.name} className="channel_name">
                    <h1 className="stream_name">{this.state.channel.name}</h1>
                  </Link>
                  { (this.state.channel.game) && (
                    <div className="channel_game">
                      Playing <Link to={"/games/"+this.state.channel.game}>{this.state.channel.game}</Link>
                    </div>
                  ) }
                  <div className="channel_sub">
                    <span className="channel_viewers">{this.state.channel.viewers} Viewers</span>
                    <ChatToggleButton active={this.state.chat_active} toggleChat={this.toggleChat} />
                  </div>
                </div>
              </div>
              <ChatEmbed channel={this.state.channel.name} active={this.state.chat_active} toggleChat={this.toggleChat} />
              <div id="random-stream-button">
                <Link to="/" className="main-button" title="Get Random Stream">
                  <Logo /> Random Stream
                </Link>
              </div>
            </div>
          </div>
        </section>
      );
    }else{
      return (
        <section id="stream-embed-section">
          <div id="stream-container">
            <div className="loading">
              <Logo />
              <div>Loading Stream</div>
            </div>
          </div>
        </section>
      );
    }
  }
}

export default StreamContainer;
