<?php /* это метод оплаты через apple/google/microsoft-pay */
$path = base_path();
require_once($path.'/user_libs/stripe_php/stripe_config.php');
$amount_to_pay = $ammount; /* число платежа для страйпа - в центах */ $amount_to_pay_in_cents = $ammount * 100;
?>
<style type="text/css">#stripe_submit_button{<?php if ($is_stripe_test == 1) {echo 'background: #ccc;';} else {echo 'background: #39298e;';}?>}</style>  
<li id="apple_pay_li" class="col-md-4 wow animated fadeIn" data-wow-delay="1.0s">
        <a href="#" class="method" onclick="event.preventDefault();">
        <!-- Start: Apple Pay element -->
            <div id="payment-request-button"><div id="apple_page_loader" class="apple_page_loader"></div><!-- A Stripe Element will be inserted here. --></div>
        <!-- End: Apple Pay element -->
        <!-- <div id="apple_alert" class="apple_alert loaded"><p style="font-family: Roboto-Regular,sans-serif;">If you do not see the payment button, it probably means, that your browser doesn't meet some special requirements.<br>Try to check your browser and device properties.</p></div> -->
        </a>
<!-- Start: Apple script -->
<script type="text/javascript">
// as it is recomended in the Stripe docs, the Stripe js library v3 is authomaticly connected in the head-tags of evey page on the site
// создаём клиент Stripe'a and set our pk key
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');
var paymentRequest = stripe.paymentRequest(
{
    country: 'US',
    currency: 'usd',
    total: 
        {
            label: 'Libra coins purchase',
            amount: <?php echo $amount_to_pay_in_cents; ?>,
        },
    requestPayerName: true,
    requestPayerEmail: true,
});
// создаём набор элементов
var elements = stripe.elements();
// создаём элемент
var prButton = elements.create('paymentRequestButton',
    {
        paymentRequest: paymentRequest,
        style: {
        paymentRequestButton:
            {
                type: 'default', // default: 'default'
                theme: 'light', // default: 'dark'
                height: '40px', // default: '40px', the width is always '100%'
            },
        },
    });
// проверяем доступность метода и вставляем элемент в блок
paymentRequest.canMakePayment().then(function(result)
{
    if (result)
        {
            document.getElementById('apple_page_loader').classList.add('loaded');
            document.getElementById('apple_page_loader').remove();
            //document.getElementById('apple_alert').remove();
            prButton.mount('#payment-request-button');
            // достаём долбанный csrf токен для робота
            var csrf = document.getElementsByName('_token')[0].value;
            console.log(csrf);
            paymentRequest.on('token', function(ev)
                {
                    fetch("/pay/apple-pay/result", 
                        {
                            method: 'POST',
                            body: JSON.stringify(
                                {
                                    token: ev.token.id,
                                    _token: csrf,
                                    amount_to_pay: <?php echo $amount_to_pay; ?>,
                                }),
                            headers: {'content-type': 'application/json'},
                        })
                    .then(function(response)
                    {
                        if (response.ok)
                            {
                                ev.complete('success');
                                console.log(response);
                                //prButton.unmount();
                                //getElementById('payment-request-button').remove();
                                //getElementById('apple_pay_li').remove();
                                //querySelector('#apple_alert').remove();
                                alert('Thank you! The payment has been successfuly created. If nothing else prevents it from reaching its destination, you may notice the coins added to your account right now! Please be aware of the fact that your bank may not authorize the transaction.');
                            }
                        else
                            {
                                ev.complete('fail');
                                console.log(response);
                                alert('An error has occured. Please, try once more. If the problem keeps occuring, feel free to contact us and we will do everything to help you!');
                            }
                    });
                });
        }
    else
        {
            setTimeout(function(){document.getElementById('apple_page_loader').classList.add('loaded');}, 3000);
            setTimeout(function(){document.getElementById('apple_pay_li').classList.add('loaded');}, 3000);
            //document.getElementById('apple_pay_li').remove();
            //document.getElementById('apple_alert').classList.remove('loaded');
        }
});
</script>
<!-- End: Apple script -->
</li>