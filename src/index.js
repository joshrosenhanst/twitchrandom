import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import StreamPage from './pages/StreamPage';
import GamePage from './pages/GamePage';
import NotFoundPage from './pages/NotFoundPage';
import * as serviceWorker from './serviceWorker';

ReactDOM.render(
  <BrowserRouter>
    <Switch>
      <Route exact path="/" component={StreamPage} />
      <Route exact path="/random" component={StreamPage} />
      <Route path="/games/:game+" component={StreamPage} />
      <Route path="/streams/:stream+" component={StreamPage} />
      <Route exact path="/games" component={GamePage} />
      <Route component={NotFoundPage} />
    </Switch>
  </BrowserRouter>,
  document.getElementById('app-root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: http://bit.ly/CRA-PWA
serviceWorker.unregister();
