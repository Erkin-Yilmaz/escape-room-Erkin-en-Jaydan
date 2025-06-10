
  var time = 5 * 60;
  var countdown = setInterval(function () {
    var seconds = time % 60;
    var minutes = Math.floor(time / 60);
    
    // Voeg voorloopnullen toe indien nodig
    if (seconds < 10) seconds = "0" + seconds;
    if (minutes < 10) minutes = "0" + minutes;

    // Update het HTML-element
    document.getElementById("time").innerHTML = minutes + ":" + seconds;

    time--;

    if (time < 0) {
      clearInterval(countdown);
      window.location.href = "WinVerlies/lose.php";
    }
  }, 1000);
