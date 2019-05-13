{block name="loewenstarktracking_checkout_finish_google_adwords"}
    {literal}
        <script>
            gtag('event', 'conversion', {
                'send_to': '{/literal}{$loewenstarkTracking.AwTrackingId}/{$loewenstarkTracking.AwTrackingOrderHash}{literal}',
                'value': {/literal}{$sBasket.AmountNumeric}{literal},
                'currency': '{/literal}{$sBasket.sCurrencyName}{literal}',
                'transaction_id': '{/literal}{$sOrderNumber.value}{literal}'
            });
        </script>
    {/literal}
{/block}
