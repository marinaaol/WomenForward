document.addEventListener('DOMContentLoaded', () => {
    const pais   = document.querySelector('#pais');
    const cidade = document.querySelector('#cidade');

    if (!pais || !cidade) return;

    const atualizarCidades = () => {
        const paisSelecionado = pais.value;

        Array.from(cidade.options).forEach((opcao) => {
            const paisDaOpcao = opcao.dataset.pais;
            opcao.disabled = Boolean(
                paisSelecionado && paisDaOpcao && paisDaOpcao !== paisSelecionado
            );
        });

        const atual = cidade.selectedOptions[0];
        if (atual?.disabled) cidade.value = '';

        if (paisSelecionado === 'GLOBAL') {
            cidade.value = '';
            cidade.disabled = true;
        } else {
            cidade.disabled = false;
        }
    };

    pais.addEventListener('change', atualizarCidades);
    atualizarCidades();
});