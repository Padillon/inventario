var options = {

    url: function(phrase) {
      return base_url+"movimientos/compras/getProveedores";
    },
  
    getValue: function(element) {
      return element.nombre;
    },
  
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
        dataType: "json"
      }
    },
  
    preparePostData: function(data) {
      data.phrase = $("keyupProveedor").val();
      return data;
    },
  
    requestDelay: 400,

    list: {
		match: {
			enabled: true
        },
        
        onSelectItemEvent: function() {
			var value = $("#keyupProveedor").getSelectedItemData().id_proveedor;
			$("#idProveedor").val(value).trigger("change");
		}
	}
  };
  
$("#keyupProveedor").easyAutocomplete(options);


