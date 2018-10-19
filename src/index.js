import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import AppHeader from './components/AppHeader/AppHeader';
import AppMain from './AppMain';
import GamePage from './GamePage';
import NotFoundPage from './NotFoundPage';
import * as serviceWorker from './serviceWorker';

ReactDOM.render(<AppHeader />, document.getElementById('app-header'));
ReactDOM.render(
  <BrowserRouter>
    <Switch>
      <Route exact path="/" component={AppMain} />
      <Route path="/games/:game+" component={AppMain} />
      <Route path="/streams/:stream+" component={AppMain} />
      <Route exact path="/games" component={GamePage} />
      <Route component={NotFoundPage} />
    </Switch>
  </BrowserRouter>,
  document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: http://bit.ly/CRA-PWA
serviceWorker.unregister();
