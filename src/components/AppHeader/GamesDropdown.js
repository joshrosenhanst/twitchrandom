import React, { useState, useEffect } from 'react';
import { fetchTwitchGameList } from '../../utilities'; 
import { Link } from 'react-router-dom';

const getGameData = (game) => ({
  id: game.game._id,
  name: game.game.name,
  poster: game.game.box.medium
});

function GamesDropdown(){
  const [games, setGames] = useState([]);
  const [dropdownActive, setDropdownActive] = useState(false);
  const [fetchError, setFetchError] = useState(false);

  const toggleDropdown = (e) => {
    e.preventDefault();
    setDropdownActive(!dropdownActive);
  };

  useEffect(() => {
    if(!games.length && !fetchError){
      fetchTwitchGameList(10).then(data => {
        console.log(data);
        const games = data.map(game => getGameData(game));
        setGames(games);
        setFetchError(false);
        console.log(games);
      }).catch(error => {
        console.log(error);
        if(error.status === "FAIL_GAMES"){
          setFetchError(true);
        }
      });
    }
  });

  if(!games.length || fetchError){
    return <Link to="/games/" className="menu-item" title="View All Games">Browse Games</Link>;
  }

  return (
    <div className={"menu-dropdown" + (dropdownActive?" active":"")}>
      <button className="menu-dropdown-trigger" aria-haspopup="true" aria-controls="top-games-list" onClick={toggleDropdown}>Browse Games</button>
      <div id="top-games-list" role="menu" className="dropdown-list">
        {games.map((game, key) => (
          <Link to={"/games/"+game.name} key={key} className="dropdown-list-item">
            {game.name}
          </Link>
        ))}
        <Link to="/games" className="dropdown-list-item list-item-footer">All Games</Link>
      </div>
    </div>
  );
}

export default GamesDropdown; 