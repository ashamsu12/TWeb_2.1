
function renderCards() {
    
 var data = [{
  "id" : 1,
  "imagesrc":"../images/logo/software.jpg",
  "teamname":"Team Coco",
  "pdesc":"Project-based learning (PBL) is a student-centered pedagogy that involves a dynamic classroom approach in which it is believed that students acquire a deeper knowledge through active exploration of real-world challenges and problems.",
  "ptype":"Computer Science",
  "institution":"UOWD"}
, {
 "id" : 2,
  "imagesrc":"../images/logo/software.jpg",
  "teamname":"Team Ice",
  "pdesc":"Project-based learning (PBL) is a student-centered pedagogy that involves a dynamic classroom approach in which it is believed that students acquire a deeper knowledge through active exploration of real-world challenges and problems.",
  "ptype":"Computer Science",
  "institution":"MiddleSex"
}, {
  "id" : 3,
  "imagesrc":"../images/logo/software.jpg",
  "teamname":"Team Snow",
  "pdesc":"Project-based learning (PBL) is a student-centered pedagogy that involves a dynamic classroom approach in which it is believed that students acquire a deeper knowledge through active exploration of real-world challenges and problems.",
  "ptype":"Enigineering",
  "institution":"CUD"
}, {
 "id" : 4,
  "imagesrc":"../images/logo/software.jpg",
  "teamname":"Team One",
  "pdesc":"Project-based learning (PBL) is a student-centered pedagogy that involves a dynamic classroom approach in which it is believed that students acquire a deeper knowledge through active exploration of real-world challenges and problems.",
  "ptype":"Engineering",
  "institution":"AUD"
}, {
 "id" : 5,
  "imagesrc":"../images/logo/software.jpg",
  "teamname":"Team Cat",
  "pdesc":"Project-based learning (PBL) is a student-centered pedagogy that involves a dynamic classroom approach in which it is believed that students acquire a deeper knowledge through active exploration of real-world challenges and problems.",
  "ptype":"Computer Science",
  "institution":"AUS"
}, {
 "id" : 6,
  "imagesrc":"../images/logo/software.jpg",
  "teamname":"Team Dhabi",
  "pdesc":"Project-based learning (PBL) is a student-centered pedagogy that involves a dynamic classroom approach in which it is believed that students acquire a deeper knowledge through active exploration of real-world challenges and problems.",
  "ptype":"Engineering",
  "institution":"AbuDhabi University"
}];

  console.log("RENDERING");
  var division;
  $.each(data, function(key, value) {
   division = document.createElement("li");

    division.className = 'cards__item';

   division.innerHTML= '<div class="card">\
       <img class="card__image" src="'+ value.imagesrc +'" alt="John" style="border-radius:70% ">\
      <div class="card__content">\
        <div class="card__title">'+value.teamname +'</div>\
        <div class="card__title">'+value.institution +'</div>\
        <p class="card__text">'+ value.pdesc +'</p>\
        <button class="btn btn--block card__btn">Vote</button>\
</div>\</div>';
    
 document.getElementById("cardcontent").append(division);
   
  });
}

//DATA:
