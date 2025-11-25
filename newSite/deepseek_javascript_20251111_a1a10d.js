<script>
    // Stripe Configuration - REPLACE WITH YOUR ACTUAL PUBLISHABLE KEY
    const stripe = Stripe('pk_live_your_publishable_key_here');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    
    // Mount card element
    cardElement.mount('#card-element');

    // Handle form submission
    const paymentForm = document.getElementById('paymentForm');
    const submitButton = document.getElementById('submit-payment');
    const cardErrors = document.getElementById('card-errors');
    const paymentLoading = document.getElementById('paymentLoading');
    const paymentSuccess = document.getElementById('paymentSuccess');

    let currentPlan = '';
    let currentAmount = 0;

    // Plan selection
    document.querySelectorAll('.select-plan').forEach(button => {
        button.addEventListener('click', function() {
            currentPlan = this.getAttribute('data-plan');
            currentAmount = parseInt(this.getAttribute('data-amount'));
            document.getElementById('payment-amount').textContent = `$${(currentAmount / 100).toFixed(2)}`;
            document.getElementById('paymentModal').style.display = 'flex';
        });
    });

    // Close modal
    document.querySelector('.close-modal').addEventListener('click', closeModal);
    document.getElementById('success-close').addEventListener('click', closeModal);

    function closeModal() {
        document.getElementById('paymentModal').style.display = 'none';
        paymentForm.style.display = 'block';
        paymentLoading.style.display = 'none';
        paymentSuccess.style.display = 'none';
        document.getElementById('paymentForm').reset();
    }

    // Handle payment form submission
    paymentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const propertyAddress = document.getElementById('property-address').value;

        try {
            // Create payment intent on your server
            const response = await fetch('/payment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    amount: currentAmount,
                    plan_type: currentPlan,
                    customer_name: name,
                    customer_email: email,
                    customer_phone: phone,
                    property_address: propertyAddress
                })
            });

            const { clientSecret, error } = await response.json();

            if (error) {
                throw new Error(error);
            }

            // Confirm payment with Stripe
            const { error: stripeError, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: name,
                        email: email,
                        phone: phone,
                    },
                }
            });

            if (stripeError) {
                cardErrors.textContent = stripeError.message;
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-lock"></i> Pay $' + (currentAmount / 100).toFixed(2);
            } else {
                // Payment successful
                paymentForm.style.display = 'none';
                paymentLoading.style.display = 'none';
                paymentSuccess.style.display = 'block';
                
                // Here you can send confirmation email, update database, etc.
                console.log('Payment successful:', paymentIntent);
            }
        } catch (error) {
            cardErrors.textContent = error.message;
            submitButton.disabled = false;
            submitButton.innerHTML = '<i class="fas fa-lock"></i> Pay $' + (currentAmount / 100).toFixed(2);
        }
    });

    // Real-time card validation
    cardElement.on('change', ({ error }) => {
        if (error) {
            cardErrors.textContent = error.message;
        } else {
            cardErrors.textContent = '';
        }
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Contact form handling
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your interest! We will contact you shortly.');
        this.reset();
    });

    // Header background on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (window.scrollY > 100) {
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
        } else {
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
        }
    });
</script>