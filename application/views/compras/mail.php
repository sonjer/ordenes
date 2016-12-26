<?php

$destino = 'jmorgado@iicom.mx';
$asunto ="comentario";


$comentario = "NOMBRE DE CONTACTO:$_POST[nombre]
EMAIL:$_POST[email]
TELEFONO:$_POST[telefono]
COMENTARIOS:$_POST[com]";

$headers = 'From: '.$_POST['email']."\r\n".
'Reply-To:'.$_POST['email']."\r\n".
'X-Mailer: PHP/'.phpversion();
mail($destino,$asunto,$comentario,$headers);

header('Location: http://localhost/intranet/ordenescompra/compras');

?>
