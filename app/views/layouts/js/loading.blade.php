var lastPhrase = "Loading Stream...";
function getRandomText(last) {
    var textArray = [
        "Loading Stream...", "Reticulating Splines...", "Suppressing Kappa...", "Mid or feed...", "Entire team is babies...", "Muting Sand Storm spam...", "Buffering Sandstorm.mp3...", "Spamming Chat...", "Counter Terrorists Win...", "How did I get here?...", "Copying ASCII art...", "Ignoring chat..."
    ];
    var rand = textArray[Math.floor(Math.random() * textArray.length)];
    if(last === undefined || last !== rand){
        return rand;
    }else{
        return getRandomText();
    }
}
$.fn.setRandomText = function() {
    var rand = getRandomText(lastPhrase);
    this.text(rand);
    lastPhrase = rand;
};