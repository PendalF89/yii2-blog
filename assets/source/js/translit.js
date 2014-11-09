$(document).ready(function() {
    /**
     * Translit url
     * @param {string} text
     * @returns {string}
     */
    function translit(text) {
        // Символ, на который будут заменяться все спецсимволы
        var space = '-';
        // Берем значение из нужного поля и переводим в нижний регистр
        var text = text.toLowerCase();

        // Массив для транслитерации
        var transl = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'jo', 'ж': 'zh',
            'з': 'z', 'и': 'i', 'й': 'jj', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
            'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'kh',
            'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'shh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'eh', 'ю': 'ju', 'я': 'ja',
            ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
            '#': space, '$': space, '%': space, '^': space, '&': space, '*': space,
            '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space,
            ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
            '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
            '?': space, '<': space, '>': space, '№':space, '«':space, '»':space
        }

        var result = '';
        var curent_sim = '';

        for(i=0; i < text.length; i++) {
            // Если символ найден в массиве то меняем его
            if(transl[text[i]] != undefined) {
                if(curent_sim != transl[text[i]] || curent_sim != space){
                    result += transl[text[i]];
                    curent_sim = transl[text[i]];
                }
            }
            // Если нет, то оставляем так как есть
            else {
                result += text[i];
                curent_sim = text[i];
            }
        }

        result = result.replace(/^-/, '');
        return result.replace(/-$/, '');
    }

    // Подставляем значения в поле
    $(".translit-input").on("keyup change", function() {
        var transilted = translit($(this).val());
        $(".translit-output").val(transilted);
    });
});