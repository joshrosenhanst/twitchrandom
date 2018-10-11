import React, { Component } from 'react';
import './AppMain.sass';
import StreamContainer from './components/StreamContainer/StreamContainer';

class AppMain extends Component {
  render() {
    return (
      <div id="app-main">
        <StreamContainer></StreamContainer>
      </div>
    );
  }
}

export default AppMain;
