document.querySelector(".watchlist").onclick = function() {
    let parent = document.querySelector(".card");
    parent.classList.toggle("containsIcon");
    let button = document.querySelector(".watchlist");

    if (!parent.classList.contains("containsIcon")) {
        let iconTag = document.querySelector(".icon");
        iconTag.parentNode.removeChild(iconTag);
        button.setAttribute("value", "not-starred");
        button.innerHTML = "Save";
    } else {
        let iconTag = document.createElement("i");
        iconTag.classList.add("fas");
        iconTag.classList.add("fa-star");
        iconTag.classList.add("icon");
        parent.appendChild(iconTag);
        button.setAttribute("value", "starred");
        button.innerHTML = "Remove";
    }

    let name = document.getElementById("title").innerHTML;
    let star = document.getElementById("watchlist_id").getAttribute("value");
    let image = document.getElementById("image").getAttribute("src");

    let postData = {
        'name' : name,
        'star' : star,
        'image' : image
    };
    
    ajaxPost("../watchlist/add.php", postData, function(response) {

    });
}

function ajax(endpoint, returnFunction) {
	let httpRequest = new XMLHttpRequest();

	httpRequest.open("GET", endpoint);
	httpRequest.send();

	httpRequest.onreadystatechange = function() {
		if( httpRequest.readyState == 4) {
			if(httpRequest.status == 200) {
				returnFunction(httpRequest.responseText);
			}
			else {
				alert('AJAX Error!');
				console.log(httpRequest.status);
			}
		}
	}
}

let parts = window.location.search.substr(1).split("&");
let $_GET = {};
for (let i = 0; i < parts.length; i++) {
    let temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}
let endpoint2 = "https://api.edamam.com/search?q=" + $_GET['recipe_name'] + "&app_id=8ea4ceaf&app_key=a390e6d461f7fedabb70af2709f6add0&from=0&to=1";
ajax(endpoint2, displayResults);


function displayResults(results) {
    let convertedResults = JSON.parse(results);
    convertedResults = convertedResults.hits[0].recipe;

    let cal = document.getElementById("calories");
    cal.innerHTML += parseInt(convertedResults.calories);

    let link = document.getElementById("source");
    link.href = convertedResults.url;

    let img = document.getElementById("image");
    img.src = convertedResults.image;

    let ingred = document.getElementById("ingredients");
    let listTag = document.createElement("ul");
    for (let i=0; i<convertedResults.ingredientLines.length; i++) {
        let bulletTag = document.createElement("li");
        bulletTag.classList.add("ingred");
        bulletTag.innerHTML = convertedResults.ingredientLines[i];
        listTag.appendChild(bulletTag);
    }
    ingred.appendChild(listTag);
}


function ajaxPost(endpointUrl, data, returnFunction) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', endpointUrl, true);
    // POST requests need extra header information
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(){
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                returnFunction( xhr.responseText );
            } else {
                alert('AJAX Error.');
                console.log(xhr.status);
            }
        }
    }
    xhr.send(JSON.stringify(data));
};