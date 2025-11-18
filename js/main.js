document.addEventListener('DOMContentLoaded', function() {
  FormHandler.init();
  Popup.init();
  
  const copyrightText = document.getElementById('copyrightText');
  const developerName = 'Ильин Владислав Сергеевич';
  const birthYear = 2004;
  const currentYear = new Date().getFullYear();
  
  copyrightText.textContent = `© ${developerName}, ${birthYear}-${currentYear}`;
});

