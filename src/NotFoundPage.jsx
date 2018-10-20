import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import AppHeader from './components/AppHeader/AppHeader';
import { ReactComponent as Logo} from './logo.svg'

class NotFoundPage extends Component {
    render () {
        return (
            <React.Fragment>
                <AppHeader />
                <main id="app-error">
                    <h2>Page Not Found</h2>
                    <Link to="/" className="main-button"><Logo /> Go to the Home Page</Link>
                </main>
                <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
            </React.Fragment>
        );
    }
}

export default NotFoundPage;