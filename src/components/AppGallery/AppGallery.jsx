import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import './AppGallery.sass';
import { ENDPOINTS, fetchTwitchEndpoint, TwitchRandomException, getGalleryData, getFeaturedStreamData, shuffleAndSlice } from '../../utilities';
import { ReactComponent as Logo} from '../../icons/logo.svg'

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

function FeaturedGallery() {
  return (
    <AppGallery
      galleryTitle="Featured Gallery"
      featured={true}
    >
      <div className="square_ad">Ad</div>
    </AppGallery>
  );
}

class AppGallery extends Component {
  constructor(props) {
    super(props);
    this.state = {
      channels: [],
      gallery_error: false
    }
    this.requestNewGallery = this.requestNewGallery.bind(this);
  }

  requestNewGallery(e) {
    e.preventDefault();
    this.getRandomGalleryChannels();
  }

  /*
    getRandomGalleryChannels() - fetch details for 50 live streams, requested from a random offset. shuffleAndSlice() down to 8 results.
  */
  getRandomGalleryChannels() {
    let randomNumber = Math.floor(Math.random() * 8000);
    this.setState({
      channels: []
    });
    fetchTwitchEndpoint(ENDPOINTS.STREAMS, "?limit=100&offset=" + randomNumber)
      .then(data => {
        if(data._total > 0){
          let gallery_streams = shuffleAndSlice(data.streams, 8);
          this.setState({
            channels: getGalleryData(gallery_streams),
            gallery_error: false
          });
        }else{
          throw new TwitchRandomException('NO_GALLERY','Unable to fetch gallery.');
        }
      })
      .catch(error => {
        console.log(error);
        this.setState({
          gallery_error: true
        });
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
            channels: getFeaturedStreamData(data.featured)
          });
        }else{
          throw new TwitchRandomException("NO_FEATURED_GALLERY","Unable to fetch featured gallery.");
        }
      })
      .catch(error => {
        console.log(error);
        this.setState({
          gallery_error: true
        });
      });
  }

  componentDidMount() {
    if(this.props.featured){
      this.getFeaturedGalleryChannels();
    }else{
      this.getRandomGalleryChannels();
    }
  }

  render() {
    if(this.state.gallery_error) {
      return false;
    }
    if(this.state.channels.length){
      const galleryItems = this.state.channels.map((item) => 
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
            {this.props.featured && this.props.children}
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
  featured: false,
  galleryTitle: "Random Streams"
};

export { AppGallery, FeaturedGallery };