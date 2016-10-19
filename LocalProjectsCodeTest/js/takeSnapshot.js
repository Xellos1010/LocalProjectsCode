/**
 * Created by Evan McCall on 10/18/2016.
 */

var player = document.getElementById('player');
var snapshotCanvas = document.getElementById('snapshot');
var captureButton = document.getElementById('capture');

var handleSuccess = function(stream) {
    // Attach the video stream to the video element and autoplay.
    player.src = URL.createObjectURL(stream);
  };

captureButton.addEventListener('click', function() {

    //Turn off Capture Canvas

    var context = snapshot.getContext('2d');
    // Draw the video frame to the canvas.
    context.drawImage(player, 0, 0, snapshotCanvas.width, snapshotCanvas.height); //Remove once image processed through shader
    //Send picture to shader
    //wait until shader returns image processed
    //Show image processed from images folder for 5 seconds
    //Turn on the question canvas

  });

navigator.mediaDevices.getUserMedia({ audio: false, video: true })
      .then(handleSuccess);
