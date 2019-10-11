$(document).ready(function () {

//    $('#cep').keyup(function () {
//        console.log("aq"); return false;
//        //remove os caracteres especiais e deixa apenas os números
//        let num_cep = $('#cep').val().replace(/\D/g, "").trim();
//        if (num_cep.length === 8) {
//            $.ajax({
//                url: "/cliente/cep/" + num_cep,
//                type: "get",
//                success: function (e) {
//                    let data = JSON.parse(e);
//                    if (data.uf !== undefined) {
//                        $('#rua').val(data.Logradouro);
//                        $('#bairro').val(data.Bairro);
//                        $('#cidade').val(data.Cidade);
//                        $('#uf').val(data.uf);
//                        $('#complemento').focus();
//                    } else {
//                        $('#rua').val('');
//                        $('#bairro').val('');
//                        $('#cliente_cidade').val('');
//                        $('#cidade').val('');
//                        $('#uf').val('');
//                        $('#rua').focus();
//                    }
//                },
//                error: function () {
//                    $('#cliente_rua').focus();
//                }
//            });
//        }
//    });
});
