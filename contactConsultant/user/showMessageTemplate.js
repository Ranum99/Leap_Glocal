window.onload = closeAndOpenQuestion;

function closeAndOpenQuestion() {
    let newQuestion = document.getElementById('newQuestionBtn');
    let wholeQuestionWindow = document.getElementById('newQuestionSection');
    let questionForm = document.getElementById('questionForm');

    newQuestion.addEventListener('click', (event) => {
        wholeQuestionWindow.style.display = 'flex';
    });

    wholeQuestionWindow.addEventListener('click', (event) => {
        let isClickedInside = questionForm.contains(event.target);

        if (!isClickedInside) {
            wholeQuestionWindow.style.display = 'none';
        }
    });
}

