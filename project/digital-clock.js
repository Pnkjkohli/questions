function updateTime() {
  let now = new Date();
  let hours = now.getHours().toString().padStart(2, '0');
  let minutes = now.getMinutes().toString().padStart(2, '0');
  let seconds = now.getSeconds().toString().padStart(2, '0');
  let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  let day = days[now.getDay()];
  document.getElementById("day").textContent = day;
  let month = now.toLocaleDateString();
  document.getElementById("date-text").textContent = month;



   // 12hrs format 
   hours = hours % 12;
  hours = (hours === 0) ? 12 : hours;
  let period = hours >= 12 ? 'AM' : 'PM';
  let time = hours.toString().padStart(2, '0') + ":" + minutes + period;
  document.getElementById("12h").textContent = time;
  document.getElementById("24h").textContent = hours + ":" + minutes + ':' + seconds;

}
setInterval(updateTime, 1000);  
updateTime();
document.getElementById('timeButton').addEventListener('click', function () {
  const time24h = document.getElementById('24h');
  const time12h = document.getElementById('12h');
  const button = document.getElementById('timeButton');

  if (time24h.style.display === 'none') {
    time24h.style.display = 'inline';
    time12h.style.display = 'none';
    button.textContent = '12h';
  } else {
    time24h.style.display = 'none';
    time12h.style.display = 'inline';
    button.textContent = '24h';
  }
});