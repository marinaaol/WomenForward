document.addEventListener('DOMContentLoaded', () => {

    /* ---------- 1. Filtrar cidades por país ---------- */
    const pais   = document.querySelector('#pais');
    const cidade = document.querySelector('#cidade');

    if (pais && cidade) {
        const atualizarCidades = () => {
            const paisSelecionado = pais.value;
            const opcoesCidade = Array.from(cidade.options);

            opcoesCidade.forEach((opcao) => {
                const paisDaOpcao = opcao.dataset.pais;
                opcao.disabled = Boolean(
                    paisSelecionado && paisDaOpcao && paisDaOpcao !== paisSelecionado
                );
            });

            const opcaoAtual = cidade.selectedOptions[0];
            if (opcaoAtual?.disabled) cidade.value = '';

            if (paisSelecionado === 'GLOBAL') {
                cidade.value = '';
                cidade.disabled = true;
            } else {
                cidade.disabled = false;
            }
        };

        pais.addEventListener('change', atualizarCidades);
        atualizarCidades();
    }

    /* ---------- 2. Mostrar/esconder password ---------- */
    const passwordInput = document.getElementById('password');
    const toggler = document.getElementById('toggler');

    if (passwordInput && toggler) {
        const togglePassword = () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggler.classList.toggle('fa-eye', !isPassword);
            toggler.classList.toggle('fa-eye-slash', isPassword);
        };

        toggler.addEventListener('click', togglePassword);
        toggler.parentElement?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePassword();
            }
        });
    }

    /* ---------- 3. Botão "Voltar ao topo" ---------- */
    const myBtn = document.getElementById('myBtn');

    if (myBtn) {
        window.addEventListener('scroll', () => {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                myBtn.style.display = 'block';
            } else {
                myBtn.style.display = 'none';
            }
        });

        myBtn.addEventListener('click', () => {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    }

    /* ---------- 4. Flip dos cartões de oportunidades ---------- */
    document.querySelectorAll('.cartao-oportunidade').forEach((cartao) => {
        const frente = cartao.querySelector('.cartao-frente');
        const verso = cartao.querySelector('.cartao-verso');

        if (!frente || !verso) return;

        const definirFace = (mostrarVerso) => {
            cartao.classList.toggle('is-flipped', mostrarVerso);
            frente.setAttribute('aria-hidden', String(mostrarVerso));
            verso.setAttribute('aria-hidden', String(!mostrarVerso));
            frente.toggleAttribute('inert', mostrarVerso);
            verso.toggleAttribute('inert', !mostrarVerso);
        };

        let toqueAtual = false;
        definirFace(false);

        cartao.addEventListener('pointerdown', (evento) => {
            toqueAtual = evento.pointerType === 'touch';
        });

        cartao.addEventListener('pointerenter', (evento) => {
            if (evento.pointerType === 'mouse') definirFace(true);
        });

        cartao.addEventListener('pointerleave', (evento) => {
            if (evento.pointerType === 'mouse' && !cartao.contains(document.activeElement)) {
                definirFace(false);
            }
        });

        cartao.addEventListener('focusin', () => {
            if (!toqueAtual) definirFace(true);
        });

        cartao.addEventListener('focusout', (evento) => {
            if (!cartao.contains(evento.relatedTarget)) definirFace(false);
        });

        cartao.addEventListener('click', (evento) => {
            if (!toqueAtual) return;

            if (evento.target.closest('a, button, input, select, textarea, label')) {
                toqueAtual = false;
                return;
            }

            definirFace(!cartao.classList.contains('is-flipped'));
            toqueAtual = false;
        });
    });
});

// Função global (usada pelo onclick inline do botão no HTML)
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
