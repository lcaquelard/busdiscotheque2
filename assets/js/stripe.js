import $ from "jquery";

$('#container-cb').ready(function() {
    const key = 'pk_live_51JU8v5KpEcE8cXMNE65xwQu8zsaKqIQNcfcb5jBohtRa0lA6DcjpgWcdFNvcUDHucaQuujmmY2nZDYqzdlcHVJNP00Q55yRX5D';
    // Create a Stripe client.
    const stripe = Stripe(key, {
        betas: ['payment_intent_beta_3']
    });

    // Create an instance of Elements.
    const elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    const style = {
        base: {
            color: '#323232',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    const cardElement = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    cardElement.mount('#card-element');

    const cardholderName = document.getElementById('cardholder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', function (ev) {

        stripe.handleCardPayment(
            clientSecret, cardElement, {
                source_data: {
                    owner: {name: cardholderName.value}
                }
            }
        ).then(function (result) {
            if (result.error) {
                document.getElementById('card-errors').textContent = 'Erreur : ' + result.error.message;
            } else {
                document.getElementById('card-errors').textContent = '';
                document.getElementById('card_form').textContent = '';
                document.getElementById('card-success').textContent = 'Paiement confirmé. Merci.';
            }
        });
    });
});