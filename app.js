let answeredCorrectly = new Set();

// Deze functie opent de modal en toont de vraag
function openModal(index) {
  // Zoek het element met de class 'box' en het bijbehorende data-index
  let box = document.querySelector(`.box[data-index='${index}']`);

  // Haal de vraag en het juiste antwoord uit de dataset van de box
  let questionText = box.dataset.question;
  let correctAnswer = box.dataset.answer;

  // Zet de vraagtekst in het modalvenster
  document.getElementById('question').innerText = questionText;

  // Zet het correcte antwoord in de modal, zodat we het later kunnen vergelijken
  document.getElementById('modal').dataset.answer = correctAnswer;

   document.getElementById('modal').dataset.index = index;

  // Maak het antwoordveld leeg
  document.getElementById('answer').value = '';

  // Toon de overlay en de modal door de display-stijl te veranderen naar 'block'
  document.getElementById('overlay').style.display = 'block';
  document.getElementById('modal').style.display = 'block';
}

// Deze functie sluit de modal en de overlay
function closeModal() {
  // Zet de overlay en modal weer op 'none' zodat ze niet meer zichtbaar zijn
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
  
  // Maak de feedback tekst leeg
  document.getElementById('feedback').innerText = '';
}





function checkAnswer() {
  let userAnswer = document.getElementById('answer').value.trim();
  let correctAnswer = document.getElementById('modal').dataset.answer;
  let feedback = document.getElementById('feedback');

  if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
    feedback.innerText = 'Correct! Goed gedaan!';
    feedback.style.color = 'green';

    // Mark this question as answered
   let index = document.getElementById('modal').dataset.index;

    answeredCorrectly.add(index);

    setTimeout(() => {
      closeModal();

      // Check if all are answered
    if (answeredCorrectly.size === totalQuestions) {
    if (window.location.href.includes("room_1.php")) {
        window.location.href = "room_2.php?room1_time=" + elapsedTime;
    } else if (window.location.href.includes("room_2.php")) {
        window.location.href = "WinVerlies/win.php?room2_time=" + elapsedTime;
    }

      }
    }, 1000);
  } else {
    feedback.innerText = 'Fout, probeer opnieuw!';
    feedback.style.color = 'red';
  }
}

let elapsedTime = 0; // seconds

function startCountdown(durationInMinutes, onTimeUpCallback) {
  let time = durationInMinutes * 60;
  elapsedTime = 0;
  let countdown = setInterval(function () {
    let seconds = time % 60;
    let minutes = Math.floor(time / 60);

    if (seconds < 10) seconds = "0" + seconds;
    if (minutes < 10) minutes = "0" + minutes;

    const timeDisplay = document.getElementById("time");
    if (timeDisplay) {
      timeDisplay.innerHTML = minutes + ":" + seconds;
    }

    time--;
    elapsedTime++; // count up

    if (time < 0) {
      clearInterval(countdown);
      if (typeof onTimeUpCallback === "function") {
        onTimeUpCallback();
      }
    }
  }, 1000);
}