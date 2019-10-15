<script>
    $('#frm-cliente').submit(function(ev) {
        ev.preventDefault()
        $('#enviar').prop('disabled', true)
        let cliente = new Object()
        cliente.nome = $('#nome').val()
        cliente.cnpj = $('#cnpj').cleanVal()
        cliente.nickname = $('#nickname').val()
        cliente.rua = $('#rua').val()
        cliente.bairro = $('#bairro').val()
        cliente.cidade = $('#cidade').val()
        cliente.uf = $('#uf').val()
        cliente.starcom = construirStarcom()
        cliente.contato = construirContatos()
        cliente.obs = $('#obs').val()
        cliente.prospect = constuirProspect()
        cliente.data_inserido = $('#data_cadastro').val()
        cliente.pais = $('#pais').val()
        cliente.cep = $('#cep').val()
        cliente.embarcador = $('#embarcador').val()
        cliente = JSON.stringify(cliente)
        $.ajax({
            url: "<?=base_url('clientes/add')?>",
            type: 'POST',
            data: {cliente},
            success: function(data) {
                if (data == 'erro-500') {
                    $('#alerta-erro').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-erro').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                } else {
                    $('#cliente-link').attr("href", `<?=base_url('clientes/gerenciar/')?>${data}`)
                    $(window).scrollTop(0)
                    $('#alerta-sucesso').removeClass('hide')
                    $('#frm-cliente')[0].reset()
                    setTimeout(() => {
                        $('#alerta-sucesso').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                }
            }
        })
    })

    function constuirProspect() {
        if ($('#btn_prospect_danger').is(':checked')) {
            return 'N'
        }
        if ($('#btn_prospect_success').is(':checked')) {
            return 'Y'
        }
    }

    function construirStarcom() {
        let resposta = []
        $('.starcom').each(function() {
            resposta.push($(this).val())
        })
        return resposta
    }

    function construirContatos() {
        let resposta = []
        $('.contato-grupo').each(function() {
            contato = new Object()
            contato.nome = $('.nome-contato', this).val()
            contato.telefone = $('.telefone-contato', this).val()
            contato.email = $('.email-contato', this).val()
            contato.cargo = $('.cargo-contato', this).val()
            resposta.push(contato)
        })
        return resposta
    }

    // $('#label_prospect_danger').click(function() {
    //     if ($('#btn_prospect_danger').is(':checked')) {
            
    //     } else {
    //         alert('Não apertado')
    //     }
    //     // $('#btn_prospect_danger').prop('checked', true)
    //     // $('#btn_prospect_success').prop('checked', false)
    // })
    
    // $('#label_prospect_sucesso').click(function() {
    //     // $('#btn_prospect_success').prop('checked', true)
    //     // $('#btn_prospect_danger').prop('checked', false)
    // })
    
    $('#adicionar-starcom').click(function() {
        let value = $('#fieldset-starcom input:last').val()
        if (value == '') {
            $('#texto-aviso').text(`
                Preencha o campo anterior antes de criar um novo campo em Sistemas.
            `)
            $('#modalAviso').modal()
            return false
        }
        $('#fieldset-starcom').append(`
            <div class="input-group mb-3">
                <input name="starcom[]" type="text" class="form-control starcom" />
            </div>
        `)
    })

    $('#adicionar-contato').click(function() {
        let contato = $('.nome-contato:last').val()
        let telefone = $('.telefone-contato:last').val()
        let email = $('.email-contato:last').val()
        if ((contato == '') || (telefone == '' && email == '')) {
            $('#texto-aviso').text(`
                Preencha pelo menos um nome e um telefone e/ou e-mail antes de criar outro contato.
            `)
            $('#modalAviso').modal()
            return false
        }
        $('#fieldset-contatos').append(`
            <div class="contato-grupo">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Contato</span>
                    </div>
                    <input name="contato[nome][]" type="text" class="form-control nome-contato" />
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Telefone</span>
                            </div>
                            <input name="contato[telefone][]" type="text" class="form-control telefone-contato" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">E-mail</span>
                            </div>
                            <input name="contato[email][]" type="email" class="form-control email-contato" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cargo / Função</span>
                            </div>
                            <input name="contato[cargo][]" type="text" class="form-control cargo-contato" />
                        </div>
                    </div>
                </div>
            </div>
        `)
    })

    $.getJSON("<?=base_url("assets/js/countries/countries_pt.json")?>", function(data) {
        jQuery.each(data, function( key, value){
            let sigla_pais = value.alpha2;     
            let selected_ = value.alpha2 == 'br' ? "selected" : '';
            jQuery("[name='pais']").append(`
                <option value="${sigla_pais.toUpperCase()}" ${selected_}>${value.name}</option>
            `)
        })   
    })
</script>