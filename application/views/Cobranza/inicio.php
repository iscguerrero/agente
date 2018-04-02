<?php $this->layout('Layout', ['controller'=>'Cobranza']) ?>
<?php $this->start('css') ?>
<?php $this->stop() ?>
<?php $this->start('incontainer') ?>
hola
<?php $this->stop() ?>
<?php $this->start('outcontainer') ?>

<?php $this->stop() ?>
<?php $this->start('js') ?>
	<script src="<?php echo base_url('public/js/master.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Cobranza/inicio.js') ?>"></script>
<?php $this->stop() ?>