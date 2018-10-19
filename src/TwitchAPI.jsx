const API_KEY = process.env.REACT_APP_TWITCH_API_KEY;
const API_URL = "https://api.twitch.tv/kraken";
const ENDPOINTS = {
  STREAMS: "/streams/",
  FEATURED_STREAMS: "/streams/featured/",
  GAMES: "/games/top/",
  GAMES_SEARCH: "/search/games/",
  USERS: "/users/"
}
const AUTH_HEADERS = {
  headers: {
    'Client-ID': API_KEY,
    'Accept': 'application/vnd.twitchtv.v5+json'
  }
};

function TwitchRandomException(status,message) {
  this.message = message;
  this.status = status;
  this.name = 'TwitchRandomException';
}

function TwitchException(message, status, type) {
  this.message = message;
  this.status = status;
  this.type = type;
  this.name = 'TwitchException';
}

/*
  fetchTwitchEndpoint() - Use the Fetch API to request data from Twitch. Returns a promise which resolves to a JSON object.
*/
async function fetchTwitchEndpoint(endpoint, query = "") {
  if(API_KEY){
    return fetch(API_URL + endpoint + query, AUTH_HEADERS)
      .then(response => response.json())
      .catch(error => {
        throw new TwitchException(error.message, error.status, error.error);
      });
  }else{
    throw TwitchRandomException("NO_KEY","Missing Twitch API key.");
  }
}

export { API_KEY, API_URL, ENDPOINTS, AUTH_HEADERS, fetchTwitchEndpoint, TwitchException, TwitchRandomException };