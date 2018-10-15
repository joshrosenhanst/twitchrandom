import React, { Component } from 'react';
import './StreamContainer.sass';

class AppGallery extends React.Component {
  constructor(props) {
    super(props);
    this.requestNewGallery = this.requestNewGallery.bind(this);
  }

  requestNewGallery(e) {
    this.props.requestNewGallery();
  }

  render() {
    return (
      <div className="app-gallery">
        <header className="gallery-header">
          <h3 class="gallery-title">{this.props.galleryTitle}</h3>
        </header>
        <div className="gallery-item">
          <div className="gallery-item-screenshot">
            <img src={this.props.channel.preview} alt={this.props.channel.name+" Stream Preview"}/>
            <span className="overlay">
              {this.props.channel.viewers} Viewers
            </span>
          </div>
          <div className="gallery-item-meta">
            <a className="gallery-item-logo" href={"/stream/"+this.props.channel.name}>
              <img src={this.props.channel.logo} alt={this.props.channel.name+" logo"} />
            </a>
            <div className="gallery-item-info">
              <a className="gallery-item-name" href={"/stream/"+this.props.channel.name}>{this.props.channel.name}</a>
              { (this.props.channel.game) && (<div className="gallery-item-game">Playing {this.props.channel.game}</div>) }
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default AppGallery;