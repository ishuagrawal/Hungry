function displayResults(results) {
    // Clears out all previous search results
    let rows = document.querySelector("#data");
    while(rows.hasChildNodes() ) {
		rows.removeChild(rows.lastChild)
	}
    
    let convertedResults = JSON.parse(results);
    convertedResults = convertedResults.hits;

    // loop through each result
    for (let i=0; i<12; i++) {
        let rows = document.querySelector("#data");
        
        // Create the card (bootstrap)
        let colTag = document.createElement("div");
        colTag.classList.add("result");
        colTag.classList.add("col-6");
        colTag.classList.add("col-md-4");
        colTag.classList.add("col-lg-3");
        
        // Create the card (bootstrap)
        let cardTag = document.createElement("div");
        cardTag.classList.add("card");
        cardTag.id = "card" + i;
        
        // Recipe image
		let image = document.createElement("img");
        image.id = "image";
        if (convertedResults[i].recipe.image !== null) {
            image.src = convertedResults[i].recipe.image;
        } else {
            image.src = "images/error.jpg";
        }
        image.alt = "Image not available";
        image.classList.add("card-img-top");
        cardTag.appendChild(image);

        // Card body structure
        let cardBody = document.createElement("div");
        cardBody.classList.add("card-body");

        // Card body content
        let title = document.createElement("h5");
        title.classList.add("card-title");
        let name = convertedResults[i].recipe.label;
        title.innerHTML = name;
        cardBody.appendChild(title);

        // Buttons div
        let buttonTag = document.createElement("div");
        buttonTag.classList.add("buttons");

        // Details button
        let detailsTag = document.createElement("a");
        detailsTag.href = "../details/details.php?recipe_name=" + name;
        detailsTag.classList.add("btn");
        detailsTag.classList.add("details");
        detailsTag.innerHTML = "Details";
        detailsTag.target = "_blank";
        buttonTag.appendChild(detailsTag);

        
        // Add to watchlist button
        let watchlistTag = document.createElement("button");
        watchlistTag.type = "button";
        watchlistTag.classList.add("btn");
        watchlistTag.classList.add("watchlist");
        watchlistTag.value = "";
        watchlistTag.id = "watchlist_id";
        watchlistTag.innerHTML = "Save";
        buttonTag.appendChild(watchlistTag);

        let postData = {
            'name' : name
        };
    
        ajaxPost("contains.php", postData, function(response) {
            if (response) {
                detailsTag.href = "../details/details.php?watchlist=true&recipe_name=" + name;
                
                let iconTag = document.createElement("i");
                iconTag.classList.add("fas");
                iconTag.classList.add("fa-star");
                iconTag.classList.add("icon");
                cardTag.appendChild(iconTag);
                watchlistTag.setAttribute("value", "starred");
                watchlistTag.innerHTML = "Remove";
            }
        });

        cardBody.appendChild(buttonTag);
        cardTag.appendChild(cardBody);
        colTag.appendChild(cardTag);
        rows.appendChild(colTag);
    }
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
				alert('AJAX Error.');
				console.log(httpRequest.status);
			}
		}
	}
}

// When user submits the search form -> retrieve the results
document.querySelector("#search-form").onsubmit = function(event) {
	event.preventDefault();

    let searchInput = document.querySelector("#search-id").value.trim();
    if (searchInput.length != 0) {
        document.querySelector('#search-id').classList.remove('is-invalid');
        searchInput = encodeURI(searchInput);
        let endpoint2 = "https://api.edamam.com/search?q=" + searchInput + "&app_id=" + API_ID + "&app_key=" + API_KEY + "&from=0&to=12";
        // let endpoint2 = "https://api.edamam.com/search?q=" + searchInput + "&app_id=8ea4ceaf&app_key=a390e6d461f7fedabb70af2709f6add0&from=0&to=12";
        ajax(endpoint2, displayResults);
    } else {
        document.querySelector('#search-id').classList.add('is-invalid');
        alert("Please enter a search term");
    }

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

// Adding (or removing) the "add to watchlist" button
$(document).on("click",".watchlist",function(event) {
    let parent = event.target.parentNode.parentNode.parentNode;
    let button = event.target;

    parent.classList.toggle("containsIcon");

    if (!parent.classList.contains("containsIcon")) {
        let iconTag = parent.querySelector(".icon");
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

    let name = parent.querySelector(".card-title").innerHTML;
    let star = parent.querySelector("#watchlist_id").getAttribute("value");
    let image = parent.querySelector("#image").getAttribute("src");
	
	let postData = {
        'name' : name,
        'star' : star,
        'image' : image
    };
    
    ajaxPost("../watchlist/add.php", postData, function(response) {
        let detailsLink = parent.querySelector(".details");
        detailsLink.href = "../details/details.php?watchlist=" + response + "&recipe_name=" + name;
    });
});