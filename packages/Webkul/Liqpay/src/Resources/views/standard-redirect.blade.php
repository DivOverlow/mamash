<?php
    $current_form = isset( $html_form ) ? $html_form : '';
?>

<body data-gr-c-s-loaded="true" cz-shortcut-listen="true">

    @if ( !empty($current_form) )
        You will be redirected to the LiqPay website in a few seconds.
        {!! $current_form !!}

        <script type="text/javascript">
            document.forms[0].submit();
        </script>

    @endif
</body>