import 'react-app-polyfill/ie11';
import 'react-app-polyfill/stable';
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Loadable from 'react-loadable';
import { ReactComponent as Logo } from './icons/logo.svg';

// pages
import StreamPage from './pages/StreamPage';
import NotFoundPage from './pages/NotFoundPage';
import * as serviceWorker from './serviceWorker';

const Loading = () => {
  return (
    <section id="stream-embed-section">
      <div id="stream-container">
        <div className="loading">
          <Logo />
          <div>Loading...</div>
        </div>
      </div>
    </section>
  );
}

const LoadableGamesPage = Loadable({
  loader: () => import('./pages/BrowseGamesPage'),
  loading: Loading
});

ReactDOM.render(
  <BrowserRouter>
    <Switch>
      <Route exact path="/" component={StreamPage} />
      <Route exact path="/random" component={StreamPage} />
      <Route path={["/games/:game+","/streams/:stream+"]} component={StreamPage} />
      <Route exact path="/games" component={LoadableGamesPage} />
      <Route component={NotFoundPage} />
    </Switch>
  </BrowserRouter>,
  document.getElementById('app-root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: http://bit.ly/CRA-PWA
serviceWorker.register();
