import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { ReactComponent as Logo} from './logo.svg'

class NotFoundPage extends Component {
    render () {
        return (
            <div id="app-error">
                <h2>Page Not Found</h2>
                <Link to="/" className="main-button"><Logo /> Go to the Home Page</Link>
            </div>
        );
    }
}

export default NotFoundPage;