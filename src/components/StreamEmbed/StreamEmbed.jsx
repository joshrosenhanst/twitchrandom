import React, { Component } from 'react';

const EMBED_URL = 'https://embed.twitch.tv/embed/v1.js';

class StreamEmbed extends Component {
  componentDidMount() {
    if (window.Twitch && window.Twitch.Embed) {
      new window.Twitch.Embed(this.props.id, { ...this.props });
    } else {
      const embed_script = document.createElement('script');
      embed_script.setAttribute('src',EMBED_URL);
      embed_script.addEventListener('load', () => {
        new window.Twitch.Embed(this.props.id, { ...this.props });
      });

      document.body.appendChild(embed_script);
    }
  }
  render() {
    return (
      <div id={this.props.id}></div>
    );
  }
}

StreamEmbed.defaultProps = {
  width: "100%",
  height: "380",
  layout: "video"
};

export default StreamEmbed;
