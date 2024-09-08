document.addEventListener('DOMContentLoaded', function () {

    // Handle form submissions
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Operation successful');
                    window.location.href = data.redirect;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Handle job application
    const applyButtons = document.querySelectorAll('.apply-job');
    applyButtons.forEach(button => {
        button.addEventListener('click', function () {
            const jobId = this.dataset.jobId;
            window.location.href = `apply_job.php?job_id=${jobId}`;
        });
    });
});
