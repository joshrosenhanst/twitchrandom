import React from 'react';

const ChatEmbed = (props) => {
  if(props.active){
    return (
      <div id="stream-chat-container" className="active">
        <iframe frameBorder="0"
          scrolling="no"
          id="chat_embed"
          title="Twitch Chat Embed"
          src={`https://www.twitch.tv/embed/${props.channel}/chat`}
          height="100%"
          width="100%">
        </iframe>
      </div>
    );
  }else{
    return (
      <div id="stream-chat-container">
        <div className="chat_header">Stream Chat</div>
        <div id="hidden_chat_notice">
          <div className="chat_notice_text">Chat is hidden.</div>
          <button onClick={props.toggleChat}>Show Chat</button>
        </div>
      </div>
    );
  }
};

export default ChatEmbed;