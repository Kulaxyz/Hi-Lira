<?php /* это метод оплаты по карте через BTC */ ?>
<li class="col-md-4 wow animated fadeIn" data-wow-delay="1.0s">
    <a href="#" class="method" onclick="proceed_to_btc_payment();">
        <span class="method-logo"><img src="assets/images/methods/visa.png" alt=""></span>
       <!-- <span class="method-rate">
            <span class="value">{{round($ammount, 2)}}</span>
            <span class="currency">$</span>
        </span> -->
    </a>
</li>
<script type="text/javascript">
	function proceed_to_btc_payment()
	{
		let payment_form = document.getElementById('payment_form');
		if(payment_form)
		{ document.getElementById('payment_form').submit(); }
		else
		{ alert('Sorry, but this option in not available right now. Please, try later or use another one.');}
	}
</script>
