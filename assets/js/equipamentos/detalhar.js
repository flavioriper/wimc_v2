jQuery(document).ready(function () {

    carregar_tabela_listar_equipamentos(); //carrega tabela listar clientes

});


function deletar_equipamento(id) {
    
 var r = confirm("Deseja realmente exluir este equipamento?");
 
    if (r == true) {
        jQuery.ajax({
        method: "POST",
        url: "equipamento/deletar_equipamento",
        retrieve: true,
        data: {
            id: id
        },
        success: function (retorno){
            let ret = jQuery.parseJSON(retorno);          
            jQuery('#tabela_listar_equipamentos').DataTable().ajax.reload();        
        }
        })
    } else {

    }
    
}


function carregar_tabela_listar_equipamentos() {
    
    let idioma = '';
    let cookies = document.cookie;    
    let cookies_esplitados = cookies.split(';');
    let valor_cookie ='';
    
    jQuery.each(cookies_esplitados, function( key, value ) {
        if(value.match("lang")){
            let lang_splitado = value.split('=');            
            valor_cookie = lang_splitado[1];  
        }
    });
    
    switch(valor_cookie){
        case "portuguese":
            idioma = 'http://whereis.ws.bestapp.com.br/pub_data/vendor/DataTables/portuguese.json';
        break;
        case "english":
            idioma = 'http://whereis.ws.bestapp.com.br/pub_data/vendor/DataTables/english.json';
        break;
        case "spanish":
            idioma = 'http://whereis.ws.bestapp.com.br/pub_data/vendor/DataTables/spanish.json';
        break;
        default:
            idioma = 'http://whereis.ws.bestapp.com.br/pub_data/vendor/DataTables/portuguese.json';
        break;
    }
    var local = sessionStorage.getItem("dashDetail");
    jQuery('#tabela_listar_equipamentos').DataTable({
        "ajax": "detalhar/obter_equipamentos_where/"+local,
        language: {
            url: idioma
        },
        "columns": [
            {"data": "modelo"},            
            {"data": "numero_serie"},            
            {"data": "localizacao"},            
            {"data": "firmware"},            
            {"data": "status"},
            {"data": "nothing"},
            {"data": "button"}
            
        ]
    });
}

function alterar_status(id) {
    
 let status = jQuery("#status_"+id).val();
  
 jQuery.ajax({
    method: "POST",
    url: "equipamento/alterar_status",
    data: {
        id: id, status: status
    },
    success: function (retorno){
        let ret = jQuery.parseJSON(retorno);                
    }
 })
  
  
}