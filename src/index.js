import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from 'react-router-dom';
import AppHeader from './components/AppHeader/AppHeader';
import AppMain from './AppMain';
import * as serviceWorker from './serviceWorker';

ReactDOM.render(<AppHeader />, document.getElementById('app-header'));
ReactDOM.render(
    <BrowserRouter>
        <AppMain />
    </BrowserRouter>,
    document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: http://bit.ly/CRA-PWA
serviceWorker.unregister();
