import { a, b, c } from '/questions/jsquestion/variables/variables.js';
var btn = document.getElementById('btn');
    btn.addEventListener('click', function () {
      let text = document.getElementsByClassName('text')[0];
    
        text.innerHTML = 'The value of a, b, c are: ' + a +', ' + b + ', '+ c ;
      
     
    });