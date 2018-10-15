import React, { Component } from 'react';
import './AppGallery.sass';
import { ReactComponent as Logo} from '../../logo.svg'

function GalleryItem(props){
  return (
    <div className="gallery-item">
      <a href={"/stream/" + props.channel.name} className="gallery-item-screenshot">
        <img src={props.channel.preview} alt={props.channel.name+" Stream Preview"}/>
        <span className="overlay">
          {props.channel.viewers} Viewers
        </span>
      </a>
      <div className="gallery-item-meta">
        <a className="gallery-item-logo" href={"/stream/" + props.channel.name}>
          <img src={props.channel.logo} alt={props.channel.name+" logo"} />
        </a>
        <div className="gallery-item-info">
          <a className="gallery-item-name" href={"/stream/" + props.channel.name}>{props.channel.name}</a> 
          { (props.channel.game) && (<div className="gallery-item-game">Playing {props.channel.game}</div>) }
        </div>
      </div>
    </div>
  );
}

class AppGallery extends Component {
  constructor(props) {
    super(props);
    this.requestNewGallery = this.requestNewGallery.bind(this);
  }

  requestNewGallery(e) {
    e.preventDefault();
    this.props.onRequestRandom(e);
  }

  render() {

    if(this.props.items.length){
      const galleryItems = this.props.items.map((item) => 
        <GalleryItem 
          key={item.id}
          channel={item}
        ></GalleryItem>
      );
      const galleryClass = "app-gallery" + (this.props.featured?" featured":"");
      return (
        <section className={galleryClass}>
          <header className="gallery-header">
            <h3 className="gallery-title">
              {this.props.galleryTitle}
            </h3>
            {!this.props.featured && (
            <button className="gallery-reload" onClick={this.requestNewGallery}>
              <Logo /> Randomize
            </button>
            )}
          </header>
          <div className="gallery-items">
            {galleryItems}
            {this.props.featured && (
            <div className="ad">Ad</div>
            )}
          </div>
        </section>
      );
    }else{
      // return a loading template
      return (
        <section className="app-gallery">
          <header className="gallery-header">
            <h3 className="gallery-title">
              {this.props.galleryTitle}
            </h3>
          </header>
          <div className="loading">
            <Logo />
            <div>Loading Gallery</div>
          </div>
        </section>
      );
    }
  }
}

AppGallery.defaultProps = {
  featured: false
};

export default AppGallery;