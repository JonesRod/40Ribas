<?php

$d1 = new DateTime('now');
$d2 = new DateTime('1991-02-05');

$intervalo = $d1->diff( $d2 );

echo "Diferença de " . $intervalo->d . " dias";
echo " e " . $intervalo->m . " mese s";
echo " e " . $intervalo->y . " anos.";

/*<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>*/