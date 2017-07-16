{!! Form::open(['route' => $route, 'method' => 'post', 'id' => 'payment-form']) !!}
    {!! csrf_field() !!}
    <div class="form-row">
        <label for="card-element">
            @lang('Credit or debit card')
        </label>
        <div id="card-element">
            <!-- a Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display Element errors -->
        <div id="card-errors"></div>
    </div>
    <input type="submit" class="btn btn-primary" value="@lang('Subscribe')"></input>
{!! Form::close() !!}

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var stripe = Stripe('{{ \Config::get('services.stripe.key') }}');
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '24px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                },
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    });
</script>
@endpush

