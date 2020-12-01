        <label for="paso">Paso: </label><br>
        <input id="paso" class="form-control"autocomplete="off" autofocus value="" type="text" name="paso[]" placeholder="Ingrese el paso (ej: 1# paso:...)" autofocus minlength="10" maxlength="150" pattern="([1-9]{0,1}[\\0-9][\#][\s][\\p][\\a][\\s][\\o][\\:][\s]([a-zA-Z,. ]{1,}[\s])){1,}" required><br>

        <label >Imagen: </label><br>
        <img id="imgPasoPreview"src="" class="oculto img-rounded"><br>
        <label for="imagen" class="btn btn-warning">Cambiar imagen</label><br>
        <input class="invisible" id="imagen"autocomplete="off" autofocus value="" type="file" name="imagen[]" ><br><br>