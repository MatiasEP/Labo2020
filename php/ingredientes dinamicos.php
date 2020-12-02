<label for="ingrediente"><h3>Ingrediente:</h3> </label><br>
<input id="ingrediente" class="form-control" autocomplete="off" autofocus value="" type="text" name="ingrediente[]" placeholder="Ingrese un ingrediente..." minlength="3" maxlength="50" pattern="([A-Za-z ñ]{1,}[\s]{0,1}){1,}" required><br>

<label for="cantidad"><h3>Cantidad</h3></label><br>
<input id="cantidad" class="form-control" autocomplete="off" autofocus value="" type="text" name="cantidad[]" minlength="4" maxlength="20" placeholder="Ingrese una cantidad (ej.: 200 mm. | grs. | lts. | unidades)" pattern="([0-9]{0,4}[\s][a-zA-Z.]{1,})" required><br><br>