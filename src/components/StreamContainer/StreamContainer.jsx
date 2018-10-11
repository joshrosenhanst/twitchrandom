import React, { Component } from 'react';
import './StreamContainer.sass';
import StreamEmbed from '../StreamEmbed/StreamEmbed'
import { ReactComponent as Logo} from '../../logo.svg'

class StreamContainer extends Component {
  render() {
    let bannerStyle = {
      backgroundImage: `url(${this.props.channel.banner})`
    }
    return (
      <section id="stream-embed-section" style={bannerStyle}>
        <div id="stream-container">
          <StreamEmbed id="stream-embed" channel={this.props.channel.name}></StreamEmbed>
          <div id="stream-info">
            <h2 className="stream_title">{this.props.channel.title}</h2>
            <div id="stream-meta">
              <a className="channel_logo" href={"/stream/"+this.props.channel.name}>
                <img src={this.props.channel.logo} alt={this.props.channel.name+" logo"} />
              </a>
              <div className="channel_info">
                <a className="channel_name" href={"/stream/"+this.props.channel.name}>{this.props.channel.name}</a>
                { (this.props.channel.game) && (<div className="channel_game">Playing {this.props.channel.game}</div>) }
                <div className="channel_viewers">{this.props.channel.viewers} Viewers</div>
              </div>
            </div>
            <div id="random-stream-button">
              <a href="/random" className="random-button"><Logo /> Random Stream</a>
            </div>
          </div>
        </div>
      </section>
    );
  }
}

StreamContainer.defaultProps = {
  channel: {
    name: "giantbomb8",
    title: "Giant Bomb Infinte",
    logo: "https://static-cdn.jtvnw.net/jtv_user_pictures/b93a19e9-a04b-4848-8f56-e4d44c21b221-profile_image-300x300.png",
    game: "xsy",
    viewers: 200,
    banner: "https://static-cdn.jtvnw.net/jtv_user_pictures/973a9b47-c687-41c2-b3c6-b2618fc2a678-profile_banner-480.png"
  }
};

export default StreamContainer;
