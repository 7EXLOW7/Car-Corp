const Validation = {
  showError: function(elementId, message) {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
      errorElement.textContent = message;
      errorElement.classList.add('form__error--show');
    }
    const inputElement = document.getElementById(elementId.replace('Error', ''));
    if (inputElement) {
      inputElement.classList.add('form__input--error');
    }
  },

  hideError: function(elementId) {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
      errorElement.textContent = '';
      errorElement.classList.remove('form__error--show');
    }
    const inputElement = document.getElementById(elementId.replace('Error', ''));
    if (inputElement) {
      inputElement.classList.remove('form__input--error');
    }
  },

  validateRange: function(fromValue, toValue) {
    const from = parseInt(fromValue, 10);
    const to = parseInt(toValue, 10);

    if (isNaN(from) || isNaN(to)) {
      return { valid: false, message: 'Введите только числа от 0 до 150' };
    }

    if (from < 0 || from > 150 || to < 0 || to > 150) {
      return { valid: false, message: 'Значения должны быть от 0 до 150' };
    }

    if (to < from) {
      return { valid: false, message: 'Значение "до" не может быть меньше "от"' };
    }

    return { valid: true };
  },

  validateFullName: function(value) {
    if (!value || value.trim() === '') {
      return { valid: false, message: 'Поле обязательно для заполнения' };
    }

    const words = value.trim().split(/\s+/);
    
    if (words.length !== 3) {
      return { valid: false, message: 'Введите ФИО: три слова через пробел' };
    }

    for (let i = 0; i < words.length; i++) {
      if (words[i].length < 2) {
        return { valid: false, message: 'Каждое слово должно содержать минимум 2 символа' };
      }
      if (/\d/.test(words[i])) {
        return { valid: false, message: 'Нельзя вводить цифры' };
      }
    }

    return { valid: true };
  },

  validateAge: function(value) {
    if (!value || value.trim() === '') {
      return { valid: false, message: 'Поле обязательно для заполнения' };
    }

    if (!/^\d+$/.test(value)) {
      return { valid: false, message: 'Введите только цифры' };
    }

    return { valid: true };
  },

  validateSelect: function(selectedValue) {
    if (!selectedValue || selectedValue === 'Option') {
      return { valid: false, message: 'Необходимо выбрать значение' };
    }
    return { valid: true };
  },

  validateRadio: function(selectedValue) {
    if (!selectedValue) {
      return { valid: false, message: 'Необходимо выбрать значение' };
    }
    return { valid: true };
  },

  validateCheckbox: function(checked) {
    if (!checked) {
      return { valid: false, message: 'Необходимо отметить обязательный checkbox' };
    }
    return { valid: true };
  }
};

