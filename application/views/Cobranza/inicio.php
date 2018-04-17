<?php $this->layout('Layout', ['controller'=>'Cobranza']) ?>
<?php $this->start('css') ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/morris.css') ?>">
<style>
	.btn-group, .btn-group-vertical {
		margin: 3px 1px;
	}
</style>
<?php $this->stop() ?>
<?php $this->start('incontainer') ?>
<div class="card">
	<div class="card-header">
		<h4 class="card-title" id="title">Estado de Cuenta</h4>
		<p class="category">Utiliza los filtros para personalizar el resultado</p>
	</div>
	<div class="card-content">
		<div class="row">
			<div class="col-xs-12">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mFiltros"><i class="fa fa-filter"></i> Filtros</button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mVentas"><i class="fa fa-plus"></i> Venta</button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mPagos"><i class="fa fa-plus"></i> Pago</button>
			</div>
		</div>
		<div class="nav-tabs-navigation">
			<div class="nav-tabs-wrapper">
				<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
					<li class="active"><a href="#tabventas" data-toggle="tab">Ventas</a></li>
					<li><a href="#tabpagos" data-toggle="tab">Pagos</a></li>
				</ul>
			</div>
		</div>
		<div id="my-tab-content" class="tab-content text-center">
			<div class="tab-pane active" id="tabventas">
				<table id="tVentas"></table>
			</div>
			<div class="tab-pane" id="tabpagos">
				<table id="tPagos"></table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<table class="table">
					<tbody>
						<tr>
							<td><strong>Total de Ventas</strong></td>
							<td class="text-right" style="width: 200px"><strong id="tv">$ 0.00</strong></td>
						</tr>
						<tr>
							<td><strong>Total de Pagos</strong></td>
							<td class="text-right" style="width: 200px"><strong id="tp">$ 0.00</strong></td>
						</tr>
						<tr>
							<td><strong>Total de Notas de Cargo</strong></td>
							<td class="text-right" style="width: 200px"><strong id="tnc">$ 0.00</strong></td>
						</tr>
						<tr>
							<td><strong>Total de Notas de Crédito</strong></td>
							<td class="text-right" style="width: 200px"><strong id="tncr">$ 0.00</strong></td>
						</tr>
						<tr>
							<td><strong>Saldo del (los) cliente(s)</strong></td>
							<td class="text-right" style="width: 200px"><strong id="r">$ 0.00</strong></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div id="semanas"></div>
			</div>
		</div>
	</div>
</div>
<?php $this->stop() ?>
<?php $this->start('outcontainer') ?>
<!-- Modal para registrar ventas -->
<div class="modal fade" tabindex="-1" role="dialog" id="mVentas">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form action="#" id="fVentas">
				<input type="hidden" name="cve_venta" id="cve_venta">
				<input type="hidden" name="cve_cliente" id="cve_cliente">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label">Cliente</label>
								<input type="text" class="form-control" name="cliente" id="cliente">
							</div>
							<div class="form-group">
								<select class="selectpicker" data-style="btn btn-danger btn-block" title="Artículo" name="cve_articulo" id="cve_articulo" required></select>
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
				<input type="hidden" name="cve_pago" id="cve_pago">
				<input type="hidden" name="_cve_cliente" id="_cve_cliente">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label">Cliente</label>
								<input type="text" class="form-control" name="_cliente" id="_cliente">
							</div>
							<div class="form-group">
								<label class="control-label">Importe</label>
								<input type="number" class="form-control" name="importe" id="importe" in="0" step="0.01" required>
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
<!-- Modal para filtrar ventas y pagos -->
<div class="modal fade" tabindex="-1" role="dialog" id="mFiltros">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form action="#" id="fFiltros">
				<input type="hidden" name="__cve_cliente" id="__cve_cliente">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label">Cliente</label>
								<input type="text" class="form-control" name="__cliente" id="__cliente">
							</div>
							<div class="form-group">
								<label for="cve_ruta">Ruta</label>
								<select class="selectpicker" data-style="btn btn-danger btn-block" title="Ruta" name="cve_ruta" id="cve_ruta" data-style="width: 100%"></select>
							</div>
							<div class="form-group">
								<label class="control-label">Fecha inicial</label>
								<input type="text" class="form-control datepicker" name="fi" id="fi" required>
							</div>
							<div class="form-group">
								<label class="control-label">Fecha final</label>
								<input type="text" class="form-control datepicker" name="ff" id="ff" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> Generar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->stop() ?>
<?php $this->start('js') ?>
	<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/morris.min.js') ?>"></script>
	<script src="<?php echo base_url('public/js/master.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Cobranza/inicio.js') ?>"></script>
<?php $this->stop() ?>