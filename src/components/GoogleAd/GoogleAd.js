import React, { useEffect } from 'react';

function GoogleAd(props) {
  useEffect(() => {
    if(window) (window.adsbygoogle = window.adsbygoogle || []).push({});
  }, [props.slot]);

  return (
    <ins className="adsbygoogle"
      style={props.adStyle}
      data-ad-client={props.client}
      data-ad-slot={props.slot}
      data-ad-format={props.format}
      data-ad-layout-key={props.layoutKey}
      data-full-width-responsive={props.responsive}></ins>
  );
}

export default GoogleAd;