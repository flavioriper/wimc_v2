jQuery(document).ready(function () {

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
    
    switch(valor_cookie) {
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

    //console.log(tipo)
    
    jQuery('#t_p_abertura_viagem').DataTable({
        "ajax": base_url + "processo/listar_processos_json/" + tipo,        
        language: {
            url: idioma
        },
        "columns": [
            {"data": "id"},            
            {"data": "cliente"},            
            {"data": "numeroserieequipamento"},            
            {"data": "referenciaviagem"},            
            {"data": "datauso"},
            {"data": "awb"}        
        ]
    });
});