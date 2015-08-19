<?php
session_start();
include("../js/conec.php"); 
$q=$_POST['q'];
$conn=conectarse(); 
if($q!='')
{
$res=mysql_query("select * from evento where id=$q",$conn);
?>
<?php
while($fila=mysql_fetch_array($res))
{
$id=$fila['id'];
$nombre=$fila['nombre'];
$invitados=	$fila['invitados'];
}
?>
<div class="form-group">
    <form id="formevento"  class="form-horizontal">
    <input type="hidden" id="valor" name="valor" value="<?php echo $id ?>" />
        <div id="n" class="form-group">
            <label class="control-label col-md-3" for="firstName">Nombre del evento:</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" id="nombre" placeholder="Nombre del evento">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Cambiar fecha:</label>
            <div class="col-md-2">
                <label class="radio-inline">
                    <input checked="checked"  type="radio" name="calenRadios" value="si" onclick="calendario(this)"> Si
                </label>
                <label class="radio-inline">
                    <input checked="checked"  type="radio" name="calenRadios" value="no" onclick="calendario(this)"> No
                </label>
            </div>
        </div>
        <div id="calen"  class="form-group">
        <label class="control-label col-md-3" for="firstName">Fecha:</label>
        <div class="col-md-9">
            <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha">
        </div>
   		</div>
        <div class="form-group">
            <label class="control-label col-md-3">Permite invitados:</label>
            <div class="col-md-2">
                <label class="radio-inline">
                <?php if($invitados>'0'){ ?>
                    <input checked="checked"  type="radio" name="genderRadios" value="si" onclick="cantidad(this)"> Si
                <?php } else {?>
                	<input  type="radio" name="genderRadios" value="si" onclick="cantidad(this)"> Si
                <?php } ?>
                </label>
                <label class="radio-inline">
                 <?php if($invitados == '0'){ ?>
                    <input checked="checked" type="radio" name="genderRadios" value="no" onclick="cantidad(this)"> No
                 <?php } else {?>
                 	<input type="radio" name="genderRadios" value="no" onclick="cantidad(this)"> No
                 <?php } ?>
                </label>
            </div>
        </div>
        <div id="cantidad" <?php if($invitados!= '0') { ?>style="display: block;"<?php } ?> class="form-group">
            <label class="control-label col-md-3">Cantidad:</label>
            <div class="col-md-3">
                <select id="cant" class="form-control">
                	<?php if($invitados=='1'){ ?>
                    <option selected="selected" value="1">1</option>
                    <?php } else {?>
                    <option value="1">1</option>
                    <?php } ?>
                    <?php if($invitados=='2'){ ?>
                    <option selected="selected" value="2">2</option>
                    <?php } else {?>
                    <option value="2">2</option>
                    <?php } ?>
                    <?php if($invitados=='3'){ ?>
                    <option selected="selected" value="3">3</option>
                    <?php } else {?>
                    <option value="3">3</option>
                    <?php } ?>
                    <?php if($invitados=='4'){ ?>
                    <option selected="selected" value="4">4</option>
                    <?php } else {?>
                    <option value="4">4</option>
                    <?php } ?>
                    <?php if($invitados=='5'){ ?>
                    <option selected="selected" value="5">5</option>
                    <?php } else {?>
                    <option value="5">5</option>
                    <?php } ?>
                    <?php if($invitados=='6'){ ?>
                    <option selected="selected" value="6">6</option>
                    <?php } else {?>
                    <option value="6">6</option>
                    <?php } ?>
                    <?php if($invitados=='7'){ ?>
                    <option selected="selected" value="7">7</option>
                    <?php } else {?>
                    <option value="7">7</option>
                    <?php } ?>
                    <?php if($invitados=='8'){ ?>
                    <option selected="selected" value="8">8</option>
                    <?php } else {?>
                    <option value="8">8</option>
                    <?php } ?>
                    <?php if($invitados=='9'){ ?>
                    <option selected="selected" value="9">9</option>
                    <?php } else {?>
                    <option value="9">9</option>
                    <?php } ?>
                    <?php if($invitados=='10'){ ?>
                    <option selected="selected" value="10">10</option>
                    <?php } else {?>
                    <option value="10">10</option>
                    <?php } ?>

                </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-md-offset-1 col-md-9">
                <button class="btn btn-success" onclick="edita($('#valor').val(),$('#nombre').val(),$('#fecha').val(),$('input:radio[name=genderRadios]:checked').val(),$('#cant').val(),$('input:radio[name=calenRadios]:checked').val());" type="button" >Editar</button>
                <input id="rst" type="reset" class="btn btn-danger" value="Restablecer" >
            </div>
        </div>
    </form>
</div>
 <?php } ?>