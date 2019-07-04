
                            <?php $cont = 0;?>
                                <?php if(!empty($proveedores)):?>
                                    <?php foreach($proveedores as $pro):?>
                                    <?php $cont++;?>
                                        <tr>
                                            <td><?php echo $pro->id_proveedor;?></td>
                                            <td><?php echo $pro->nombre;?></td>
                                            <td><?php echo $pro->empresa;?></td>
                                            <td><?php echo $pro->telefono;?></td>
                                            <?php if($pro->estado == 1){?>
                                                <td>
                                                <span class="badge badge-success">Activo</span>
                                                </td>
                                            <?php }else{?>
                                                <td>
                                                <span class="badge badge-danger">Inactivo</span>
                                                </td>
                                            <?php }?>
                                            <td>
                                                <div class="btn-group">
                                                <?php $data = $pro->id_proveedor."*".$pro->nombre."*".$pro->empresa.
                                                    "*".$pro->telefono."*".$pro->estado; ?>
                                                <button id="view<?php echo $cont;?>" type="button" onclick="viewProveedor(<?php echo $cont;?>)" class="btn btn-info" data-toggle="modal" data-target="#modalView" value="<?php echo $data;?>">
                                                    <span class="fa fa-search" style="color: #fff"></span>
                                                </button>
                                                <button id="edit<?php echo $cont;?>" type="button" onclick="editProveedor(<?php echo $cont;?>)"  class="btn btn-warning" data-toggle="modal" data-target="#modalEditar" value="<?php echo $data;?>">
                                                    <span span class="fa fa-pencil" style="color: #fff"></span>
                                                </button>
                                                <?php if($pro->estado == 1){?>
                                                    <button id="delete<?php echo $cont; ?>" onclick="deleteProveedor(<?php echo $cont; ?>)"  type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" value="<?php echo $data;?>" >
                                                        <span class="fa fa-times" style="color: #fff"></span>
                                                    </button>
                                                <?php }?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            


                            <script src="<?php echo base_url();?>assets/js/adminJS/proveedores.js"></script>