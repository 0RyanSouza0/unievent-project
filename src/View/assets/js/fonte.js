// fonte.js

// Aplica o tamanho salvo, se existir
document.addEventListener("DOMContentLoaded", () => {
  const tamanhoFonte = localStorage.getItem("tamanhoFonte");
  if (tamanhoFonte) {
    document.documentElement.style.fontSize = tamanhoFonte;
  }
});

// Chamada pelo botão na página principal
function definirFonteGrande() {
  const novoTamanho = "20px"; // ou outro valor fixo
  localStorage.setItem("tamanhoFonte", novoTamanho);
  document.documentElement.style.fontSize = novoTamanho;
}

function redefinirFonte() {
  localStorage.removeItem("tamanhoFonte");
  document.documentElement.style.fontSize = "16px"; // valor padrão
}
