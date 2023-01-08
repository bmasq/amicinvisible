// 99.99999% written by chat.openai.com

window.onload = function() {
    // Generate random colors
    const bgColor = '#' + pad(Math.floor(Math.random()*56 + 200).toString(16)) + pad(Math.floor(Math.random()*56 + 200).toString(16)) + pad(Math.floor(Math.random()*56 + 200).toString(16));
    const textColor1 = '#' + pad(Math.floor(Math.random()*100).toString(16)) + pad(Math.floor(Math.random()*100).toString(16)) + pad(Math.floor(Math.random()*100).toString(16));
    const textColor2 = '#' + pad(Math.floor(Math.random()*100).toString(16)) + pad(Math.floor(Math.random()*100).toString(16)) + pad(Math.floor(Math.random()*100).toString(16));
    // Generate a random number between 1 and 6
    const randomNumber = Math.floor(Math.random() * 6) + 1;
    
    // Apply colors to elements
    document.querySelector("div").style.backgroundColor = bgColor;
    document.querySelector("div h1").style.color = textColor1;
    document.querySelector("div h2").style.color = textColor2;
    // Set the body's background image to a random background image
    document.body.style.backgroundImage = `url("backgrounds/bckg${randomNumber}.webp")`;
  }
  
  // Pad a string with leading zeros if necessary
  function pad(str) {
    if (str.length === 1) {
      return '0' + str;
    } else {
      return str;
    }
  }
  