import LinkBrowser from "@typo3/backend/link-browser.js";

class LinkHandler {
	constructor() {
		var form_el = document.getElementById("lmatomoform");
		form_el.addEventListener("submit", function(event) {
			event.preventDefault();
			var value = document.getElementById('lmatomo').value;
			LinkBrowser.finalizeFunction('t3://matomo?action=' + value);
		});
	}
}

export default new LinkHandler();
