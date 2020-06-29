const paragraphs = document.querySelectorAll(".textContent");

paragraphs.forEach(text => {
    const words = text.textContent.split(" "),
          newWords = [];
    // console.log(words);
    for (let i = 0; i < words.length; i++) {
      let letters = words[i].split("");
      // console.log(letters);
      let firstLetter = letters[0];
      let lastLetter = letters[letters.length -1];
      let newLetters;
      if(firstLetter == '§')
      {
        letters.splice(0, 1);
        newWords.push("<br>")
      }
      else if (letters[1] == '§')
      {
        letters.splice(0, 2);
        newWords.push("<br>")
      }
      if(letters.length>1)
      {
        if(lastLetter == '.' || lastLetter == '!' || lastLetter == '?' || lastLetter == ',' || lastLetter == ';' || lastLetter == ':' || lastLetter == '/' )
        {
          lastLetter = letters[letters.length - 2]
          // bold
          if(firstLetter == "@" && lastLetter=="@")
          {
            newLetters = letters.slice(1, -2);
            newWords.push(`<b>${newLetters.join("")}</b>${letters[letters.length - 1]}`);
          }
          else if(firstLetter != "@" && lastLetter=="@")
          { 
            newLetters = letters.slice(0, -2);
            newWords.push(`${newLetters.join("")}</b>${letters[letters.length - 1]}`);
          }
          // underline
          else if(firstLetter =="*" && lastLetter=="*")
          {
            newLetters = letters.slice(1, -2);
            newWords.push(`<elem style="text-decoration: underline">${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
          }
          else if(firstLetter != "*" && lastLetter=="*")
          { 
            newLetters = letters.slice(0, -2);
            newWords.push(`${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
          }
          // italic
          else if(firstLetter =="%" && lastLetter=="%")
          {
            newLetters = letters.slice(1, -2);
            newWords.push(`<elem syle='font-style: italic'>${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
          }
          else if(firstLetter != "%" && lastLetter=="%")
          { 
            newLetters = letters.slice(0, -2);
            newWords.push(`${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
          }
          else
          {
            newLetters = letters;
            newWords.push(`${newLetters.join("")}`);
          }
        }
        else
        {
          // bold
          if(firstLetter == "@" && lastLetter !="@")
          {
            newLetters = letters.slice(1);
            newWords.push(`<b>${newLetters.join("")}`);
          }
          else if(firstLetter == "@" && lastLetter=="@")
          {
            newLetters = letters.slice(1, -1);
            newWords.push(`<b>${newLetters.join("")}</b>`);
          }
          else if(firstLetter != "@" && lastLetter=="@")
          { 
            newLetters = letters.slice(0, -1);
            newWords.push(`${newLetters.join("")}</b>`);
          }
          // underline
          else if(firstLetter == "*" && lastLetter !="*")
          {
            newLetters = letters.slice(1);
            newWords.push(`<elem style="text-decoration: underline">${newLetters.join("")}`);
          }
          else if(firstLetter =="*" && lastLetter=="*")
          {
            newLetters = letters.slice(1, -1);
            newWords.push(`<elem style="text-decoration: underline">${newLetters.join("")}</elem>`);
          }
          else if(firstLetter != "*" && lastLetter=="*")
          { 
            newLetters = letters.slice(0, -1);
            newWords.push(`${newLetters.join("")}</elem>`);
          }
          // italic 
          else if(firstLetter == "%" && lastLetter !="%")
          {
            newLetters = letters.slice(1);
            newWords.push(`<elem style="font-style: italic">${newLetters.join("")}`);
          }
          else if(firstLetter =="%" && lastLetter=="%")
          {
            newLetters = letters.slice(1, -1);
            newWords.push(`<elem style="font-style: italic">${newLetters.join("")}</elem>`);
          }
          else if(firstLetter != "%" && lastLetter=="%")
          { 
            newLetters = letters.slice(0, -1);
            newWords.push(`${newLetters.join("")}</elem>`);
          }
          else
          {
            newLetters = letters;
            newWords.push(`${newLetters.join("")}`);
          }
        }
      }
      else
      {
        newLetters = letters;
        newWords.push(`${newLetters.join("")}`);
      }
      text.innerHTML =newWords.join(" ");
    }
});