{block name="loewenstarktracking_global"}
    {*Google*}
    {if $loewenstarkTracking.GaTrackingId != false} {include file='frontend/loewenstarktracking/global/google.tpl'} {/if}

    {*Facebook*}
    {if $loewenstarkTracking.FbTrackingId != false} {include file='frontend/loewenstarktracking/global/facebook.tpl'} {/if}

    {*Additional Tracking*}
    {if $loewenstarkTracking.AdditionalTracking != false} {$loewenstarkTracking.AdditionalTracking} {/if}
{/block}