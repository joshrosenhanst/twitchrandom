import React from 'react';

const ChatEmbed = (props) => {
  if(props.active){
    return (
      <div id="stream-chat-container" class="active">
        <iframe frameborder="0"
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
        <button onClick={props.toggleChat}>Show Chat</button>
      </div>
    );
  }
};

export default ChatEmbed;