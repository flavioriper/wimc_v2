			</div>
		</div>
		<!-- Logout Modal-->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">deseja realmente sair?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						Escolha a opção "Sair" para encerrar com segurança.
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<a class="btn btn-primary" href="/login/logout">Sair</a>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/sb-admin.min.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/mascaras.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/cep.js"></script>
		<script src="<?php echo base_url() ?>/assets/js/bootstrap-select.bundle.js"></script>
		<script type="text/javascript" src="<?php echo $this->config->base_url().'assets/vendor/DataTables/datatables.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo $this->config->base_url().'assets/vendor/DataTables/dataTables.bootstrap4.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo $this->config->base_url().'assets/vendor/DataTables/dataTables.responsive.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo $this->config->base_url().'assets/vendor/DataTables/responsive.bootstrap4.min.js'?>"></script>
		<?php $this->load->view($localPath.'script') ?>
	</body>
</html>