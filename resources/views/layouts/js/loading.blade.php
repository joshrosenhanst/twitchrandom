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
function rawurlencode(str) {

str = (str + '')
.toString();

// Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
// PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
return encodeURIComponent(str)
.replace(/!/g, '%21')
.replace(/'/g, '%27')
.replace(/\(/g, '%28')
.
replace(/\)/g, '%29')
.replace(/\*/g, '%2A');
}

$.fn.setRandomText = function() {
    var rand = getRandomText(lastPhrase);
    this.text(rand);
    lastPhrase = rand;
};