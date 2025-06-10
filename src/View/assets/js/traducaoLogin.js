
const translations = {
    en: {
        login_title: "Login",
        email_label: "Email",
        password_label: "Password",
        email_placeholder: "email@example.com",
        password_placeholder: "Enter your password here",
        login_button: "Login",
        forgot_password: "Forgot my password"
    },
    pt: {
        login_title: "Login",
        email_label: "E-mail",
        password_label: "Senha",
        email_placeholder: "email@email.com.br",
        password_placeholder: "Insira aqui sua senha",
        login_button: "Login",
        forgot_password: "Esqueci minha senha"
    }
};

// traduçao login



function setLanguage(lang) {
    localStorage.setItem("lang", lang);
    document.querySelectorAll("[data-i18n]").forEach((el) => {
        const key = el.getAttribute("data-i18n");
        if (translations[lang][key]) {
            el.textContent = translations[lang][key];
        }
    });

    document.querySelectorAll("[data-i18n-placeholder]").forEach((el) => {
        const key = el.getAttribute("data-i18n-placeholder");
        if (translations[lang][key]) {
            el.placeholder = translations[lang][key];
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const savedLang = localStorage.getItem("lang") || "pt";
    setLanguage(savedLang);
});
