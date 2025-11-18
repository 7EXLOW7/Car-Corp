const FormHandler = {
  init: function() {
    this.initRangeSlider();
    this.initCustomSelect();
    this.initRadioButtons();
    this.initFormSubmit();
  },

  initRangeSlider: function() {
    const rangeFromInput = document.getElementById('rangeFrom');
    const rangeToInput = document.getElementById('rangeTo');
    const rangeSliderFrom = document.getElementById('rangeSliderFrom');
    const rangeSliderTo = document.getElementById('rangeSliderTo');

    const updateFromValue = () => {
      let value = parseInt(rangeSliderFrom.value, 10);
      const toValue = parseInt(rangeSliderTo.value, 10);
      if (value >= toValue) {
        value = toValue - 1;
        if (value < 0) value = 0;
        rangeSliderFrom.value = value;
      }
      rangeFromInput.value = value;
      this.updateRangeTrack();
      Validation.hideError('rangeError');
    };

    const updateToValue = () => {
      let value = parseInt(rangeSliderTo.value, 10);
      const fromValue = parseInt(rangeSliderFrom.value, 10);
      if (value <= fromValue) {
        value = fromValue + 1;
        if (value > 150) value = 150;
        rangeSliderTo.value = value;
      }
      rangeToInput.value = value;
      this.updateRangeTrack();
      Validation.hideError('rangeError');
    };

    const updateFromSlider = () => {
      let value = parseInt(rangeFromInput.value, 10);
      if (isNaN(value) || value < 0) value = 0;
      if (value > 150) value = 150;
      const toValue = parseInt(rangeSliderTo.value, 10);
      if (value >= toValue) {
        value = toValue - 1;
        if (value < 0) value = 0;
      }
      rangeFromInput.value = value;
      rangeSliderFrom.value = value;
      this.updateRangeTrack();
      Validation.hideError('rangeError');
    };

    const updateToSlider = () => {
      let value = parseInt(rangeToInput.value, 10);
      if (isNaN(value) || value < 0) value = 0;
      if (value > 150) value = 150;
      const fromValue = parseInt(rangeSliderFrom.value, 10);
      if (value <= fromValue) {
        value = fromValue + 1;
        if (value > 150) value = 150;
      }
      rangeToInput.value = value;
      rangeSliderTo.value = value;
      this.updateRangeTrack();
      Validation.hideError('rangeError');
    };

    rangeSliderFrom.addEventListener('input', updateFromValue);
    rangeSliderTo.addEventListener('input', updateToValue);
    rangeFromInput.addEventListener('input', updateFromSlider);
    rangeToInput.addEventListener('input', updateToSlider);
    rangeFromInput.addEventListener('blur', updateFromSlider);
    rangeToInput.addEventListener('blur', updateToSlider);

    this.updateRangeTrack();
  },

  updateRangeTrack: function() {
    const rangeSliderFrom = document.getElementById('rangeSliderFrom');
    const rangeSliderTo = document.getElementById('rangeSliderTo');
    const trackActive = document.querySelector('.form__range-track-active');
    
    if (trackActive && rangeSliderFrom && rangeSliderTo) {
      const from = parseInt(rangeSliderFrom.value, 10);
      const to = parseInt(rangeSliderTo.value, 10);
      const min = 0;
      const max = 150;
      
      const fromPercent = ((from - min) / (max - min)) * 100;
      const toPercent = ((to - min) / (max - min)) * 100;
      
      trackActive.style.left = fromPercent + '%';
      trackActive.style.width = (toPercent - fromPercent) + '%';
    }
  },

  initCustomSelect: function() {
    const select = document.getElementById('customSelect');
    const selected = document.getElementById('selectSelected');
    const list = document.getElementById('selectList');
    const options = list.querySelectorAll('.form__select-option');

    let selectedValue = 'Option';

    const toggleSelect = () => {
      select.classList.toggle('form__select--open');
    };

    const selectOption = (option) => {
      selectedValue = option.dataset.value;
      selected.textContent = option.textContent;
      select.classList.remove('form__select--open');
      
      options.forEach(opt => opt.classList.remove('form__select-option--selected'));
      option.classList.add('form__select-option--selected');
      
      Validation.hideError('selectError');
    };

    selected.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleSelect();
    });

    options.forEach(option => {
      option.addEventListener('click', () => {
        selectOption(option);
      });
    });

    document.addEventListener('click', (e) => {
      if (!select.contains(e.target)) {
        select.classList.remove('form__select--open');
      }
    });

    this.getSelectValue = () => selectedValue;
  },

  initRadioButtons: function() {
    const radioInputs = document.querySelectorAll('.form__radio-input');
    const radioLabels = document.querySelectorAll('.form__radio');

    radioInputs.forEach((input, index) => {
      input.addEventListener('change', () => {
        radioLabels.forEach(label => {
          label.classList.remove('form__radio--checked');
        });
        radioLabels[index].classList.add('form__radio--checked');
        Validation.hideError('radioError');
      });
    });
  },

  initFormSubmit: function() {
    const form = document.getElementById('testForm');
    
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      
      const rangeFrom = document.getElementById('rangeFrom').value;
      const rangeTo = document.getElementById('rangeTo').value;
      const fullName = document.getElementById('fullName').value;
      const age = document.getElementById('age').value;
      const selectValue = this.getSelectValue();
      const radioValue = document.querySelector('input[name="radioOption"]:checked')?.value;
      const requiredCheckbox = document.getElementById('requiredCheckbox').checked;
      const optionalCheckbox = document.getElementById('optionalCheckbox').checked;

      let isValid = true;

      const rangeValidation = Validation.validateRange(rangeFrom, rangeTo);
      if (!rangeValidation.valid) {
        Validation.showError('rangeError', rangeValidation.message);
        isValid = false;
      } else {
        Validation.hideError('rangeError');
      }

      const selectValidation = Validation.validateSelect(selectValue);
      if (!selectValidation.valid) {
        Validation.showError('selectError', selectValidation.message);
        isValid = false;
      } else {
        Validation.hideError('selectError');
      }

      const radioValidation = Validation.validateRadio(radioValue);
      if (!radioValidation.valid) {
        Validation.showError('radioError', radioValidation.message);
        isValid = false;
      } else {
        Validation.hideError('radioError');
      }

      const fullNameValidation = Validation.validateFullName(fullName);
      if (!fullNameValidation.valid) {
        Validation.showError('fullNameError', fullNameValidation.message);
        isValid = false;
      } else {
        Validation.hideError('fullNameError');
      }

      const ageValidation = Validation.validateAge(age);
      if (!ageValidation.valid) {
        Validation.showError('ageError', ageValidation.message);
        isValid = false;
      } else {
        Validation.hideError('ageError');
      }

      const checkboxValidation = Validation.validateCheckbox(requiredCheckbox);
      if (!checkboxValidation.valid) {
        Validation.showError('checkboxError', checkboxValidation.message);
        isValid = false;
      } else {
        Validation.hideError('checkboxError');
      }

      if (isValid) {
        const result = {
          range: `от ${rangeFrom} до ${rangeTo}`,
          select: selectValue,
          radio: radioValue,
          fullName: fullName,
          age: age,
          checkboxes: []
        };

        if (requiredCheckbox) {
          result.checkboxes.push('Обязательный checkbox');
        }
        if (optionalCheckbox) {
          result.checkboxes.push('Необязательный checkbox');
        }

        Popup.show(result);
      }
    });
  }
};

