import React, { Component } from 'react';
import AppHeader from './components/AppHeader/AppHeader';
import AppError from './components/AppError/AppError';

class NotFoundPage extends Component {
    render () {
        return (
            <React.Fragment>
                <AppHeader location={this.props.location} />
                <AppError>Page Not Found</AppError>
                <footer id="app-footer">All Twitch materials are the property of Twitch.</footer>
            </React.Fragment>
        );
    }
}

export default NotFoundPage;