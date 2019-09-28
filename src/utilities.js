import shuffle from 'lodash/shuffle';

const API_KEY = process.env.REACT_APP_TWITCH_API_KEY;
const STORAGE_KEY = process.env.REACT_APP_STORAGE_KEY;
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

function getLocalData(key = null){
  let localData = {};
  try {
    localData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
  } catch (error) {
    console.log("Unable to get LocalStorage data.")
  }
  if(key){
    return localData[key];
  }
  return localData;
}

function updateLocalData(key, value) {
  const localData = getLocalData();
  localData[key] = value;

  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(localData));
  } catch (error) {
    console.log("Unable to set LocalStorage data.")
  }
}

/*
  getChatActive() - Get the 'chat_active' value from localStorage if set. Default to true.
*/
function getChatActive(){
  const localData = getLocalData();
  if(localData && localData['chat_active'] !== undefined){
    return localData['chat_active'];
  }

  return true;
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
    throw new TwitchRandomException("NO_KEY","Missing Twitch API key.");
  }
}

/*
  fetchTwitchGameList() - Fetch the GAMES endpoint with the set limit/offset. Returns a promise which resolves to a JSON list of games if successful or an exception.
*/
async function fetchTwitchGameList(limit = 100, offset = 0) {
  return fetchTwitchEndpoint(ENDPOINTS.GAMES, `?limit=${limit}&offset=${offset}`)
    .then(data => {
      if(data.top){
        return data.top;
      }else{
        throw new TwitchRandomException("FAIL_GAMES","Unable to load Twitch games list.");
      }
    });
}

/*
  getChannelID(name) - v5 of the Twitch API requires a channel ID to get stream info, rather than a channel name. getChannelID(name) sends a query with the name and returns a promise with the ID.
*/
async function getChannelID(name) {
  return fetchTwitchEndpoint(ENDPOINTS.USERS, "?login="+name)
    .then(data => {
      if(data._total > 0){
        return data.users[0]._id;
      }else{
        throw new TwitchRandomException("NO_USER","User not found.");
      }
    });
}

/*
  getStreamData() - Map the properties in the stream object into a new object.
  stream - single object from the Twitch API JSON response.
*/
function getStreamData(stream) {
  return {
    id: stream.channel._id,
    display_name: stream.channel.display_name,
    name: stream.channel.name,
    title: stream.channel.status,
    logo: stream.channel.logo,
    game: stream.game,
    viewers: stream.viewers,
    banner: stream.channel.profile_banner,
    preview: stream.preview.large
  };
}

/*
  getGalleryData() - Map all of the gallery streams in the array using getStreamData().
  streams - array of stream objects from the Twitch API JSON response.
*/
function getGalleryData(streams) {
  return streams.map(item => getStreamData(item))
}

/*
  getFeaturedStreamData() - Map all of the featured streams in the array using getStreamData().
  streams - array of stream objects from the Twitch API JSON response.
*/
function getFeaturedStreamData(streams){
  return streams.map(item => getStreamData(item.stream))
}


/*
  shuffleAndSlice(array, limit) - Shuffle an array and then return a limited number of cells. Uses the lodash shuffle function (which uses a version of the Fisher-Yates shuffle )
*/
function shuffleAndSlice(array, limit){
  if(limit > array.length) limit = array.length;

  return shuffle(array).slice(0, limit);
}

export { 
  API_KEY, 
  API_URL, 
  ENDPOINTS, 
  AUTH_HEADERS, 
  fetchTwitchEndpoint, 
  TwitchException, 
  TwitchRandomException,
  getChannelID,
  getStreamData,
  getGalleryData,
  getFeaturedStreamData,
  shuffleAndSlice,
  getLocalData,
  updateLocalData,
  getChatActive,
  fetchTwitchGameList
};