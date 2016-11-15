


	<div class="row panel panel-default" style="margin-top:20px">
		<div class="col-md-12">
			<div class="tabbable" id="tabs-160309">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-1" data-toggle="tab">Compras</a>
					</li>
					<li>
						<a href="#panel-2" data-toggle="tab">Vendas</a>
					</li>
					<li>
						<a href="#panel-3" data-toggle="tab">Serviços</a>
					</li>
					<li>
						<a href="#panel-4" data-toggle="tab">Caixa</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-1">
						<p>
							<?php include_once"compras.php"; ?>
						</p>
					</div>
					<div class="tab-pane" id="panel-2">
						<p>
							<?php include_once"vendas.php"; ?>
						</p>
					</div>
					<div class="tab-pane" id="panel-3">
						<p>
							<?php include_once"servicos.php"; ?>
						</p>
					</div>
					<div class="tab-pane" id="panel-4">
						<p>
							<?php include_once"caixa.php"; ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>