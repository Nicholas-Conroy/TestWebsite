window.onload = event => {
    imageSlider();
    worldClocks();
}

window.addEventListener("scroll", scrollFade);
scrollFade(); //checks position of scroll when page is loaded

let imgIndex = 0;

//displays images in slider form
function imageSlider() {
    let images = document.getElementsByClassName("homepage-img");
    
    //hides all images 
    for(let i=0; i<images.length; i++){
        images[i].style.display = "none";    
    }

    imgIndex++;

    //resets slider back to first image
    if(imgIndex > images.length)
    imgIndex = 1;

    //displays correct image; index is always one ahead so -1 compensates for this 
    images[imgIndex-1].style.display = "block";

    //calls function repeatedly, with 5 second delay
    setTimeout(imageSlider, 5000);
    
}

const timeZones = document.getElementById("timezone-list");

timeZones.addEventListener("change", worldClocks);


// displays correct local time for chosen time zone from dropdown list 
function worldClocks(){
    let zone = "";
    for(let i=0; i<timeZones.length; i++){
        if(timeZones[i].selected){
            zone = timeZones[i].value;
        }
    }
    //current time is in en-US format
    let currentTime = new Date().toLocaleTimeString("en-US", {timeZone: zone});
    let result = document.getElementById("timetext");
    
    if(zone !== ""){
        let digitTime = currentTime.split(" "); 
        let timeSections = digitTime[0].split(":");
    
        result.innerHTML = `${timeSections[0]}:${timeSections[1]} ${digitTime[1]}`;
    }    
    else {
        //TODO: want to display local time before option is chosen
        result.innerHTML = "popp"; 
    }
}


// on-scroll effects 
function scrollFade(){
    let fadeInElements = document.querySelectorAll(".fade-in-block");
    
    for(let i=0; i<fadeInElements.length; i++){
        let windowHeight = window.innerHeight; //height of current window 
        let heightFromTop = fadeInElements[i].getBoundingClientRect().top; //distance from current block to top of window
        let heightFromBottom = fadeInElements[i].getBoundingClientRect().bottom; //distance from current block to top of window
        let fadeInHeight = 80; 

        if(heightFromTop < windowHeight - fadeInHeight){
            fadeInElements[i].classList.add("active");
        }
        else{
            fadeInElements[i].classList.remove("active");

        }
    }
}