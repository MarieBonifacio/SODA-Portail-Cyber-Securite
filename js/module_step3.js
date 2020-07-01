const paragraphs = document.querySelectorAll(".textContent");

paragraphs.forEach(text => {
    const words = text.textContent.split(" "),
          newWords = [];
    for (let i = 0; i < words.length; i++) {
      let letters = words[i].split(""),
          firstLetter = letters[0],
          lastLetter = letters[letters.length -1],
          pack,
          newLetters;
      switch (firstLetter) {
        case '{':
          letters.splice(0, 1);
          newWords.push("<div style='text-align: left;'>");
          break;
        case '}':
          letters.splice(0, 1);
          newWords.push("<div style='text-align: right;'>");
          break;
        case '|':
          letters.splice(0, 1);
          newWords.push("<div style='text-align: center;'>");
          break;
        case 'µ':
          letters.splice(0, 1);
          newWords.push("<div style='text-align: justify;'>");
          break;
        case '~':
          letters.splice(0, 1);
          newWords.push("</div>")
          break;
        case '§':
          letters.splice(0, 1);
          newWords.push("<br>");
          break;
      }
      if(letters.length>1) {
        if(lastLetter == '.' || lastLetter == '!' || lastLetter == '?' || lastLetter == ',' || lastLetter == ';' || lastLetter == ':' || lastLetter == '/' ) {
          lastLetter = letters[letters.length - 2]
          if(firstLetter != '@' && lastLetter =='@' || firstLetter != '*' && lastLetter =='*' || firstLetter != '%' && lastLetter =='%') {
            pack = `0${lastLetter}`;
          } else {
            pack = `${firstLetter + lastLetter}`;
          }
          switch (pack) {
            // bold
            case '@@':
              newLetters = letters.slice(1, -2);
              newWords.push(`<elem style="font-weight: bold">${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
              break; 
            case '0@':
              newLetters = letters.slice(0, -2);
              newWords.push(`${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
              break;
            // underlined
            case '**':
              newLetters = letters.slice(1, -2);
              newWords.push(`<elem style="text-decoration: underline">${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
              break; 
            case '0*':
              newLetters = letters.slice(0, -2);
              newWords.push(`${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
              break;
            // italic
            case '%%':
              newLetters = letters.slice(1, -2);
              newWords.push(`<elem style='font-style: italic'>${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
              break; 
            case '0%':
              newLetters = letters.slice(0, -2);
              newWords.push(`${newLetters.join("")}</elem>${letters[letters.length - 1]}`);
              break; 
            // by default
            default: 
              newLetters = letters;
              newWords.push(`${newLetters.join("")}`);
              break;
          }
        } else {
          if(lastLetter != '@' && firstLetter== '@'|| lastLetter != '*'&& firstLetter== '*' || lastLetter != '%' && firstLetter== '%')
          {
            pack = `${firstLetter}0`;
          }
          else if(firstLetter != '@' && lastLetter =='@' || firstLetter != '*' && lastLetter =='*' || firstLetter != '%' && lastLetter =='%')
          {
            pack = `0${lastLetter}`;
          } else {
            pack = `${firstLetter + lastLetter}`;
          }
          switch (pack) {
            // bold
            case '@@':
              newLetters = letters.slice(1, -1);
              newWords.push(`<elem style="font-weight: bold">${newLetters.join("")}</elem>`);
              break; 
            case '@0':
              newLetters = letters.slice(1);
              newWords.push(`<elem style="font-weight: bold">${newLetters.join("")}`);
              break; 
            case '0@':
              newLetters = letters.slice(0, -1);
              newWords.push(`${newLetters.join("")}</elem>`);
              break;
            // underlined
            case '**':
              newLetters = letters.slice(1, -1);
              newWords.push(`<elem style="text-decoration: underline">${newLetters.join("")}</elem>`);
              break; 
            case '*0':
              newLetters = letters.slice(1);
              newWords.push(`<elem style="text-decoration: underline">${newLetters.join("")}`);
              break; 
            case '0*':
              newLetters = letters.slice(0, -1);
              newWords.push(`${newLetters.join("")}</elem>`);
              break;
            // italic
            case '%%':
              newLetters = letters.slice(1, -1);
              newWords.push(`<elem style="font-style: italic">${newLetters.join("")}</elem>`);
              break; 
            case '0%':
              newLetters = letters.slice(0, -1);
              newWords.push(`${newLetters.join("")}</elem>`);
              break; 
            case '%0':
              newLetters = letters.slice(1);
              newWords.push(`<elem style="font-style: italic">${newLetters.join("")}`);
              break;
            // by default
            default: 
              newLetters = letters;
              newWords.push(`${newLetters.join("")}`);
              break;
          }
        }
      } else {
        newLetters = letters;
        newWords.push(`${newLetters.join("")}`);
      }
      text.innerHTML =newWords.join(" ");
    }
});