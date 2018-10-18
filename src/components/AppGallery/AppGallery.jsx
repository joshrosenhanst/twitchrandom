import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import './AppGallery.sass';
import { ReactComponent as Logo} from '../../logo.svg'

function GalleryItem(props){
  return (
    <div className="gallery-item">
      <Link to={"/streams/" + props.channel.name} className="gallery-item-screenshot">
        <img src={props.channel.preview} alt={props.channel.name+" Stream Preview"}/>
        <span className="overlay">
          {props.channel.viewers} Viewers
        </span>
      </Link>
      <div className="gallery-item-meta">
        <Link to={"/streams/" + props.channel.name} className="gallery-item-logo">
          <img src={props.channel.logo} alt={props.channel.name+" logo"} />
        </Link>
        <div className="gallery-item-info">
          <Link className="gallery-item-name" to={"/streams/" + props.channel.name}>{props.channel.name}</Link> 
          { (props.channel.game) && (
            <div className="gallery-item-game">
              Playing <Link to={"/games/"+props.channel.game}>{props.channel.game}</Link>
            </div>
          ) }
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