var lastPhrase = "Loading Stream...";
function getRandomText(last) {
    var textArray = [
        "Loading Stream...", "Reticulating Splines...", "Suppressing Kappa...", "Mid or feed...", "Team is full of babies...", "Muting Sand Storm spam...", "Spamming Chat...", "Counter Terrorists Win...", "How did I get here?..."
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