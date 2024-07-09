<div class="modal fade" id="ModalEdit{{$cat->id_categoriaplanta}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Creación de Categoría -->
                <form action="{{ route('admin.Categorias.categoryEdit', $cat->id_categoriaplanta) }}" method="PUT">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Tipo de planta</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$cat->nombre}}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>