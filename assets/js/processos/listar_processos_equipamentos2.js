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
    
    jQuery('#t_p_envio_equipamentos').DataTable({
        "order": [0, 'desc'],
        "ajax": base_url + "embarcador/buscarProcessosEnvioEquipamentos2",        
        language: {
            url: idioma
        },
        "columns": [
            {"data": "id"},            
            {"data": "cliente"},            
            {"data": "serie"},            
            {"data": "referenciaenvio"},            
            {"data": "dataenvio"}  ,
            {"data": "dataentrega"}                  
        ]
    });

    jQuery('#t_p_envio_equipamentos_historico').DataTable({
        "order": [0, 'desc'],
        "ajax": base_url + "embarcador/buscarProcessosEnvioEquipamentosHistorico",        
        language: {
            url: idioma
        },
        "columns": [
            {"data": "id"},            
            {"data": "cliente"},            
            {"data": "serie"},            
            {"data": "referenciaenvio"},            
            {"data": "dataenvio"}  ,
            {"data": "dataentrega"}                  
        ]
    });
});

function openModal(id){
    $('#idEmbarcador').val(id)
    $.ajax({
        url: base_url + "embarcador/buscarEquipamentosModal/" + id,
        type: 'GET',
        success: function(data) {
            let equipamentos = JSON.parse(data)
            $('#equipamentos-disponiveis').text('')
            for (let i = 0; i < equipamentos.length; i++) {
                if (i === equipamentos.length - 1) $('#equipamentos-disponiveis').append(equipamentos[i].numero_serie + '.')
                else $('#equipamentos-disponiveis').append(equipamentos[i].numero_serie + ', ')
            }
            $('#modalDataEntrega').modal('toggle');
        }
    })

}

function alterarDataEntrega(){
    var data = $('#dataEntrega').val();

    $.ajax({
        method:"POST",
        url: base_url + "embarcador/alterarDataEntrega",
        data:{
            data:data,
            id: $('#idEmbarcador').val()
        },success:function(response){
            if(response == 1){
                $('#modalDataEntrega').modal('hide');
                alert('Data adicionado com sucesso!');
                location.reload();
            }else{
                alert('Digite uma data verdadeira');
            }
            
        }
    });
    
}