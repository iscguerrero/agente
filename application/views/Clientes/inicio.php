<?php $this->layout('Layout', ['controller'=>'Clientes']) ?>
<?php $this->start('css') ?>
	<style>
		.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
			width: 169px;
			margin-bottom: 2px;
		}
	</style>
<?php $this->stop() ?>
<?php $this->start('incontainer') ?>
<div class="row">
	<div class="col-xs-12">
		<div class="card">
				<div class="card-content table-responsive table-full-width">
					<table id="tClientes"></table>
				</div>
		</div>
	</div>
</div>
<?php $this->stop() ?>
<?php $this->start('outcontainer') ?>
<!-- Toolbar para la tabla de rutas -->
<div id="toolbar">
	<select class="selectpicker" data-style="btn btn-danger btn-block" title="Ruta" name="_cve_ruta" id="_cve_ruta" data-style="width: '150px'"></select>
	<button type="button" class="btn btn-primary" id="btnAlta" title="Registrar nuevo cliente"><i class="fa fa-plus"></i> Alta</button>
	<button type='button' class='btn btn-primary' id="btnVer" title="Ver/Editar información del cliente">Ver</button>
	<button type='button' class='btn btn-primary' id="btnEstado" title="Ver estado de cuenta">Estado</button>
	<button type='button' class='btn btn-primary' id="btnVenta" title="Registrar nueva venta"><i class="fa fa-plus"></i> Venta</button>
	<button type='button' class='btn btn-primary' id="btnPago" title="Registrar nuevo pago"><i class="fa fa-plus"></i> Pago</button>
</div>
<!-- Modal para editar y dar de alta clientes -->
<div class="modal fade" tabindex="-1" role="dialog" id="mClientes">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="#" id="fClientes">
				<input type="hidden" name="cve_cliente" id="cve_cliente">
				<input type="hidden" name="idsepomex" id="idsepomex">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Nombre</label>
								<input type="text" class="form-control" name="nombre" id="nombre" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Apellidos</label>
								<input type="text" class="form-control" name="apellidos" id="apellidos" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Teléfono</label>
								<input type="text" class="form-control" name="telefono" id="telefono" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3" style="height: 80px">
							<div class="form-group">
								<label for="cve_ruta">Ruta</label>
								<select class="selectpicker col-" data-width="100%" data-style="btn btn-danger btn-block" title="Ruta" name="cve_ruta" id="cve_ruta" required></select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3" style="height: 80px">
							<div class="form-group">
								<label for="idEstado">Estado</label>
								<select class="selectpicker col-" data-width="100%" data-style="btn btn-danger btn-block" title="Estado" name="idEstado" id="idEstado" required></select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3" style="height: 80px">
							<div class="form-group">
							<label for="idMunicipio">Municipio</label>
								<select class="selectpicker col-" data-width="100%" data-live-search="true" data-style="btn btn-danger btn-block" title="Municipio" name="idMunicipio" id="idMunicipio" required></select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label class="control-label">Asentamiento</label>
								<input type="text" class="form-control autocomplete" name="asentamiento" id="asentamiento" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2">
							<div class="form-group">
								<label class="control-label" for="tipo">Tipo</label>
								<input type="text" class="form-control autocomplete" name="tipo" id="tipo" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2">
							<div class="form-group">
								<label class="control-label">Zona</label>
								<input type="text" class="form-control autocomplete" name="zona" id="zona" readonly>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2">
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
						<div class="col-xs-12">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label"> Dirección</label>
										<textarea class="form-control" rows="2" name="direccion" id="direccion" required></textarea>
									</div>
									<div class="form-group">
										<label class="control-label">Anotaciones sobre el cliente</label>
										<textarea class="form-control" rows="2" name="anotaciones" id="anotaciones"></textarea>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="periodicidad">Periodo</label>
										<select class="selectpicker col-" data-width="100%" data-style="btn btn-danger btn-block" title="Periodo de cobro" name="periodicidad" id="periodicidad" required>
											<option value="A">Semanal</option>
											<option value="B">Quincenal</option>
											<option value="C">Mensual</option>
											<option value="D">Bimestral</option>
										</select>
									</div>
									<div class="form-group">
										<label for="estatus">Estatus</label>
										<select class="selectpicker col-" data-width="100%" data-style="btn btn-danger btn-block" title="Estatus" name="estatus" id="estatus" required>
											<option value="A">Activo</option>
											<option value="B">Suspendido</option>
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="_cve_articulo">Artículo</label>
										<select class="selectpicker col-" data-width="100%" data-style="btn btn-danger btn-block" title="Artículo" name="_cve_articulo" id="_cve_articulo"></select>
									</div>
									<div class="form-group">
										<label class="control-label">Precio de venta</label>
										<input type="number" class="form-control text-right" name="_precio_venta" id="_precio_venta" in="0" step="0.01">
									</div>
									<div class="form-group">
										<label class="control-label">Pagos de:</label>
										<input type="number" class="form-control text-right" name="_importe_abono" id="_importe_abono" in="0" step="0.01">
									</div>
								</div>
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
<!-- Modal para registrar ventas -->
<div class="modal fade" tabindex="-1" role="dialog" id="mVentas">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form action="#" id="fVentas">
				<input type="hidden" name="_cve_cliente" id="_cve_cliente">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<select class="selectpicker col-" data-width="100%" data-style="btn btn-danger btn-block" title="Artículo" name="cve_articulo" id="cve_articulo" required></select>
							</div>
							<div class="form-group">
								<label class="control-label">Precio de venta</label>
								<input type="number" class="form-control text-right" name="precio_venta" id="precio_venta" in="0" step="0.01" required>
							</div>
							<div class="form-group">
								<label class="control-label">Pagos de:</label>
								<input type="number" class="form-control text-right" name="importe_abono" id="importe_abono" in="0" step="0.01" required>
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
<!-- Modal para registrar pagos -->
<div class="modal fade" tabindex="-1" role="dialog" id="mPagos">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form action="#" id="fPagos">
				<input type="hidden" name="__cve_cliente" id="__cve_cliente">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label">Importe</label>
								<input type="number" class="form-control text-right" name="importe" id="importe" in="0" step="0.01" required>
							</div>
							<div class="form-group">
								<label class="control-label">Anotaciones sobre el pago</label>
								<textarea class="form-control" rows="2" name="anotaciones" id="anotaciones"></textarea>
							</div>
							<div class="checkbox">
								<input type="checkbox" id="es_nota_de_credito" name="es_nota_de_credito" value="X">
								<label for="es_nota_de_credito">
									Ingresar como nota de crédito
								</label>
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