document.addEventListener('DOMContentLoaded', () => {
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

    /* ---------- Efeito parallax da imagem principal ---------- */
    const heroFrame = document.querySelector('.hero-image');
    const heroImage = heroFrame?.querySelector('.hero-photo');
    const heroPhoto = heroImage?.querySelector('img.responsive');

    if (heroFrame && heroImage && heroPhoto) {
        const atualizarLarguraHero = () => {
            const larguraViewport = document.documentElement.clientWidth;
            document.documentElement.style.setProperty('--site-viewport-width', `${larguraViewport}px`);
            document.documentElement.style.setProperty('--site-viewport-negative-half-width', `${larguraViewport / -2}px`);
        };

        atualizarLarguraHero();
        window.addEventListener('resize', atualizarLarguraHero);

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            let frameAgendado = false;

            const atualizarParallax = () => {
                frameAgendado = false;
                const limites = heroImage.getBoundingClientRect();

                if (limites.bottom < 0 || limites.top > window.innerHeight) return;

                const deslocamento = Math.max(0, Math.min(55, window.scrollY * 0.12));
                heroPhoto.style.setProperty('--hero-parallax-y', `${deslocamento.toFixed(1)}px`);
            };

            const agendarParallax = () => {
                if (frameAgendado) return;
                frameAgendado = true;
                window.requestAnimationFrame(atualizarParallax);
            };

            window.addEventListener('scroll', agendarParallax, { passive: true });
            window.addEventListener('resize', agendarParallax);
            atualizarParallax();
        }
    }

    /* ---------- Efeito parallax da imagem da página STEM ---------- */
    const imagemStemFrame = document.querySelector('.imagem-stem-container');
    const imagemStem = imagemStemFrame?.querySelector('.imagem-stem');

    if (imagemStemFrame && imagemStem) {
        const atualizarLarguraImagemStem = () => {
            const larguraViewport = document.documentElement.clientWidth;
            document.documentElement.style.setProperty('--site-viewport-width', `${larguraViewport}px`);
            document.documentElement.style.setProperty('--site-viewport-negative-half-width', `${larguraViewport / -2}px`);
        };

        atualizarLarguraImagemStem();
        window.addEventListener('resize', atualizarLarguraImagemStem);

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            let frameStemAgendado = false;

            const atualizarParallaxStem = () => {
                frameStemAgendado = false;
                const limites = imagemStemFrame.getBoundingClientRect();

                if (limites.bottom < 0 || limites.top > window.innerHeight) return;

                const progresso = (window.innerHeight - limites.top) / (window.innerHeight + limites.height);
                const deslocamento = (progresso - 0.5) * 24;
                imagemStem.style.setProperty('--stem-parallax-y', `${deslocamento.toFixed(1)}px`);
            };

            const agendarParallaxStem = () => {
                if (frameStemAgendado) return;
                frameStemAgendado = true;
                window.requestAnimationFrame(atualizarParallaxStem);
            };

            window.addEventListener('scroll', agendarParallaxStem, { passive: true });
            window.addEventListener('resize', agendarParallaxStem);
            atualizarParallaxStem();
        }
    }

    /* ---------- Efeito parallax da imagem de apoio ---------- */
    const imagemApoioFrame = document.querySelector('.apoio-image-container');
    const imageApoio = imagemApoioFrame?.querySelector('.apoio-image');

    if (imagemApoioFrame && imagemApoio) {
        const atualizarLarguraImagemApoio = () => {
            const larguraViewport = document.documentElement.clientWidth;
            document.documentElement.style.setProperty('--site-viewport-width', `${larguraViewport}px`);
            document.documentElement.style.setProperty('--site-viewport-negative-half-width', `${larguraViewport / -2}px`);
        };

        atualizarLarguraImagemApoio();
        window.addEventListener('resize', atualizarLarguraImagemApoio);

        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            let frameApoioAgendado = false;

            const atualizarParallaxApoio = () => {
                frameApoioAgendado = false;
                const limites = imagemApoioFrame.getBoundingClientRect();

                if (limites.bottom < 0 || limites.top > window.innerHeight) return;

                const progresso = (window.innerHeight - limites.top) / (window.innerHeight + limites.height);
                const deslocamento = (progresso - 0.5) * 24;
                imagemApoio.style.setProperty('--apoio-parallax-y', `${deslocamento.toFixed(1)}px`);
            };

            const agendarParallaxApoio = () => {
                if (frameApoioAgendado) return;
                frameApoioAgendado = true;
                window.requestAnimationFrame(atualizarParallaxApoio);
            };

            window.addEventListener('scroll', agendarParallaxApoio, { passive: true });
            window.addEventListener('resize', agendarParallaxApoio);
            atualizarParallaxApoio();
        }
    }

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
        const atualizarBotaoTopo = () => {
            myBtn.style.display = window.scrollY > 20 ? 'block' : 'none';
        };

        window.addEventListener('scroll', atualizarBotaoTopo, { passive: true });
        atualizarBotaoTopo();

        myBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
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

// Mostrar data corrente no texto da Política de Privacidade

document.querySelectorAll('time').forEach($e => {
  const date = new Date($e.dateTime);
  // or output the localized date only
  $e.innerHTML = date.toLocaleDateString();
});
