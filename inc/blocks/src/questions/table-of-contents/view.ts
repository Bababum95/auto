const categoriesOpener = document.querySelectorAll(
	'.wp-block-auto-table-of-contents__category-name'
);

categoriesOpener.forEach((categoryOpener) => {
	categoryOpener.addEventListener('click', () => {
		categoryOpener.parentElement.classList.toggle('open');
	});
});
