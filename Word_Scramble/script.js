const wordtext = document.querySelector(".word"),
hinttext=document.querySelector(".hint span"),
timeText = document.querySelector(".time b");
inputword=document.querySelector("input")
refreshbtn = document.querySelector(".refresh"),
checkbtn = document.querySelector(".checkword");

let correctw,timer;

const initTimer = maxT =>{
  clearInterval(timer);
  timer=setInterval(()=>{
    if(maxT>0){
      maxT--;
      return timeText.innerText = maxT;
    }
    clearInterval(timer);
    alert(`Times Up! ${correctw.toUpperCase()} was the correct word.`);
    initGame();
  }, 1000);
}
const initGame = () =>{
  initTimer(20);
  let randomObj=word[Math.floor(Math.random() * word.length)];
  let wordarr= randomObj.word.split(""); 
  for(let i = wordarr.length-1;i>0; i--){
    let j = Math.floor(Math.random() * (i+1));
    [wordarr[i], wordarr[j]]=[wordarr[j],wordarr[i]];
  }
  wordtext.innerText = wordarr.join("");
  hinttext.innerText= randomObj.hint;

  correctw=randomObj.word.toLowerCase();
  inputword.value = "";
  inputword.setAttribute("maxl",correctw.length);
}
initGame();

const checkWord = () =>{
  let userword = inputword.value.toLocaleLowerCase();
  if(!userword) return alert("Please enter a word check");
  if(userword !== correctw) return alert(`Oops! ${userword} is not correct word.`);
  alert(` ${userword.toUpperCase()} is Correct Word`);
  initGame();
}
   
refreshbtn.addEventListener("click",initGame);
checkbtn.addEventListener("click",checkWord); 