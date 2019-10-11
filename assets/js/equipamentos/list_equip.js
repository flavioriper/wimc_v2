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
    var url = window.location.href;
    url = url.split('list_equip/');
    url = url[1];
    url = url.split('/');
    var tipo = url[0].split(':');
    var num = url[1].split(':');

    // pass num[1]/tipo[1] -- url quebrada para busca
    jQuery.each(cookies_esplitados, function( key, value ) {
        if(value.match("lang")){
            let lang_splitado = value.split('=');            
            valor_cookie = lang_splitado[1];  
        }
    });

    //alert(base_url+ "equipamento/buscar_equipamentosDash/"+num[1]+"/"+tipo[1])
    
    switch(valor_cookie){
        case "portuguese":
            idioma = base_url + '/pub_data/vendor/DataTables/portuguese.json';
        break;
        case "english":
            idioma = base_url + '/pub_data/vendor/DataTables/english.json';
        break;
        case "spanish":
            idioma = base_url + '/pub_data/vendor/DataTables/spanish.json';
        break;
        default:
            idioma = base_url + '/pub_data/vendor/DataTables/portuguese.json';
        break;
    }
    
 
    jQuery('#tabela_listar_equipamentos').DataTable({
        "ajax":base_url+ "equipamento/buscar_equipamentosDash/"+num[1]+"/"+tipo[1],
        language: {
            url: idioma,
            num:num[1],
            tipo:tipo[1]
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