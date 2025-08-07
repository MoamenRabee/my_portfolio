// Contact Form Handler
document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('contact-submit-btn');
    const responseMessage = document.getElementById('contact-response');

    if (contactForm) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';

            // Clear previous messages
            responseMessage.innerHTML = '';
            responseMessage.className = 'contact-response';

            try {
                // Collect form data
                const formData = new FormData(contactForm);

                // Send request
                const response = await fetch('/contact', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Success message
                    responseMessage.innerHTML = `
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            ${data.message}
                        </div>
                    `;
                    responseMessage.className = 'contact-response success';

                    // Reset form
                    contactForm.reset();
                } else {
                    // Error message
                    let errorHtml = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            ${data.message || 'حدث خطأ أثناء إرسال الرسالة'}
                        </div>
                    `;

                    // Show validation errors if any
                    if (data.errors) {
                        errorHtml += '<ul class="error-list">';
                        Object.values(data.errors).forEach(errorArray => {
                            errorArray.forEach(error => {
                                errorHtml += `<li>${error}</li>`;
                            });
                        });
                        errorHtml += '</ul>';
                    }

                    responseMessage.innerHTML = errorHtml;
                    responseMessage.className = 'contact-response error';
                }
            } catch (error) {
                // Network or other error
                responseMessage.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        A connection error occurred. Please try again.
                    </div>
                `;
                responseMessage.className = 'contact-response error';
                console.error('Contact form error:', error);
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Send Message';

                // Scroll to response message
                responseMessage.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
});
