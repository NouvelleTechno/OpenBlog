// Variables booléennes
let pseudo = false;
let email = false;
let rgpd = false;
let pass = false;

// On charge les éléments du formulaire
document.querySelector("#registration_form_nickname").addEventListener("input", checkPseudo);
document.querySelector("#registration_form_email").addEventListener("input", checkEmail);
document.querySelector("#registration_form_agreeTerms").addEventListener("input", checkRgpd);
document.querySelector("#registration_form_plainPassword").addEventListener("input", checkPass);

function checkPseudo(){
    pseudo = this.value.length > 2;
    checkAll();
}

function checkEmail(){
    let regex = new RegExp("\\S+@\\S+\\.\\S+");
    email = regex.test(this.value);
    checkAll();
}

function checkRgpd(){
    rgpd = this.checked;
    checkAll();
}

function checkAll(){
    document.querySelector("#submit-button").setAttribute("disabled", "disabled");
    if(email && pseudo && pass && rgpd){
        document.querySelector("#submit-button").removeAttribute("disabled");
    }
}

const PasswordStrength = {
    STRENGTH_VERY_WEAK: 'Très faible',
    STRENGTH_WEAK: 'Faible',
    STRENGTH_MEDIUM: 'Moyen',
    STRENGTH_STRONG: 'Fort',
    STRENGTH_VERY_STRONG: 'Très fort',
}

function checkPass(){
    // On récupère le mot de passe tapé
    let mdp = this.value;

    // On récupère l'élément d'affichage de l'entropie
    let entropyElement = document.querySelector("#entropy");

    // On évalue la force du mot de passe
    let entropy = evaluatePasswordStrength(mdp);

    entropyElement.classList.remove("text-red", "text-orange", "text-green");

    // On attribue la couleur en fonction de l'entropie
    switch(entropy){
        case 'Très faible':
            entropyElement.classList.add("text-red");
            pass = false;
            break;
        case 'Faible':
            entropyElement.classList.add("text-red");
            pass = false;
            break;
        case 'Moyen':
            entropyElement.classList.add("text-orange");
            pass = false;
            break;
        case 'Fort':
            entropyElement.classList.add("text-green");
            pass = true;
            break;
        case 'Très fort':
            entropyElement.classList.add("text-green");
            pass = true;
            break;
        default:
            entropyElement.classList.add("text-red");
            pass = false;
    }

    entropyElement.textContent = entropy;

    checkAll();
}

function evaluatePasswordStrength(password){
    // On calcule la longueur du mot de passe
    let length = password.length;

    // Si le mot de passe est vide
    if(!length){
        return PasswordStrength.STRENGTH_VERY_WEAK;
    }

    // On crée un objet qui contiendra les caractères et leur nombre
    let passwordChars = {};

    for(let index = 0; index < password.length; index++){
        let charCode = password.charCodeAt(index);
        passwordChars[charCode] = (passwordChars[charCode] || 0) + 1;
    }

    // Compte le nombre de caractères différents dans le mot de passe
    let chars = Object.keys(passwordChars).length;

    // On initialise les variables des types de caractères
    let control = 0, digit = 0, upper = 0, lower = 0, symbol = 0, other = 0;

    for(let [chr, count] of Object.entries(passwordChars)){
        chr = Number(chr);
        if(chr < 32 || chr === 127){
            // Caractère de contrôle
            control = 33;
        }else if(chr >= 48 && chr <= 57){
            // Chiffres
            digit = 10;
        }else if(chr >= 65 && chr <= 90){
            // Majuscules
            upper = 26;
        }else if(chr >= 97 && chr <= 122){
            // Minuscules
            lower = 26;
        }else if(chr >= 128){
            // Autres caractères 
            other = 128;
        }else{
            // Symboles
            symbol = 33;
        }
    }

    // On calcule le pool de caractères
    let pool = control + digit + upper + lower + other + symbol;

    // Formule de calcul de l'entropie
    let entropy = chars * Math.log2(pool) + (length - chars) * Math.log2(chars);

    if(entropy >= 120){
        return PasswordStrength.STRENGTH_VERY_STRONG;
    }else if(entropy >= 100){
        return PasswordStrength.STRENGTH_STRONG;
    }else if(entropy >= 80){
        return PasswordStrength.STRENGTH_MEDIUM;
    }else if(entropy >= 60){
        return PasswordStrength.STRENGTH_WEAK;
    }else{
        return PasswordStrength.STRENGTH_VERY_WEAK;
    }
}