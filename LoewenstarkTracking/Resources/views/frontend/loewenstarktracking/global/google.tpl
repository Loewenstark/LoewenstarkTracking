{block name="loewenstarktracking_global_google"}
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id={$loewenstarkTracking.GaTrackingId}"></script>

  <script>
    {literal}
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    {/literal}

    {*Analytics*}
    gtag('config', '{$loewenstarkTracking.GaTrackingId}', {literal}{ 'anonymize_ip': true }{/literal});

    {*Adwords*}
    {if $loewenstarkTracking.AwTrackingId != false} {include file='frontend/loewenstarktracking/global/google/adwords.tpl'} {/if}

    {*Phone Tracking*}
    {if $loewenstarkTracking.AwTrackingPhoneHash != false} {include file='frontend/loewenstarktracking/global/google/phone.tpl'} {/if}
  </script>
{/block}
