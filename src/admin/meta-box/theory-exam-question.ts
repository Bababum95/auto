import { __ } from '@wordpress/i18n';;

document.addEventListener('DOMContentLoaded', function () {
    const addAnswerButton = document.getElementById('add_answer');
    if (addAnswerButton) {
        addAnswerButton.addEventListener('click', function () {
            const answers = document.querySelectorAll('.answer');
            const index = answers.length;
            const newAnswer = `
                <div class="answer">
                    <h4 class="answer__title">${__('Antwort', 'auto')} ${index + 1}</h4>
                    <div class="answer__content">
                        <div class="answer__text">
                            <p class="post-attributes-label-wrapper">
                                <label class="post-attributes-label" for="answer_text_${index}">${__('Text', 'auto')}</label>
                            </p>
                            <input type="text" id="answer_text_${index}" name="answers[${index}][text]" value="" />
                        </div>
                        <label class="answer__correct">
                            <input type="checkbox" id="answer_correct_${index}" name="answers[${index}][correct]" value="1" />
                            ${__('Korrekt', 'auto')}?
                        </label>
                    </div>
                    <p class="post-attributes-label-wrapper">
                        <label class="post-attributes-label" for="answer_comment_${index}">${__('Kommentar', 'auto')}</label>
                    </p>
                    <textarea class="answer__comment" rows="4" id="answer_comment_${index}" name="answers[${index}][comment]"></textarea>
                </div>`;
            const lastAnswer = document.querySelector('.answer:last-of-type');
            if (lastAnswer) {
                lastAnswer.insertAdjacentHTML('afterend', newAnswer);
            }
        });
    }
});
