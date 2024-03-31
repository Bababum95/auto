import { questionUtils } from "@utils";

const questionId = questionUtils.getFirstQuestion();
const link = questionId ? questionUtils.getLinkByQuestionId(questionId) : null;

if (link) {
    link.classList.add('current');
	questionUtils.openCurentQuestionLink(link);
}