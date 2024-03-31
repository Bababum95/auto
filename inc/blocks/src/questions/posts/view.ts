import axios from "axios";
import { questionUtils } from "@utils";

const api = axios.create({
	baseURL: `${window.location.origin}/wp-json/auto/v1/questions`,
})

const loadingTrigger = document.querySelector('.wp-block-auto-questions-posts__observed');
const questionCategories = Array.from(document.querySelectorAll('.wp-block-auto-table-of-contents__category[data-category-id]'));
let currentSectionId = window.location.hash.replace("#question-", "");

const categoryIdList = questionCategories?.map((link) => {
	return link.getAttribute('data-category-id');
})

const observer = new IntersectionObserver((entries) => {
	entries.forEach(entry => {
		if (entry.isIntersecting) {
			loadingTrigger.classList.add('loading');
			const link = questionUtils.getLinkByQuestionId(currentSectionId);
			const categoryId = questionUtils.getCurrentCategoryId(link);
			const nextCategoryId = categoryIdList[categoryIdList.indexOf(categoryId) + 1];
			api(nextCategoryId)
				.then((res) => {
        			loadingTrigger.insertAdjacentHTML('beforebegin', res.data);
					loadingTrigger.classList.remove('loading');
				})
				.catch((error) => {
					console.log(error);
					loadingTrigger.classList.remove('loading');
				})
		}
	});
}, {
	rootMargin: '200px 0px',
	threshold: 1.0
});

if (loadingTrigger) observer.observe(loadingTrigger);

function toggleCurrentQuestion(id: string) {
	questionUtils.getLinkByQuestionId(currentSectionId)?.classList.remove('current');
	const link = questionUtils.getLinkByQuestionId(id);
	link?.classList.add('current');
	questionUtils.openCurentQuestionLink(link);
	currentSectionId = id;
}

window.addEventListener('scroll', () => {
	document.querySelectorAll('.question')?.forEach(section => {
		const rect = section.getBoundingClientRect();
		if (rect.top > 0 || rect.bottom < 0) return;
		const newId = section.id.replace("question-", "");
		if (currentSectionId !== newId) {
			toggleCurrentQuestion(newId);
		}
	});
});