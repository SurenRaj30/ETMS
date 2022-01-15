<!DOCTYPE html>
<html>
   <head>
      <title>Stripe Payment Page - HackTheStuff</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <style type="text/css">
         .panel-title {
         display: inline;
         font-weight: bold;
         }
         .display-table {
         display: table;
         }
         .display-tr {
         display: table-row;
         }
         .display-td {
         display: table-cell;
         vertical-align: middle;
         width: 61%;
         }
      </style>
   </head>
   <body>
     <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
               <div class="card shadow">
                  <div class="card-header">
                     Stripe-Booking Details
                  </div>
                  <form role="form"
                  action="{{ route('payment')}}"
                  method="POST"
                  class="require-validation"
                  data-cc-on-file="false"
                  data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                  id="payment-form">
                  @csrf
                     <div class="card-body">
                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Chosen Service') }}</label>
                           <div class="col-md-6">
                               <input class="form-control" value="{{$booking->s_name}}" name="s_name" required>
                           </div>
                       </div>
                       <input type="hidden" name="provider_id" value="{{$booking->provider_id}}">
                       <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('No of Tourist') }}</label>
                          <div class="col-md-6">
                              <input class="form-control" value="{{$booking->no_tourist}}" name="no_tourist" required>
                          </div>
                      </div>
                      <div class="form-group row">
                       <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tour Schedule') }}</label>
                       <div class="col-md-3">
                           <input class="form-control" value="{{$booking->start}}" name="start" type="date" required>
                       </div>
                       <div class="col-md-3">
                          <input class="form-control" value="{{$booking->end}}" name="end" type="date" required>
                      </div>
                      </div>
                       </div>
                     </div>
                     <div class="card shadow">
                       <div class="card-header">
                          Stripe-Payment Details
                       </div>
                       <div class='form-group row mt-3'>
                          <label class="col-md-4 col-form-label text-md-right">Name on Card</label>
                          <div class='col-md-6 form-group required'>
                             <input
                                class='form-control' size='4' type='text'>
                          </div>
                       </div>
                       <div class='form-group row mt-3'>
                          <label class="col-md-4 col-form-label text-md-right">Card Number</label>
                          <div class='col-md-6 form-group required'>
                             <input
                                class='form-control card-number' size='20' type='text'>
                          </div>
                       </div>
                       <div class='form-row row p-3'>
                          <div class='col-xs-12 col-md-4 form-group cvc required'>
                             <label class='control-label'>CVC</label> <input autocomplete='off'
                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                type='text'>
                          </div>
                          <div class='col-xs-12 col-md-4 form-group expiration required'>
                             <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                type='text'>
                          </div>
                          <div class='col-xs-12 col-md-4 form-group expiration required'>
                             <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                type='text'>
                          </div>
                       </div>
                       <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Deposit Amount') }}</label>
                        @if ($booking->totalPrice<=20)
                        <div class="col-md-6">
                           <input class="form-control" value="{{$booking->totalPrice}}" name="depositPrice" required>
                       </div>
                        @else
                        <div class="col-md-6">
                           <input class="form-control" value="{{($booking->totalPrice)/(2)}}" name="depositPrice" required>
                       </div>
                        @endif
                    </div>
                       <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Total Price') }}</label>
                          <div class="col-md-6">
                              <input class="form-control" value="{{$booking->totalPrice}}" name="totalPrice" required>
                          </div>
                      </div>
                      <div class="row">
                       <div class="col-md-12">
                          <button class="btn btn-primary btn-block" type="submit">Proceed</button>
                       </div>
                    </div>
                  </form>
                  
            </div>
        </div>
     </div>
   <body>
   <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
   <script type="text/javascript">
      $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});
   </script>
</html>