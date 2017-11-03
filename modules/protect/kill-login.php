<?php

$help_url = 'https://jetpack.com/support/security-features/#unblock';

$die_string = sprintf( __( 'Your IP (%1$s) has been flagged for potential security violations.  <a href="%2$s">Find out more...</a>', 'jetpack' ), str_replace( 'http://', '', esc_url( 'http://' . $ip ) ), esc_url( $help_url ) );

?><html>
<head><?php echo __( 'Login Blocked by Jetpack', 'jetpack' ); ?></head>
<body>
<p><?php echo $die_string; ?></p>
</body>
</html>