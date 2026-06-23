function aplicarTemaSalvo() {
    const temaSalvo = localStorage.getItem("temaFindWare");

    if (temaSalvo === "escuro") {
        document.body.classList.add("tema-escuro");
    } else {
        document.body.classList.remove("tema-escuro");
    }
}

function trocarTema() {
    const temaAtual = localStorage.getItem("temaFindWare");

    if (temaAtual === "escuro") {
        localStorage.setItem("temaFindWare", "claro");
        document.body.classList.remove("tema-escuro");
    } else {
        localStorage.setItem("temaFindWare", "escuro");
        document.body.classList.add("tema-escuro");
    }
}

document.addEventListener("DOMContentLoaded", aplicarTemaSalvo);