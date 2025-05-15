document.addEventListener('DOMContentLoaded', function() {
    const answeredCount = document.getElementById('answeredCount');
    const progressBar = document.getElementById('progressBar');
    const radios = document.querySelectorAll('input[type="radio"]');
    const total = window.totalQuestions;
    const questionIds = window.questionIds;

    function updateProgress() {
        let answered = 0;
        questionIds.forEach(id => {
            if(document.querySelector('input[name="question_' + id + '"]:checked')) answered++;
        });
        let percent = total === 0 ? 0 : Math.round((answered/total)*100);
        progressBar.style.width = percent + '%';
        answeredCount.textContent = answered;
    }

    radios.forEach(radio => {
        radio.addEventListener('change', updateProgress);
    });
    updateProgress();
}); 