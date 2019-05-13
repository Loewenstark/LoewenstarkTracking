{block name="loewenstarktracking_global_google_phone"}
    {literal}
        gtag('config', '{/literal}{$loewenstarkTracking.AwTrackingId}/{$loewenstarkTracking.AwTrackingPhoneHash}{literal}', {
            'phone_conversion_number': '{/literal}{$loewenstarkTracking.AwTrackingNumber}{literal}',
            'anonymize_ip': true
        });
    {/literal}
{/block}
