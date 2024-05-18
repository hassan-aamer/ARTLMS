function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.html(`<i class="far fa-clock me-2"></i>${minutes} دقيقة و  ${seconds} ثانية`);
        $("#student_duration").val(minutes);

        if (--timer < 0) {
            display.html('انتهي الوقت');
            $('#submitExam').trigger('submit');
        }
    }, 1000);
}


$(function ($) {
    var dynamicMinutes = 60 * parseInt($('#calendar_duration').val()),
        display = $('#counter');
    startTimer(dynamicMinutes, display);
});


$(document).ready(function () {
  // var countDownDate = new Date("May 28, 2023 23:00:00").getTime();
  // // Update the count down every 1 second
  // var x = setInterval(function () {
  //   // Get today's date and time
  //   var now = new Date().getTime();
  //
  //   // Find the distance between now and the count down date
  //     var dynamicMinutes = $('#calendar_duration').val();
  //   var distance = (parseInt(dynamicMinutes) * 60 *10000 *60)  - now;
  //
  //   // Time calculations for days, hours, minutes and seconds
  //   // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  //   // var hours = Math.floor(
  //   //   (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
  //   // );
  //   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  //   var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  //     console.log(distance)
  //   // Display the result in the element with id="demo"
  //   // document.getElementById("counter").innerHTML =
  //   //   days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
  //   document.getElementById(
  //     "counter"
  //   ).innerHTML = `<i class="far fa-clock me-2"></i>${minutes} دقيقة و  ${seconds} ثانية`;
  //
  //   // If the count down is finished, write some text
  //   if (distance < 0) {
  //     clearInterval(x);
  //     document.getElementById("counter").innerHTML = "EXPIRED";
  //   }
  // }, 1000);

  // Drawing Board

  const localStorageKeyName = "drawing-board-drawingBoard";

  const myBoard = new DrawingBoard.Board("drawingBoard", {
    controlsPosition: "top right",
    color: "#FF007F",
    size: 5,
    webStorage: "local", // local or session
  });

  // On Button Click , Get data from local storage and save image data as base64
  // On page load, get data from database and set the value of localStorageKeyName to the value of stored image.
});
