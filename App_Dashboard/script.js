$(document).ready(() => {
	$('#doc').click(()=>{
        //$('#pagina').load('./documentacao.html')
        //outra forma de executar a intrução a cima é...
        $.get('./documentacao.html', data =>{
            $('#pagina').html(data)
        })
    })
    $('#sup').on('click', ()=>{
        //$('#pagina').load('./suporte.html')
        //outra forma de executar a instrução além mo método GET() é com o método POST()
        $.post('./suporte.html', data =>{
            $('#pagina').html(data)
        })
    })

    //Ajax
    $('#competencia').on('change', e => {
        let competencia = $(e.target).val()
        $.ajax({
            type: 'GET',
            url: './app.php',
            data: `competencia=${competencia}`, //nome dessa sintaxe >> x-www-form-urlencoded
            dataType: 'json',
            success: dados => {
                $('#nVendas').html(dados.numeroVendas).css('color','green')
                $('#tVendas').html(dados.totalVendas).css('color','green')
                // console.log(dados.numeroVendas, dados.totalVendas)
            }, 
            error: msgErro => {console.log(msgErro)}
        })
    })
})