
<div class="row">
	<div class="col-xs-12 text-center">
		<b>Compra</b><br>
	</div>
</div> <br>
<div class="row">
	<div class="col-xs-6">	
		<b>Compra de Producto</b><br>
		<b>ID compra:</b> <?php echo $entrada->id_entrada;?> <br>
		<b>Fecha:</b> <?php echo $entrada->fecha;?> <br>
		<b>Encargado:</b> <?php echo $entrada->usuario;?> <br>
		<b>Proveedor:</b> <?php echo $entrada->empresa;?> <br>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Precio Entrada</th>
					<th>Cantidad</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach($detalle_entrada as $detalle){?>
					<td><?php echo $detalle->codigo;?></td>
					<td><?php echo $detalle->nombre;?></td>
					<td><?php echo $detalle->precio_compra;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo "$ ".$detalle->subtotal;?></td>
				</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><?php echo "$ ".$entrada->total;?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>