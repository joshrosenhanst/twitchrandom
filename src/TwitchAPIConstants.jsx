const API_KEY = process.env.REACT_APP_TWITCH_API_KEY;
const API_URL = "https://api.twitch.tv/kraken";
const ENDPOINTS = {
  STREAMS: "/streams/",
  FEATURED_STREAMS: "/streams/featured/",
  GAMES: "/games/"
}
const AUTH_HEADERS = {
  headers: {
    'Client-ID': API_KEY,
    'Accept': 'application/vnd.twitchtv.v5+json'
  }
};

export { API_KEY, API_URL, ENDPOINTS, AUTH_HEADERS };