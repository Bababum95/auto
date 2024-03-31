export const questionUtils = {
    getFirstQuestion: () => {
        return document.querySelector('.question')?.id.replace("question-", "");
    },
    getCurrentCategoryId: (link: Element) => {
        const category = link.parentElement.closest('[data-category-id]');
        return category?.getAttribute('data-category-id');
    },
    getLinkByQuestionId: (questionId) => {
        return document.querySelector('.wp-block-auto-table-of-contents__link[data-question-number="' + questionId + '"]');
    },
    openCurentQuestionLink: (link: Element) => {
        let current = link;

        while (current.parentElement) {
            const parent = current.parentElement.closest('.wp-block-auto-table-of-contents__category');
            if (!parent) break;

            parent.classList.add('open');
            current = parent;
        }
    }
}