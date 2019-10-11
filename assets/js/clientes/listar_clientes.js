jQuery(document).ready(function () {
  carregar_tabela_listar_clientes(); //carrega tabela listar clientes
});

function deletar_cliente(id) {   
  var r = confirm("Deseja realmente exluir este cliente?");    
    
  if (r == true) {  
    jQuery.ajax({
      method: "POST",
      url: base_url + "cliente/deletar_cliente",
      data: {
        id: id
      },
      success: function (retorno){
        let ret = jQuery.parseJSON(retorno);          
        jQuery('#tabela_listar_clientes').DataTable().ajax.reload();        
      }
    });
 }
}

function carregar_tabela_listar_clientes() {
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
      idioma = base_url + 'pub_data/vendor/DataTables/portuguese.json';
    break;
    case "english":
      idioma = base_url + 'pub_data/vendor/DataTables/english.json';
    break;
    case "spanish":
      idioma = base_url + 'pub_data/vendor/DataTables/spanish.json';
    break;
    default:
      idioma = base_url + 'pub_data/vendor/DataTables/portuguese.json';
    break;
  }

  jQuery('#tabela_listar_clientes').DataTable({
    "ajax": base_url + "cliente/buscar_clientes",
    retrieve: true,
    language: {
      url: idioma
    },
    "columns": [
      {"data": "cliente"},            
      {"data": "nickname"},            
      {"data": "cidade"},            
      {"data": "pais"},            
      {"data": "embarcador"},            
      {"data": "prospect"},            
      {"data": "button"}           
    ]
  });
}
