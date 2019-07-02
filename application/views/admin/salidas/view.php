
<div class="row">
	<div class="col-xs-12 text-center">
		<b>Venta</b><br>
	</div>
</div> <br>
<div class="row">
	<div class="col-xs-6">	
		<b>Venta de productos</b><br>
		<b>ID Salida:</b> <?php echo $salida->id_salida;?> <br>
		<b>Fecha:</b> <?php echo $salida->fecha;?> <br>
		<b>Encargado:</b> <?php echo $salida->usuario;?> <br>
		<b>Cliente:</b> <?php echo $salida->nombre." ".$salida->apellido?> <br>
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
					<th>Precio Venta</th>
					<th>Cantidad</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach($detalle_salida as $detalle){?>
					<td><?php echo $detalle->codigo;?></td>
					<td><?php echo $detalle->nombre;?></td>
					<td><?php echo $detalle->precio_venta;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->subtotal;?></td>
				</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><?php echo $salida->total;?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>