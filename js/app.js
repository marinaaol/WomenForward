const form = document.querySelector("#form-pesquisa");
const estado = document.querySelector("#estado-pesquisa");
const resultados = document.querySelector("#resultados");

form?.addEventListener("submit", (event) => {
    event.preventDefault();
    const filtros = new FormData(form);
    const categoria = filtros.get("categoria");
    estado.textContent = categoria
    ? `A pesquisar oportunidades em ${categoria}`
    : "A pesquisar oportunidades...";
    resultados.replaceChild();
});

