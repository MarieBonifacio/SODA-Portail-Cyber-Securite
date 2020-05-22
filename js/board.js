// window.addEventListener('load', function () {
//   var url = myScript.theme_directory;
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function () {
//   if(this.readyState == 4 && this.status == 200)
//   {
//     var myArray = JSON.parse(this.responseText);
//     var genTown = myArray.classementVilleGeneral,
//     genUser = myArray.classementUser,
//     genUserBoard = genUser.classement,
//     userId = myArray.top30User.userStat.user_id;
//     const leadBoard = document.querySelector(".leadboard"),
//     genUserBtn = document.querySelector(".gen"),
//     genTownBtn = document.querySelector(".town");
    
//     const table = document.querySelector("table"),
//     tbody = document.querySelector("tbody"),
//     thead = document.querySelector("thead"),
//     spanAbove = document.querySelector(".span_above"),
//     spanUnder = document.querySelector(".span_under");
//     let pos,
//     isAbove = 0,
//     isUnder = 0;
//     genUserBtn.style.background = "#e6e6e6";

//     function createTable(array){
//       if(array == genUserBoard)
//       {
//         thead.innerHTML=`
//         <th>Pos</th>
//         <th>Joueur</th>
//         <th>Site</th>
//         <th>Nbr de quiz</th>
//         <th>Temps global (en sec.)</th>
//         <th>Score</th>
//         `
//       }
//       else
//       {
//         thead.innerHTML=`
//         <th>Pos</th>
//         <th>Site</th>
//         <th>Nbr de quiz</th>
//         <th>Temps global (en sec.)</th>
//         <th>Score</th>
//         `
//       }
//       for(i=0; i<array.length; i++)
//       {
//         pos = i + 1;
//         if(array == genUserBoard)
//         {
//           if(parseInt(array[i].user_id) == parseInt(userId))
//           {
//             if(parseInt(array[i].moyenne)<50)
//             {
//               isUnder += 1;
//               tbody.innerHTML += `
//                 <tr class="imp">
//                 <td>${pos}</td>
//                 <td>${array[i].display_name}</td>
//                 <td>${array[i].meta_value}</td>
//                 <td>${array[i].count}</td>
//                 <td>${array[i].time}</td>
//                 <td class="red">${parseInt(array[i].moyenne)}</td>
//                 </tr>
//               `
//             }
//             else
//             {
//               isAbove += 1; 
//               tbody.innerHTML += `
//               <tr class="imp">
//               <td>${pos}</td>
//               <td>${array[i].display_name}</td>
//               <td>${array[i].meta_value}</td>
//               <td>${array[i].count}</td>
//               <td>${array[i].time}</td>
//               <td class="green">${parseInt(array[i].moyenne)}</td>
//               </tr>
//               `
//             }
//           }
//           else if(pos == 1)
//           {   
//             if(parseInt(array[i].moyenne)<50)
//             {
//               isUnder += 1;
//               tbody.innerHTML += `
//                 <tr class="gold">
//                 <td>${pos}</td>
//                 <td>${array[i].display_name}</td>
//                 <td>${array[i].meta_value}</td>
//                 <td>${array[i].count}</td>
//                 <td>${array[i].time}</td>
//                 <td class="red">${parseInt(array[i].moyenne)}</td>
//                 </tr>
//               `
//             }
//             else
//             {
//               isAbove += 1; 
//               tbody.innerHTML += `
//               <tr class="gold">
//               <td>${pos}</td>
//               <td>${array[i].display_name}</td>
//               <td>${array[i].meta_value}</td>
//               <td>${array[i].count}</td>
//               <td>${array[i].time}</td>
//               <td class="green">${parseInt(array[i].moyenne)}</td>
//               </tr>
//               `
//             }
//           }
//           else if(pos == 2)
//           {   
//             if(parseInt(array[i].moyenne)<50)
//             {
//               isUnder += 1;
//               tbody.innerHTML += `
//                 <tr class="silver">
//                 <td>${pos}</td>
//                 <td>${array[i].display_name}</td>
//                 <td>${array[i].meta_value}</td>
//                 <td>${array[i].count}</td>
//                 <td>${array[i].time}</td>
//                 <td class="red">${parseInt(array[i].moyenne)}</td>
//                 </tr>
//               `
//             }
//             else
//             {
//               isAbove += 1; 
//               tbody.innerHTML += `
//               <tr class="silver">
//               <td>${pos}</td>
//               <td>${array[i].display_name}</td>
//               <td>${array[i].meta_value}</td>
//               <td>${array[i].count}</td>
//               <td>${array[i].time}</td>
//               <td class="green">${parseInt(array[i].moyenne)}</td>
//               </tr>
//               `
//             }
//           }
//           else if(pos == 3)
//           {   
//             if(parseInt(array[i].moyenne)<50)
//             {
//               isUnder += 1;
//               tbody.innerHTML += `
//                 <tr class="bronze">
//                 <td>${pos}</td>
//                 <td>${array[i].display_name}</td>
//                 <td>${array[i].meta_value}</td>
//                 <td>${array[i].count}</td>
//                 <td>${array[i].time}</td>
//                 <td class="red">${parseInt(array[i].moyenne)}</td>
//                 </tr>
//               `
//             }
//             else
//             {
//               isAbove += 1; 
//               tbody.innerHTML += `
//               <tr class="bronze">
//               <td>${pos}</td>
//               <td>${array[i].display_name}</td>
//               <td>${array[i].meta_value}</td>
//               <td>${array[i].count}</td>
//               <td>${array[i].time}</td>
//               <td class="green">${parseInt(array[i].moyenne)}</td>
//               </tr>
//               `
//             }
//           }
//           else
//           {
//             if(parseInt(array[i].moyenne)<50)
//             {
//               isUnder += 1;
//               tbody.innerHTML += `
//                 <tr>
//                 <td>${pos}</td>
//                 <td>${array[i].display_name}</td>
//                 <td>${array[i].meta_value}</td>
//                 <td>${array[i].count}</td>
//                 <td>${array[i].time}</td>
//                 <td class="red">${parseInt(array[i].moyenne)}</td>
//                 </tr>
//               `
//             }
//             else
//             {
//               isAbove += 1; 
//               tbody.innerHTML += `
//               <tr>
//               <td>${pos}</td>
//               <td>${array[i].display_name}</td>
//               <td>${array[i].meta_value}</td>
//               <td>${array[i].count}</td>
//               <td>${array[i].time}</td>
//               <td class="green">${parseInt(array[i].moyenne)}</td>
//               </tr>
//               `
//             }
//           }
//         }
//         else
//         {
//           if(parseInt(array[i].moyenne)<50)
//         {
//           isUnder += 1;
//           if(array[i].city == myArray.ville)
//           {
//             tbody.innerHTML += `
//             <tr class="imp">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="red">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else if (pos == 1)
//           {
//             tbody.innerHTML += `
//             <tr class="gold">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="red">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else if (pos == 2)
//           {
//             tbody.innerHTML += `
//             <tr class="silver">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="red">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else if (pos == 3)
//           {
//             tbody.innerHTML += `
//             <tr class="bronze">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="red">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else
//           {
//             tbody.innerHTML += `
//               <tr>
//               <td>${pos}</td>
//               <td>${array[i].city}</td>
//               <td>${array[i].quizCount}</td>
//               <td>${array[i].time}</td>
//               <td class="red">${parseInt(array[i].moyenne)}</td>
//               </tr>
//             `
//           }
//         }
//         else
//         {
//           isAbove += 1;
//           if(array[i].city == myArray.ville)
//           {
//             tbody.innerHTML += `
//             <tr class="imp">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="green">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else if (pos == 1)
//           {
//             tbody.innerHTML += `
//             <tr class="gold">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="green">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else if (pos == 2)
//           {
//             tbody.innerHTML += `
//             <tr class="silver">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="green">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else if (pos == 3)
//           {
//             tbody.innerHTML += `
//             <tr class="bronze">
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="green">${parseInt(array[i].moyenne)}</td>
//             </tr>
//           `
//           }
//           else
//           {
//             tbody.innerHTML += `
//             <tr>
//             <td>${pos}</td>
//             <td>${array[i].city}</td>
//             <td>${array[i].quizCount}</td>
//             <td>${array[i].time}</td>
//             <td class="green">${parseInt(array[i].moyenne)}</td>
//             </tr>
//             `
//           }
//         }
//         }
//       }
//     }

//     createTable(genUserBoard);

//     genUserBtn.addEventListener("click", ()=>{
//       genUserBtn.style.background = "#e6e6e6";
//       genTownBtn.style.background = "#EBB94A";
//       tbody.innerHTML='';
//       thead.innerHTML='';
//       isAbove = 0;
//       isUnder = 0;
//       createTable(genUserBoard);
//       spanAbove.innerHTML = `score > 50 : ${isAbove}`;
//       spanUnder.innerHTML = `score < 50 : ${isUnder}`;
//     })

//     genTownBtn.addEventListener("click", ()=>{
//       genTownBtn.style.background = "#e6e6e6";
//       genUserBtn.style.background = "#EBB94A";
//       tbody.innerHTML='';
//       thead.innerHTML='';
//       isAbove = 0;
//       isUnder = 0;
//       createTable(genTown);
//       spanAbove.innerHTML = `score > 50 : ${isAbove}`;
//       spanUnder.innerHTML = `score < 50 : ${isUnder}`;
//     })

//     spanAbove.innerHTML = `score > 50 : ${isAbove}`;
//     spanUnder.innerHTML = `score < 50 : ${isUnder}`;

//     const dropIcon = document.querySelector(".dropIcon"),
//     legend = document.querySelector(".square_legend");
//     dropIcon.addEventListener("click", ()=>{
//       if(legend.classList.contains("dropLegend"))
//       {
//         legend.classList.remove("dropLegend");
//       }
//       else
//       {
//         legend.classList.add("dropLegend");
//       }
//     })
//   }
//   else
//   {
//   }
//   };

//   // url a trouver
//   xmlhttp.open("GET", url  + '/dashboard_back.php', true);
//   xmlhttp.send();
// });

window.addEventListener("load", ()=>{
  var url = myScript.theme_directory,
  dbParam = {
    "type": "global",
    "filtre": "general",
    "id": null,
  }
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
    {
      var myArray = JSON.parse(this.responseText);
      console.log(myArray);
    }
    else
    {
      console.log("pas ok");
    }
  }
  xmlhttp.open("POST", url  + '/app/leaderboard_admin.php', true);
  xmlhttp.send(dbParam);
});