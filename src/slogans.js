const sloganList = [
  "Find Something Unexpected","Mid or feed", "Putting the rude in Darude", "Entire team is babies", "Where is Mankrik's wife?", "Eh! Steve!", "Sexy Wisp Cosplay", "Spline Reticulators Inc", "Excessive Donger Spam", "༼つ ◕_◕ ༽つ", "Do a Barrel Roll", "Diagnosis: Delicious"
];

export function getRandomSlogan() {
  return sloganList[Math.floor( Math.random() * sloganList.length )];
};