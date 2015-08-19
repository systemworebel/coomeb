<?php
//echo "Hola Sarita";
include("../js/conec.php");
$conn=conectarse();

// THE BELOW LINE STATES THAT IF THE SUBMIT BUTTON
// WAS PUSHED, EXECUTE THE PHP CODE BELOW TO SEND THE
// MAIL. IF THE BUTTON WAS NOT PRESSED, SKIP TO THE CODE
// BELOW THE "else" STATEMENT (WHICH SHOWS THE FORM INSTEAD).
if ( isset ( $_POST [ 'buttonPressed' ] )){

    // BUSCAMOS LA INFORMACION
    $codigo = $_POST[ "code" ];
    $sql = "select * from clientes where codigo = $codigo";
    $res = mysql_query($sql,$conn);
    while ($fila = mysql_fetch_array($res)) {
        $to = $fila['correo'] ;
        $pass = $fila['clave1'] ;
    }
    // REPLACE THE LINE BELOW WITH YOUR E-MAIL ADDRESS.
    $from = 'coomeb@upb.edu.co';
    $subject = 'COOMEB LTDA :: Recordatorio clave de acceso' ;
    
    // NOT SUGGESTED TO CHANGE THESE VALUES
    $message = "Su contraseña de acceso al sitio web de COOMEB LTDA es: $pass . Si ha recibido este mensaje sin previa solicitud, favor reportarlo a coomeb@upb.edu.co." ;
    $headers = 'From: ' . $from . PHP_EOL ;
    if (strlen($to) > 0){
        mail ( $to, $subject, $message, $headers ) ;
        echo "Email enviado satisfactoriamente a $to" ;}
    else
        echo "El usuario con CODIGO $codigo no tiene asignado un email. Favor reportarlo.";
    // THE TEXT IN QUOTES BELOW IS WHAT WILL BE
    // DISPLAYED TO USERS AFTER SUBMITTING THE FORM.   
    }

    else{
        ?>
<form method= "post" action= "<?php echo $_SERVER [ 'PHP_SELF' ] ;?>" />
  <table>
    <tr>
      <td>Documento: </td>
      <td><input name= "code" type= "text"/></td>
    </tr>
    <tr>
      <td></td>
      <td><input name= "buttonPressed" type= "submit" value= "Send E-mail!" /></td>
    </tr>
 </table>
</form>
<?php } ?>