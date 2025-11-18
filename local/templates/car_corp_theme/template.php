<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовое задание");

require_once($_SERVER["DOCUMENT_ROOT"]."/local/components/car_corp/form_handler.php");
?>

<section class="hero">
  <div class="hero__container">
    <div class="hero__content">
      <h1 class="hero__title">Заголовок h1</h1>
      <p class="hero__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
  <div class="hero__image-wrapper">
    <img src="<?=SITE_TEMPLATE_PATH?>/images/hero-image.png" alt="Hero image" class="hero__image">
  </div>
</section>

<div class="page__container">
  <h2 class="page__heading">Заголовок h2</h2>

  <form class="form" id="testForm" method="POST" action="<?=POST_FORM_ACTION_URI?>">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="FORM_SUBMIT" value="Y">

    <div class="form__field">
      <label class="form__label" for="rangeFrom">Выберите диапазон</label>
      <div class="form__range">
        <div class="form__range-inputs">
          <input type="text" class="form__input form__input--range" id="rangeFrom" name="RANGE_FROM" placeholder="от 0" value="0">
          <input type="text" class="form__input form__input--range" id="rangeTo" name="RANGE_TO" placeholder="до 100" value="100">
        </div>
        <div class="form__range-slider">
          <div class="form__range-track"></div>
          <div class="form__range-track-active"></div>
          <input type="range" class="form__range-input" id="rangeSliderFrom" min="0" max="150" value="0">
          <input type="range" class="form__range-input" id="rangeSliderTo" min="0" max="150" value="100">
        </div>
      </div>
      <span class="form__error" id="rangeError"></span>
    </div>

    <div class="form__row">
      <div class="form__column form__column--left">
        <div class="form__field">
          <label class="form__label" for="customSelect">Выберите select</label>
          <div class="form__select" id="customSelect">
            <div class="form__select-selected" id="selectSelected">Option</div>
            <div class="form__select-list" id="selectList">
              <div class="form__select-option" data-value="vite">Vite</div>
              <div class="form__select-option" data-value="webpack">Webpack</div>
              <div class="form__select-option" data-value="gulp">Gulp</div>
            </div>
          </div>
          <input type="hidden" name="SELECT_VALUE" id="selectValue" value="">
          <span class="form__error" id="selectError"></span>
        </div>
      </div>

      <div class="form__column form__column--right">
        <div class="form__field">
          <label class="form__label">Выберите radio</label>
          <div class="form__radio-group">
            <label class="form__radio">
              <input type="radio" name="RADIO_OPTION" value="javascript" class="form__radio-input">
              <span class="form__radio-label">JavaScript</span>
            </label>
            <label class="form__radio">
              <input type="radio" name="RADIO_OPTION" value="php" class="form__radio-input">
              <span class="form__radio-label">PHP</span>
            </label>
            <label class="form__radio">
              <input type="radio" name="RADIO_OPTION" value="csharp" class="form__radio-input">
              <span class="form__radio-label">С#</span>
            </label>
          </div>
          <span class="form__error" id="radioError"></span>
        </div>
      </div>
    </div>

    <div class="form__row">
      <div class="form__column form__column--left">
        <div class="form__field">
          <label class="form__label" for="fullName">Введите ФИО</label>
          <input type="text" class="form__input" id="fullName" name="FULL_NAME" placeholder="Placeholder">
          <span class="form__error" id="fullNameError"></span>
        </div>
      </div>

      <div class="form__column form__column--right">
        <div class="form__field">
          <label class="form__label" for="age">Введите возраст в цифрах</label>
          <input type="text" class="form__input" id="age" name="AGE" placeholder="Placeholder">
          <span class="form__error" id="ageError"></span>
        </div>
      </div>
    </div>

    <div class="form__field form__field--checkboxes">
      <label class="form__checkbox">
        <input type="checkbox" class="form__checkbox-input" id="requiredCheckbox" name="REQUIRED_CHECKBOX" value="Y">
        <span class="form__checkbox-label">Обязательный checkbox</span>
      </label>
      <label class="form__checkbox">
        <input type="checkbox" class="form__checkbox-input" id="optionalCheckbox" name="OPTIONAL_CHECKBOX" value="Y">
        <span class="form__checkbox-label">Необязательный checkbox</span>
      </label>
      <span class="form__error" id="checkboxError"></span>
    </div>

    <button type="submit" class="form__button">Отправить</button>
  </form>

  <h3 class="page__subheading">Заголовок h3</h3>
  <p class="page__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

  <div class="copyright">
    <span class="copyright__text" id="copyrightText"></span>
  </div>
</div>

<div class="popup" id="resultPopup">
  <div class="popup__overlay"></div>
  <div class="popup__content">
    <h3 class="popup__title">Результат отправки:</h3>
    <div class="popup__result" id="popupResult"></div>
  </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

