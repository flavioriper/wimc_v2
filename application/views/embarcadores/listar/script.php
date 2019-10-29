<script>
    $(document).ready(function() {
        $('#tabela-envios').dataTable({
            "language": idioma,
            "order": [0, 'desc']
        })
    })

    function deletarEquipamento(id) {
        $('#deletarEquipamento').modal()
        $("#confirmar-exclusao").click(function() {
            $.ajax({
                url: '<?=base_url('equipamentos/excluir')?>',
                type: 'POST',
                data: { id },
                success: function(data) {
                    if (data != '') {
                        alert('Ocorreu um erro, contate o administrador')
                    }
                    location.reload()
                }
            })
        })
    }
</script>