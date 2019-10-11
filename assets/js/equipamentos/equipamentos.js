jQuery(document).ready(function () {

});


function alterar_status(id) {
    
 let status = jQuery("#status_"+id).val();
//  3,5,1 
 
 jQuery.ajax({
    method: "POST",
    url: "equipamento/alterar_status",
    data: {
        id: id, status: status
    },
    success: function (retorno){
        let ret = jQuery.parseJSON(retorno);
        if(ret.status == "error"){
            alert('Os status só podem ser alterados manualmente após o status No Cliente');
        }
    }
 })
  
  
}