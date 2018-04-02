<?php $this->layout('Layout', ['controller'=>'Articulos']) ?>
<?php $this->start('css') ?>
<?php $this->stop() ?>
<?php $this->start('incontainer') ?>
<div class="row">
	<div class="col-xs-12">
		<div class="card">
				<div class="card-header" data-background-color="purple">
					<h4 class="title">Articulos</h4>
					<p class="category">Catálogo de artículos, altas y modificaciones</p>
				</div>
				<div class="card-content">
					<table id="tArticulos"></table>
				</div>
		</div>

	</div>
</div>
<?php $this->stop() ?>
<?php $this->start('outcontainer') ?>
<!-- Toolbar para la tabla de rutas -->
<div id="toolbar">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mArticulos"><i class="fa fa-plus"></i> Alta</button>
</div>
<!-- Modal para editar y dar de alta rutas -->
<div class="modal fade" tabindex="-1" role="dialog" id="mArticulos">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Articulos</h4>
			</div>
			<form action="#" id="fArticulos">
				<input type="hidden" name="cve_articulo" id="cve_articulo">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group label-floating">
								<label class="control-label">Artículo</label>
								<input type="text" class="form-control" name="articulo" id="articulo" required>
							</div>
							<div class="form-group">
								<label>Reseña</label>
								<div class="form-group label-floating">
									<label class="control-label"> Escribe una breve descripción de la ruta</label>
									<textarea class="form-control" rows="3" name="resenia" id="resenia"></textarea>
								</div>
							</div>
							<select class="selectpicker" data-style="btn select-with-transition" title="Estatus" name="estatus" id="estatus" required>
								<option value="A">Activa</option>
								<option value="B">Suspendida</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->stop() ?>
<?php $this->start('js') ?>
	<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
	<script src="<?php echo base_url('public/js/master.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Articulos/inicio.js') ?>"></script>
<?php $this->stop() ?>