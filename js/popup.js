const Popup = {
  init: function() {
    const popup = document.getElementById('resultPopup');
    const overlay = popup.querySelector('.popup__overlay');

    overlay.addEventListener('click', () => {
      this.hide();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && popup.classList.contains('popup--show')) {
        this.hide();
      }
    });
  },

  show: function(data) {
    const popup = document.getElementById('resultPopup');
    const resultElement = document.getElementById('popupResult');

    let resultText = `Диапазон: ${data.range}\n`;
    resultText += `Select: ${data.select}\n`;
    resultText += `Radio: ${data.radio}\n`;
    resultText += `ФИО: ${data.fullName}\n`;
    resultText += `Возраст: ${data.age}\n`;
    
    if (data.checkboxes.length > 0) {
      resultText += `Выбранные checkbox: ${data.checkboxes.join(', ')}`;
    } else {
      resultText += `Выбранные checkbox: нет`;
    }

    resultElement.textContent = resultText;
    popup.classList.add('popup--show');
    document.body.style.overflow = 'hidden';
  },

  hide: function() {
    const popup = document.getElementById('resultPopup');
    popup.classList.remove('popup--show');
    document.body.style.overflow = '';
  }
};

