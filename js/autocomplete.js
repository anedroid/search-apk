const autocomplete = document.querySelector("#autocomplete");
let timeout_search;

document.querySelector("#searchbox").addEventListener("input", e => {
	const query = e.target.value;
	clearTimeout(timeout_search);
	
	timeout_search = setTimeout(() => {
		fetch(`search-api.php?q=${encodeURI(query)}&max=5`)
			.then(res => res.json())
			.then(res => {
				autocomplete.innerHTML = null;
				res.results.forEach(el => {
					let item = document.createElement("option");
					item.value = el.name;
					autocomplete.appendChild(item);
				});
			});
	}, 200, e);
});