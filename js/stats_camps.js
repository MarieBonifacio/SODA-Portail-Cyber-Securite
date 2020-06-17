window.addEventListener("load", ()=>{
  let id;
  const ulCamp = document.querySelector(".listCamp"),
        campName = document.querySelector(".name_camp"),
        spanCamp = document.querySelectorAll(".camp_name"),
        lisCamp = document.querySelectorAll(".liC");
  campName.addEventListener("click", ()=>{
    if(ulCamp.classList.contains("hidden"))
    {
      ulCamp.classList.remove("hidden");
    }
    else
    {
      ulCamp.classList.add("hidden");
    }
  })

  lisCamp.forEach(li => {
    li.addEventListener("click", ()=>{
      id = li.dataset.id;
      ulCamp.classList.add("hidden");
      spanCamp.forEach(span => {
        span.innerHTML =li.textContent;
      });
      console.log(id);
    })
  });
})