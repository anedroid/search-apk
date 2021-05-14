let timeout_form;
document.querySelectorAll("form").forEach(form => {
	form.querySelectorAll(".autosubmit").forEach(el => {
		el.addEventListener("change", e => {
			const time = e.target.dataset.timeout;
			if (time) {
				clearTimeout(timeout_form);
				timeout_form = setTimeout(form => form.submit(), time, form);
			} else {
				form.submit();
			}
		});
	});
});