<?php
// the following are the current Stripe keys:
    //$pk_test = 'pk_test_FmSb2uIYMFrwNKwWv2pykhRq00gV92syCI';
    //$sk_test = 'sk_test_mnQ7iKrnLy389h7Q0qA6ftBi00xb3IzHkO';
    //$pk_live = 'pk_live_QFKUlgxCZFy6RJJQf0L1DFBc00xGwvMMbF';
    //$sk_live = 'sk_live_0144ucaNPD4hZm75Lr58tBnJ008MgIdk1L';
    
    $sk_test = setting('stripe.sk_test');
    $pk_test = setting('stripe.pk_test');
    $sk_live = setting('stripe.sk_live');
    $pk_live = setting('stripe.pk_live');
    $is_stripe_test = setting('stripe.stripe_test_mode');

// choose the payment type: test or live
//$is_stripe_test = 1;

    if ($is_stripe_test == 1)
    {
        define("STRIPE_SECRET_KEY", $sk_test);
        define("STRIPE_PUBLISHABLE_KEY", $pk_test);
    }
    elseif ($is_stripe_test == 0)
    {
        define("STRIPE_SECRET_KEY", $sk_live);
        define("STRIPE_PUBLISHABLE_KEY", $pk_live);
    }
?>