<?php /* это метод оплаты по карте без 3ds */ ?>
<li class="col-md-4 wow animated fadeIn" data-wow-delay="1.0s">
    <a href="#" class="method" onclick="event.preventDefault();stripe('usd');">
        <span class="method-logo"><img src="assets/images/methods/visa.png" alt=""></span>
       <!-- <span class="method-rate">
            <span class="value">{{round($ammount, 2)}}</span>
            <span class="currency">$</span>
        </span> -->
    </a>
</li>