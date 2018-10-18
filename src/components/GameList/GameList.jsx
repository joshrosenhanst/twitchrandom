import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import './GameList.sass';
import { ENDPOINTS, fetchTwitchEndpoint } from '../../TwitchAPI';
import { ReactComponent as Logo} from '../../logo.svg';
import GameAutoSuggest from './GameAutosuggest';

function GameDisplay(props) {
  return (
    <div className="game-display">
      <Link to={"/games/"+props.game.name} className="game-poster">
        <img src={props.game.poster} alt={props.game.name+" Box Art"} />
      </Link>
      <div className="game-info">
        <Link to={"/games/"+props.game.name} className="game-name">{props.game.name}</Link>
        <div className="game-viewers">{props.game.viewers} Viewers</div>
      </div>
    </div>
  );
}

class GameList extends Component {
  /*
    The GameList uses an internal Map() object to bind the games JSON object from Twitch API.
  */
  constructor(props) {
    super(props);
    this.state = {
      games: new Map()
    };
    this.handleRequestNextPage = this.handleRequestNextPage.bind(this);
  }
  handleRequestNextPage() {
    this.getGames();
  }
  /*
    getGameData(game) - Map the properties in the game object into a new object.
    game - single game object from the Twitch API JSON response.
  */
  getGameData(game) {
    return {
      id: game.game._id,
      name: game.game.name,
      poster: game.game.box.large,
      viewers: game.viewers
    };
  }

  /*
    createMap(data) - Create a Map() object using the game's ID as the key. The map will look like: {12345: {name: Super Mario,etc} }. This map will be merged with the this.state.games Map to override any duplicates.
    data - the Twitch API JSON object.
  */
  createMap(data) {
    let newMap = new Map();
    data.forEach(item => {
      newMap.set(item.game._id, this.getGameData(item));
    });
    return newMap;
  }

  /*
    getGames() - Fetch the list of top games from the Twitch API, using the size of this.state.games as the offset. Merge the this.state.games Map with the new Map() created with the JSON results.
  */
  getGames() {
    const limit = 100;
    fetchTwitchEndpoint(ENDPOINTS.GAMES, `?limit=${limit}&offset=${this.state.games.size}`)
      .then(data => {
        this.setState({
          games: new Map([...this.state.games, ...this.createMap(data.top)])
        });
      })
  }

  componentDidMount() {
    this.getGames();
  }
  render() {
    if(this.state.games.size){
      // foreach object in this.state.games, create a <GameDisplay> template
      let gameDisplays = [];
      this.state.games.forEach((game, key) => {
        gameDisplays.push(
          <GameDisplay
            key={key}
            game={game}
          ></GameDisplay>
        );
      });

      return (
        <React.Fragment>
        <section id="game-list">
            <header id="game-list-header">
              <h2>All Games</h2>
              <GameAutoSuggest></GameAutoSuggest>
            </header>
            <div id="game-list-main">
              {gameDisplays}
            </div>
        </section>
        <button id="load-games" onClick={this.handleRequestNextPage}>Load More Games</button>
        </React.Fragment>
      );
    }else{
      // return a loading template
      return (
        <section id="game-list">
            <header id="game-list-header">
                <h2>All Games</h2>
            </header>
            <div className="loading">
              <Logo />
              <div>Loading Games</div>
            </div>
        </section>
      );
    }
  }
}

export default GameList;