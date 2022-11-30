function initSurveyForm(form, submitButton, translations) {
  function isValueNotEmpty(field) {
    return field.value.trim().length > 0;
  }

  function hasAtLeastOneInputChecked(field) {
    const inputs = field.querySelectorAll("input");
    const selectedInputs = [].filter.call(inputs, function (option) {
      return option.checked;
    });
    return selectedInputs.length > 0;
  }

  function createValidator(isValid, message) {
    return function (field) {
      if (!isValid(field)) {
        return message;
      }
    };
  }

  const validators = {
    "short-text": createValidator(
      isValueNotEmpty,
      translations.shortTextRequired
    ),
    "long-text": createValidator(
      isValueNotEmpty,
      translations.longTextRequired
    ),
    dropdown: createValidator(isValueNotEmpty, translations.dropdownRequired),
    "single-choice": createValidator(
      hasAtLeastOneInputChecked,
      translations.singleChoiceRequired
    ),
    "multiple-choice": createValidator(
      hasAtLeastOneInputChecked,
      translations.multipleChoiceRequired
    ),
  };

  function setSubmitting(active) {
    if (active) {
      submitButton.classList.add("button--loading");
      submitButton.setAttribute("disabled", "disabled");
    } else {
      submitButton.classList.remove("button--loading");
      submitButton.removeAttribute("disabled");
    }
  }

  function setError(field, message) {
    const errorSpan = field.parentElement.querySelector(
      ".survey__error-message"
    );
    if (!!message) {
      errorSpan.classList.add("survey__error-message--active");
      errorSpan.textContent = message;
    } else {
      errorSpan.textContent = "";
      errorSpan.classList.remove("survey__error-message--active");
    }
  }

  form.addEventListener("submit", function (e) {
    setSubmitting(true);
    let hasErrors = false;

    form.querySelectorAll("[data-type]").forEach(function (field) {
      if (typeof field.dataset.required === "undefined") {
        return;
      }

      const error = validators[field.dataset.type](field);
      if (typeof error !== "undefined") {
        setError(field, error);
        hasErrors = true;
        return;
      }

      setError(field);
    });

    if (hasErrors) {
      e.preventDefault();
      setSubmitting(false);
    }
  });
}
