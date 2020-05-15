window.addEventListener("load", ()=>{
  const input = document.querySelector("#window"),
  star1 = document.querySelector("#star_1"),
  star2 = document.querySelector("#star_2"),
  star3 = document.querySelector("#star_3"),
  star4 = document.querySelector("#star_4"),
  star5 = document.querySelector("#star_5");

  console.log(input);
  input.addEventListener("input", ()=>{
    let valueInput = input.value,
    initials = valueInput.replace(/(\B[a-zA-Z]\s*)|\s*/gi, ""),
    password = initials;

    console.log(password);
    
    var strength = 0;
    if (password.length>12){
      strength += 1;
      if (password.match(/[a-z]+/)){
        strength += 1;
      }
      if (password.match(/[A-Z]+/)){
        strength += 1;
      }
      if (password.match(/[0-9]+/)){
        strength += 1;
      }
      if (password.match(/[$@#&!]+/)){
        strength += 1;
      }
    }
    else
    {
      strength = 0;
    }
    console.log(strength);
    switch (strength) {
      case 0:
        star1.style.fill = "white";
        star2.style.fill = "white";
        star3.style.fill = "white";
        star4.style.fill = "white";
        star5.style.fill = "white";
        break;
      case 1:
        star1.style.fill = "red";
        break;
  
      case 2:
        star1.style.fill = "red";
        star2.style.fill = "red";
        break;
  
      case 3:
        star1.style.fill = "#EBB94A";
        star2.style.fill = "#EBB94A";
        star3.style.fill = "#EBB94A";
        break;
  
      case 4:
        star1.style.fill = "#2CB751";
        star2.style.fill = "#2CB751";
        star3.style.fill = "#2CB751";
        star4.style.fill = "#2CB751";
        break;
  
      case 5:
        star1.style.fill = "#3AD29F";
        star2.style.fill = "#3AD29F";
        star3.style.fill = "#3AD29F";
        star4.style.fill = "#3AD29F";
        star5.style.fill = "#3AD29F";
        break;
    }
  })
});