<?php $this->layout('Layout', ['controller'=>'Agenda']) ?>
<?php $this->start('css') ?>
<?php $this->stop() ?>
<?php $this->start('incontainer') ?>
<div class="row">
	<div class="col-xs-12">
		<div class="card">
				<div class="card-content">
					<button type="button" class="btn btn-default pull-right" id="actualizar"><i class="fa fa-refresh"></i> Actualizar</button>
					<div id="fullCalendar"></div>
				</div>
		</div>
	</div>
</div>
<?php $this->stop() ?>
<?php $this->start('outcontainer') ?>

<?php $this->stop() ?>
<?php $this->start('js') ?>
	<script src="<?php echo base_url('public/js/master.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Agenda/inicio.js') ?>"></script>
<?php $this->stop() ?>