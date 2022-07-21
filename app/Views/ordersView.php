<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
<div id="layoutSidenav_content" style="height: 100%">


<div class="card mb-4" style="padding: 10px">
                            <div class="card-header text-right" >
                            				
                            <div id="activity_error"></div>
                                <h6 id="id_proyecto" data-id_proyecto='<?= 'a' ?>' data-nombre_proyecto='<?= 'a' ?>' class="proyecto">    
                                <strong>Orders</strong>  
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive dark">
                                <?= \Config\Services::session()->getFlashdata('msg'); //para mostrar confirmacion?>
                               
                                <form name="ordersForm" action="<?php echo base_url('Proyectos/insertar_descarga')?>" id="ordersForm" method="post" class="ordersForm">
                                <fieldset>
                                  <legend>Select an account</legend>
           
                                    <select name="account" id="account" class="form-control account"><option value="0">Select account</option>
                                    <?php  if(isset($accounts) && $accounts!=0){ ?>
                                          <?php foreach($accounts as $account):  ?>
                                          <option value="<?= $account->accountId ?>" <?php if(isset($_GET['data'] ) && $_GET['data'] == $account->accountId) {echo 'selected';} ?>><?= $account->name ?></option>
                                          <?php endforeach ?>
                                          <?php } ?>
                                    </select>

                                  </fieldset>
                                  <hr>

                                  <span>Select Products</span>
                              
                                  <table id="addOrderForm" class="table table-striped table-hover table-sm" width="100%" cellspacing="0">

                                  </table>
                                  
                                    <table class="table table-striped table-condensed table-hover table-sm small" id="orders" name="orders" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Account</th>
                                                <th>Order#</th>
                                                <th>Subtotal</th>
                                                <th>Tax</th>
                                                <th>Total</th>
                                                <th>Details</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $totalSubtotals=0;$totalTotals=0;
                                        if(isset($orders) && !empty($orders)){ ?>
                                        <?php foreach($orders as $order): ?>
                                        <tr>
                                        
                                        <td><?= $order->name ?></td>
                                        <td><?= $order->orderId ?></td>
                                        <td class="valor"><?= '$ '.$order->subtotal;$totalSubtotals+=$order->subtotal ?></td>
                                        <td class="valor"><?= '$ '.$order->tax ?></td>
                                        <td class="valor"><?= '$ '.$order->total;$totalTotals+=$order->total ?></td>
                                        <td>
                                         <button type="button" name="descarga_inicial" class="btn btn-info btn-sm descarga_inicial" value="<?= $order->orderId ?>" id="<?= $order->orderId ?>" data-toggle="modal" data-target="#orderDetailsModal" onclick="orderDetails(<?= $order->orderId ?>)" > <i class="fa fa-search fa"></i></button>
                                        </td>
                                        
                                       
                                          
									    </tr>
                                        <?php endforeach ?>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th><strong id="subtotal"><?= $totalSubtotals?></strong></th>
                                                <th> <strong id="monto">7.00 %</strong></th>
                                                <th><strong id="total"><?= $totalTotals?></strong></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                                                        
                                        </tbody>
                                       
                                    </table>
                                   
                                </div>
                            </div>
							<div class="card-footer" >
                           
              
						
  </form> 
					        </div>
                        </div>
	</div>	

<!-- Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header btn-info">
        <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <!-- Modal Body -->
       <div class="modal-body"></div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
             
            </div>

    </div>
  </div>
</div>			
    


<link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/')?>/css/bootstrap.css " type="text/css">
<link rel="stylesheet" href="<?php echo base_url('/assets/select2/');?>/css/select2.min.css">
<script src="<?php echo base_url('/assets/admin_template/')?>/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bootstrap/')?>/js/bootstrap.js"></script>
<script src="<?php echo base_url('/assets/sweetalert/');?>/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url('/assets/sweetalert/');?>/css/sweetalert.css" />
<script type="text/javascript" src="<?php echo base_url('/assets/')?>/jquery3.5.1.js"></script>
<script defer src="<?php echo base_url('/assets/fontawesome/');?>/all.js"></script>
 <script src="<?php echo base_url('/assets/select2/');?>/js/select2.min.js"></script><!--EL PLUGIN SELECT2 DEBE SER CARGADO DESPUES DE CARGAR JQUERY-->
<!-- datatables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/datatables/');?>/DataTables-1.10.25/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo base_url('/assets/datatables/');?>/DataTables-1.10.25/css/buttons.dataTables.min.css"/>
<script src="<?php echo base_url('/assets/datatables/');?>/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/DataTables-1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/Buttons-1.7.1/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/Buttons-1.7.1/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/Buttons-1.7.1/js/buttons.print.min.js"></script>
<!-- //end datatables -->
<script language="javascript" >

$(document).ready(function()
{
    crear_datatable();
    crear_select2();
    productCost();
    saveOrder();
    //descarga_real();
   function crear_select2()
     {
      $('#account').select2();
      $('#products').select2();
      $('#especialistas').select2();
      }
   function crear_datatable()
   {
  
    jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
      if ( typeof a === 'string' ) {
        a = a.replace(/[^\d.-]/g, '') * 1;
      }
      if ( typeof b === 'string' ) {
        b = b.replace(/[^\d.-]/g, '') * 1;
      }
      var a = parseFloat(a) || 0;
      var b = parseFloat(b) || 0;
      return a + b;
    }, 0);
  });
  var table = $('#orders').DataTable(
    {
      
      drawCallback: function () {
        var api = this.api();
        var subtotal = api.column( 2, {"filter":"applied"}).data().sum();
        var total = api.column( 4, {"filter":"applied"}).data().sum();
        $('#subtotal').html('$ '+subtotal);
        $('#total').html('$ '+total);
        },
        language: {
             search:         "Search:",
            lengthMenu: "Showing _MENU_entries",
            zeroRecords: "No records available",
            info: "Mostrando página _PAGE_ de _PAGES_",
            //infoEmpty: "No records available",
            infoFiltered: "(filtrado de _MAX_ total de registros)"
                   },

        dom:"Bfrtilp",       
        // buttons: ['copy', 'excel', 'pdf']    
        buttons: [
          {
            text: '<i class="fas fa-arrow-left"></i>',
            titleAttr:'Atras',
             action: function ( e, dt, node, config )
            {
              history.go(-1);
            }
          },
          {
            text: '<i class="fas fa-plus"></i>',
					  titleAttr:'Add product',
                    action: function ( e, dt, node, config )
                  {
                   
        var html = '';
        html += '<tr class="table-info">';
        html += '<td><select name="products[]" id="products" class="form-control products"><option value="0">Select product</option>';
        
        <?php
        if(isset($products) && $products != 0)
        {
        foreach ($products as $product)
        {?>
            html += '<option value="<?= $product->productId ?>"><?= $product->name.' - $'.$product->price ?></option>'
        <?php }}   ?>
        html += '</select></td>';
        html += '<td><input type="text" name="price[]" id="price" readonly=""  size="5" class="form-control price" placeholder="Price" ></td>';
        html += '<td><input type="text" name="amount[]" id="amount" size="4" class="form-control amount" required placeholder="amount" ></td>';
     
        html += '<td><button type="button" name="remove_descarga" id="-1" onclick="deleteProduct(-1)" class="btn btn-danger btn-sm remove_descarga eliminar "><i class="fa fa-minus-circle"></i>';
        html += '</tr>';

        // $('#descargas').prepend(html);
        $('#addOrderForm').prepend(html);
        crear_select2();
        productCost();
        

           
        } 
          }
          ,
          {
					extend:'excelHtml5',
					footer:true,//para que imprima el foot
					text:'<i class="fas fa-file-excel"></i>',
					titleAttr:'Export to Excel',
					className:'btn btn-success',
					exportOptions: {
						columns: [ 1, 2, 3, 4 ]
									},
					excelStyles:{
						template:'header_blue' 
									},
					title:'Orders' ,
					filename:'Orders',
				 
				 } ,
				 
                 {
						extend:'print',
						footer:true,
						text:'<i class="fas fa-print"></i>',
						titleAttr:'Imprimir',
						className:'btn btn-warning',
						exportOptions: {
							columns: [ 1, 2, 3, 4 ]
						},
						title:'Orders' ,
						
						
						customize: function ( win ) {
							$(win.document.body)
								.css( 'font-size', '10pt' );
							
		
							$(win.document.body).find( 'table' )
								.addClass( 'compact' ).css( 'font-size', 'inherit' );

							$(win.document.body).find( 'h1' ) .css( 'font-size', '10pt' ).css('text-align','center');
							
						}	


         },
         {
						extend: 'pdfHtml5',
            title:'Orders' ,
            filename:'Orders',
						customize: function(doc) {
											doc.defaultStyle.fontSize = 8; 
											doc.defaultStyle.alignment= 'center';
											doc.styles.tableHeader.fontSize = 8; 
											doc.styles.tableFooter.fontSize = 8; 
											doc.styles.title.fontSize = 10; 
											doc.styles.title.alignment = 'center'; 
											doc.content[1].margin = [ 40, 20, 10, 0 ] //left, top, right, bottom
										console.log( doc);
												} ,
						footer:true,
						text: '<i class="fas fa-file-pdf"></i>',
						className:'btn btn-primary',
						exportOptions: {
						modifier: {
							page: 'current'
									},
									
						columns: [ 1, 2, 3, 4 ],
                           }		   
                },
                {
            text: '<i class="fas fa-save"></i> Save order',
            attr:  {
                name: 'saveOrder',
                id: 'saveOrder',
                type:'submit',
                
                
            },
					  titleAttr:'Save Order',
                    action: function ( e, dt, node, config )
                  {
                  $('#ordersForm').submit(); 
                 
        } 
          }
              
        ]    
        
    });

   }
 
   

});


//validating data entry - saving orders
function saveOrder() {
  $('#ordersForm').on('submit', function (event) {
    event.preventDefault();
    var error = '';

   
    $('.account').each(function () {
      var count = 1;
      if ($(this).val() == '') {
        error += "<p>You must specify the account" + count + "</p>";
        return false;
      }
      count = count + 1;
    });


    $('.products').each(function () {
      var count = 1;
      if ($(this).val() == '') {
        error += "<p>You most select product on row " + count + "</p>";
        return false;
      }
      count = count + 1;
    });

    $('.amount').each(function () {
      var count = 1;
      if ($(this).val() == '') {
        error += "<p>You must specify amount on row " + count + "</p>";
        return false;
      }
      count = count + 1;
    });
  

    var form_data = $(this).serialize();
    var base_url = '<?php echo base_url() ?>';

    if (error == '') {
       var accountId = $('#account').val();
           
      $.ajax({
        url: base_url + '/Orders/saveOrder',
        method: "POST",
        data: form_data,
        //dataType : 'json',
        success: function (response) {
          $('#orders').append(response);
          //ask For confirmation
          swal({
              
                  title: "Order submitted successfully",
                  text: "Order submitted successfully",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Create another order",
                  cancelButtonClass: "btn-info",
                  cancelButtonText: "change account",
                  closeOnConfirm: true,
                  closeOnCancel: true
                },
                      function(isConfirm) {//create another order so keep user
                      if (isConfirm) {
                          window.location.assign("<?php echo base_url()?>/orders?data="+accountId+"" );
                        }
                      else {//change account
                        window.location.assign("<?php echo base_url()?>/orders" );
                        }

                      });
                   limpiarformulario("#ordersForm");
        },
        error: function (response) {
           swal("Error!", "An error has occurred while inserting the order :)", "error");
          
        }
      });
    }
    else {
      $('#activity_error').html('<div class="alert alert-danger">' + error + '</div>');
    }


  });
}

function limpiarformulario(formulario) {
  /* Se encarga de leer todas las etiquetas input del formulario*/
  $(formulario).find('input').each(function () {
    switch (this.type) {
      case 'password':
      case 'text':
      case 'hidden':
        $(this).val('');
        break;
      case 'checkbox':
      case 'radio':
        this.checked = false;
    }
  });

   $(formulario).find('select').each(function () {
    $("#" + this.id + " option[value=0]").attr("selected", true);
  });

  $(formulario).find('textarea').each(function () {
    $(this).val('');
  });

  $(formulario).find('.eliminar').each(function () {
    var fila = (this).closest('tr');
    fila.remove();
  })


}
</script>



<script language="javascript">
function productCost() {//search with ajax the price for the selected product and put it on price input
  $('.products').on('change', function () {
    var current_product = $(this);
    var base_url = '<?php echo base_url();?>';
    var productId = $(this).val();
    $.ajax({
      url: base_url + '/Products/getProducts/' + productId,
      method: "POST",
      dataType: "json",
      data: {'productId': productId },
      success: function (data) {

        if (data.status == 'ok') {
          current_product.closest("td").next().find('.price').val(data.price);
        }
        else {
          alert(' Error while searching the price for the selected product.');
        }
      }
    });

  });
	}
 function orderDetails(orderId)
 {
  var base_url = '<?php echo base_url();?>';
  
   
   $.ajax({
      url: base_url + '/Orders/getOrderDetails/' + orderId,
      method: "POST",
      dataType: "json",
      data: {'orderId': orderId },
      success: function (data) {
        $('.modal-body').html(data);
        
      }
    });
 }

 function deleteProduct(id) 
  {
      var id_proyecto = $('#id_proyecto').attr('data-id_proyecto');
      var boton_eliminar = $('#' + id);
      var base_url = '<?php echo base_url()?>';
      var base_url = base_url + '/Products/deleteProduct/'+id;
      var fila = boton_eliminar.closest('tr');
      //console.log(base_url);
       if (id == -1)
       {     boton_eliminar.closest('tr').remove();}
       else   
       {
         //deltele product order on db ,future version
        //
          

       }
    }

</script>

<?= $this->endSection() ?>