let current_temp;

let latitude = "43.6532"
let longitude = "79.3832"

//get weather data
fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current=temperature_2m,precipitation,&timezone=EST`, {
})
.then(res => res.json())
.then(data => {
   current_temp = data.current.temperature_2m;
   document.getElementById("cur_temp").innerHTML = current_temp;
   return console.log(data);
})
.catch(error => console.log("Uh Oh " + error))

// res.ok ? console.log("Success") : console.log("Failure")
