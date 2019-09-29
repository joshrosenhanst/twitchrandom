import React from 'react';
import ReactDOM from 'react-dom';
import StreamEmbed from './StreamEmbed';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<StreamEmbed />, div);
  ReactDOM.unmountComponentAtNode(div);
});
