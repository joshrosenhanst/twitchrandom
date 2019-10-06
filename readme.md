<p align="center"><a href="https://twitchrandom.com"><img src="https://twitchrandom.com/logo_slogan.png" width="400" alt="TwitchRandom Logo"></a></p>

# TwitchRandom

[TwitchRandom.com](https://twitchrandom.com/) is a project that finds random video game streams to watch using the [Twitch.tv API](https://dev.twitch.tv/docs/v5/)

Originally built as a [Laravel Project](https://github.com/joshrosenhanst/twitchrandom/tree/laravel) using the unmaintained [TwitchTV SDK for PHP](https://github.com/jofner/Twitch-SDK). TwitchRandom now uses React for the interface and fetching Twitch API endpoints.

Bootstrapped with [Create React App](https://github.com/facebookincubator/create-react-app).

## Local Development

1. `npm install`
2. Get a API key from [Twitch](https://dev.twitch.tv/)
3. Copy `.env.example` to `.env` and add a valid Twitch API Key to `REACT_APP_TWITCH_API_KEY`
4. `npm start`

## Available Scripts

In the project directory, you can run:

### `npm start`

Runs the app in the development mode.<br>
Open [http://localhost:3000](http://localhost:3000) to view it in the browser.

The page will reload if you make edits.<br>
You will also see any lint errors in the console.

### `npm test`

Launches the test runner in the interactive watch mode.

### `npm run build`

Builds the app for production to the `build` folder.<br>
It correctly bundles React in production mode and optimizes the build for the best performance.

The build is minified and the filenames include the hashes.