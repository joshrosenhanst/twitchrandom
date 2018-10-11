import React, { Component } from 'react';
import './AppMain.sass';
import StreamContainer from './components/StreamContainer/StreamContainer';

const API_KEY = process.env.REACT_APP_TWITCH_API_KEY;
const API_URL = "https://api.twitch.tv/kraken";
const ENDPOINTS = {
  STREAMS: "/streams/",
  GAMES: "/games/"
}

class AppMain extends Component {
  constructor(props){
    super(props);
    this.state = {
      channel: null
    };
  }
  getStreamData(stream) {
    return {
      name: stream.channel.name,
      title: stream.channel.status,
      logo: stream.channel.logo,
      game: stream.game,
      viewers: stream.viewers,
      banner: stream.channel.profile_banner,
      preview: stream.preview.large
    };
  }
  getRandomChannel() {
    let randomNumber = Math.floor(Math.random() * 8000);
    fetch(API_URL+ENDPOINTS.STREAMS + "?limit=3&offset=" + randomNumber, {
      headers: {
        'Client-ID': API_KEY
      }
    })
      .then(response => response.json())
      .then((data) => {
        console.log(data);
        this.setState({
          channel: this.getStreamData(data.streams[0])
        })
      })
      .catch(error => console.log(error));
  }
  componentDidMount() {
    this.getRandomChannel();
  }
  render() {
    return (
      <div id="app-main">
        <StreamContainer channel={this.state.channel}></StreamContainer>
      </div>
    );
  }
}

export default AppMain;
// <StreamContainer></StreamContainer>
