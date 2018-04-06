<?php $this->layout('Layout', ['controller'=>'Clientes']) ?>
<?php $this->start('css') ?>
<?php $this->stop() ?>
<?php $this->start('incontainer') ?>
<div class="row">
	<div class="col-xs-12">
		<div class="card">
				<div class="card-header">
					<h4 class="title">Clientes</h4>
					<p class="category">Catálogo de clientes, altas y modificaciones</p>
				</div>
				<div class="card-content">
					<table id="tClientes"></table>
				</div>
		</div>
	</div>
</div>
<?php $this->stop() ?>
<?php $this->start('outcontainer') ?>
<!-- Toolbar para la tabla de rutas -->
<div id="toolbar">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mClientes"><i class="fa fa-plus"></i> Alta</button>
</div>
<!-- Modal para editar y dar de alta rutas -->
<div class="modal fade" tabindex="-1" role="dialog" id="mClientes">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="#" id="fClientes">
				<input type="hidden" name="cve_cliente" id="cve_cliente">
				<input type="hidden" name="idsepomex" id="idsepomex">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Nombre</label>
								<input type="text" class="form-control" name="nombre" id="nombre" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Apellidos</label>
								<input type="text" class="form-control" name="apellidos" id="apellidos" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Teléfono</label>
								<input type="text" class="form-control" name="telefono" id="telefono" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-style="btn btn-danger btn-block" title="Ruta" name="cve_ruta" id="cve_ruta" required></select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-style="btn btn-danger btn-block" title="Estado" name="idEstado" id="idEstado" required></select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-style="btn btn-danger btn-block" title="Municipio" name="idMunicipio" id="idMunicipio" required></select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-8">
							<div class="form-group">
								<label class="control-label">Asentamiento</label>
								<input type="text" class="form-control autocomplete" name="asentamiento" id="asentamiento" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label" for="tipo">Tipo</label>
								<input type="text" class="form-control autocomplete" name="tipo" id="tipo" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Zona</label>
								<input type="text" class="form-control autocomplete" name="zona" id="zona" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">C. P.</label>
								<input type="text" class="form-control autocomplete" name="cp" id="cp" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label class="control-label">Ciudad</label>
								<input type="text" class="form-control autocomplete" name="ciudad" id="ciudad" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label class="control-label"> Dirección</label>
								<textarea class="form-control" rows="2" name="direccion" id="direccion" required></textarea>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label class="control-label">Anotaciones sobre el cliente</label>
								<textarea class="form-control" rows="2" name="anotaciones" id="anotaciones"></textarea>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4">
							<div class="form-group">
								<select class="selectpicker pull-left" data-style="btn btn-danger btn-block" title="Periodo de cobro" name="periodicidad" id="periodicidad" required>
									<option value="A">Semanal</option>
									<option value="B">Quincenal</option>
									<option value="C">Mensual</option>
									<option value="D">Bimestral</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-style="btn btn-danger btn-block" title="Estatus" name="estatus" id="estatus" required>
									<option value="A">Activo</option>
									<option value="B">Suspendido</option>
								</select>
							</div>
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
	<script src="<?php echo base_url('public/js/master.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Clientes/inicio.js') ?>"></script>
<?php $this->stop() ?>