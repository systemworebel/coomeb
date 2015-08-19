<form id="formevento"  class="form-horizontal">
	<fieldset>
    <legend>Nuevo Evento</legend>
    <div id="n" class="form-group">
        <label class="control-label col-md-3" for="firstName">Nombre del evento:</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del evento">
        </div>
    </div>
    <div  class="form-group">
        <label class="control-label col-md-3" for="firstName">Fecha:</label>
        <div class="col-md-9">
            <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Permite invitados:</label>
        <div class="col-md-2">
            <label class="radio-inline">
                <input  type="radio" name="genderRadios" value="si" onclick="cantidad(this)"> Si
            </label>
            <label class="radio-inline">
                <input type="radio" name="genderRadios" value="no" onclick="cantidad(this)"> No
            </label>
        </div>
    </div>
    <div id="cantidad" class="form-group">
        <label class="control-label col-md-3">Cantidad:</label>
        <div class="col-md-3">
            <select id="cant" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
               	<option value="6">6</option>
               	<option value="7">7</option>
               	<option value="8">8</option>
               	<option value="9">9</option>
               	<option value="10">10</option>
            </select>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-md-offset-1 col-md-9">
            <button class="btn btn-success" onclick="creaevento($('#nombre').val(),$('#fecha').val(),$('input:radio[name=genderRadios]:checked').val(),$('#cant').val());" type="button" >Crear</button>
            <input id="rst" type="reset" class="btn btn-danger" value="Restablecer" >
        </div>
    </div>
    </fieldset>
</form>
