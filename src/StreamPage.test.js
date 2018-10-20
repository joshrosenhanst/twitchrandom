import React from 'react';
import ReactDOM from 'react-dom';
import StreamPage from './StreamPage';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<StreamPage />, div);
  ReactDOM.unmountComponentAtNode(div);
});
