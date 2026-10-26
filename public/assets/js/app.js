document.addEventListener('DOMContentLoaded', () => {
    // Em telemóvel, apresenta os resultados após submeter os filtros.
    const formularioOportunidades = document.querySelector('.formulario-oportunidades');
    if (formularioOportunidades) {
        formularioOportunidades.addEventListener('submit', () => {
            formularioOportunidades.action = window.matchMedia('(max-width: 640px)').matches
                ? 'oportunidades.php#resultados'
                : 'oportunidades.php';
        });
    }

    /* ---------- Navegação móvel ---------- */
    const menuToggle = document.querySelector('.menu-toggle');
    const menuPrincipal = document.querySelector('#menu-principal');

    if (menuToggle && menuPrincipal) {
        const fecharMenu = () => {
            menuPrincipal.classList.remove('is-open');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.setAttribute('aria-label', 'Abrir menu');
        };

        menuToggle.addEventListener('click', () => {
            const aberto = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!aberto));
            menuToggle.setAttribute('aria-label', aberto ? 'Abrir menu' : 'Fechar menu');
            menuPrincipal.classList.toggle('is-open', !aberto);
        });

        menuPrincipal.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', fecharMenu);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') fecharMenu();
        });

        window.matchMedia('(min-width: 901px)').addEventListener('change', fecharMenu);
    }

    /* ---------- Largura total e efeito parallax das imagens ---------- */
    // Mantém as imagens editoriais alinhadas à largura real da janela, incluindo a barra de scroll.
    const atualizarLarguraImagens = () => {
        const larguraViewport = document.documentElement.clientWidth;
        document.documentElement.style.setProperty('--site-viewport-width', `${larguraViewport}px`);
        document.documentElement.style.setProperty('--site-viewport-negative-half-width', `${larguraViewport / -2}px`);
    };

    atualizarLarguraImagens();
    window.addEventListener('resize', atualizarLarguraImagens);

    // Aplica o mesmo movimento vertical a cada imagem, variando apenas os seletores e a intensidade.
    const aplicarParallax = (seletorMoldura, seletorImagem, propriedade, amplitude = 24, base = 0) => {
        const moldura = document.querySelector(seletorMoldura);
        const imagem = document.querySelector(seletorImagem);

        if (!moldura || !imagem || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        let animacaoAgendada = false;

        // Calcula a posição da imagem apenas quando a sua moldura está visível.
        const atualizar = () => {
            animacaoAgendada = false;
            const limites = moldura.getBoundingClientRect();

            if (limites.bottom < 0 || limites.top > window.innerHeight) return;

            const progresso = (window.innerHeight - limites.top) / (window.innerHeight + limites.height);
            const deslocamento = base + (progresso - 0.5) * amplitude;
            imagem.style.setProperty(propriedade, `${deslocamento.toFixed(1)}px`);
        };

        // Agrupa eventos de scroll no próximo frame de animação para manter o movimento suave.
        const agendarAtualizacao = () => {
            if (animacaoAgendada) return;
            animacaoAgendada = true;
            window.requestAnimationFrame(atualizar);
        };

        window.addEventListener('scroll', agendarAtualizacao, { passive: true });
        window.addEventListener('resize', agendarAtualizacao);
        atualizar();
    };

    // Cada chamada liga uma moldura, a imagem que se move e a variável CSS correspondente.
    aplicarParallax('.hero-image', '.hero-image img.responsive', '--hero-parallax-y', 55, 27.5);
    aplicarParallax('.imagem-stem-container', '.imagem-stem', '--stem-parallax-y');
    aplicarParallax('.apoio-image-container', '.apoio-image', '--inicio-parallax-y');
    aplicarParallax('.iniciativas-pitch-container', '.iniciativas-pitch', '--inicio-parallax-y');
    aplicarParallax('.entidade-imagem-container', '.entidade-imagem', '--inicio-parallax-y');

    /* ----------  Filtrar cidades por país ---------- */
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

    /* ---------- Mostrar/esconder password ---------- */
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

    /* ----------  Botão "Voltar ao topo" ---------- */
    const myBtn = document.getElementById('myBtn');

    if (myBtn) {
        const atualizarBotaoTopo = () => {
            myBtn.style.display = window.scrollY > 20 ? 'block' : 'none';
        };

        window.addEventListener('scroll', atualizarBotaoTopo, { passive: true });
        atualizarBotaoTopo();

        myBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ----------  Flip dos cartões de oportunidades ---------- */
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

// Mostrar data corrente no texto da Política de Privacidade

document.querySelectorAll('time').forEach($e => {
  const date = new Date($e.dateTime);
  // or output the localized date only
  $e.innerHTML = date.toLocaleDateString();
});
