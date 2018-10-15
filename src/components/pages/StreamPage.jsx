import React, { Component } from 'react';
import StreamContainer from '../StreamContainer/StreamContainer';

class StreamPage extends Component {
    render () {
        return (
        <div id="app-main">
            <StreamContainer 
            channel={this.state.channel}
            onRequestRandom={this.handleRequestRandom}
            ></StreamContainer>
        </div>
        );
    }
}

export default StreamPage;