/*
Custom Javascript for Music Playlist DB

*/

// go back to the prevous page
function goBack() {
  window.history.back();
}
function playAudio() {
  var audio = new Audio('../audio/slot-machine-daniel_simon.mp3');  
  audio.type = 'audio/mpeg';

  var playPromise = audio.play();

  if (playPromise !== undefined) {
      playPromise.then(function () {
          console.log('Playing....');
      }).catch(function (error) {
          console.log('Failed to play....' + error);
      });
  }
}

