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

$(document).on("click",".watchlist",function(event) {

	let rows = document.querySelector("#data");
    while(rows.hasChildNodes() ) {
		rows.removeChild(rows.lastChild)
	}
	
	let cardParent = event.target.parentNode.parentNode.parentNode;
	let cardTitle = cardParent.querySelector(".card-title").innerHTML;
	
	let postData = {
		'name' : cardTitle
	};

	ajaxPost("delete.php", postData, function(response) {
		let results = JSON.parse(response);

		for (let i=0; i<results.length; i++) {

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
			if (results[i].image !== null) {
				image.src = results[i].image;
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
			let name = results[i].name;
			title.innerHTML = name;
			cardBody.appendChild(title);
	
			// Buttons div
			let buttonTag = document.createElement("div");
			buttonTag.classList.add("buttons");
	
			// Details button
			let detailsTag = document.createElement("a");
			detailsTag.href = "../details/details.php?watchlist=true&recipe_name=" + name;
			detailsTag.classList.add("btn");
			detailsTag.classList.add("details");
			detailsTag.innerHTML = "Details";
			detailsTag.target = "_blank";
			buttonTag.appendChild(detailsTag);
	
			// Remove from watchlist button
			let watchlistTag = document.createElement("button");
			watchlistTag.type = "button";
			watchlistTag.classList.add("btn");
			watchlistTag.classList.add("watchlist");
			watchlistTag.innerHTML = "Remove";
			buttonTag.appendChild(watchlistTag);
	
			cardBody.appendChild(buttonTag);
			cardTag.appendChild(cardBody);
			colTag.appendChild(cardTag);
			rows.appendChild(colTag);
		}

		let total = document.querySelector(".num");
		total.innerHTML = "Showing " + results.length + " result(s).";
	});

});