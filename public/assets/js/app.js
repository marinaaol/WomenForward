document.addEventListener('DOMContentLoaded', () => {
    const pais = document.querySelector('#pais');
    const cidade = document.querySelector('#cidade');

    if (!pais || !cidade) return;

    const atualizarCidades = () => {
        const paisSelecionado = pais.value;
        const opcoesCidade = Array.from(cidade.options);

        opcoesCidade.forEach((opcao) => {
            const paisDaOpcao = opcao.dataset.pais;
            opcao.disabled = Boolean(paisSelecionado && paisDaOpcao && paisDaOpcao !== paisSelecionado);
        });

        const opcaoAtual = cidade.selectedOptions[0];
        if (opcaoAtual?.disabled) cidade.value = '';
        cidade.disabled = paisSelecionado === 'GLOBAL';
    };

    pais.addEventListener('change', atualizarCidades);
    atualizarCidades();
});
