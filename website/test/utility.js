// utils.js

/**
 * Clears a select element and adds a default placeholder option
 * @param {HTMLSelectElement} selectElement - the select element to reset
 * @param {string} placeholderText - the text to show as the default option
 */
export function resetSelect(selectElement, placeholderText = "Сонгох") {
  // Clear all existing options
  selectElement.innerHTML = "";

  // Create default option
  const defaultOption = document.createElement("option");
  defaultOption.value = "";
  defaultOption.text = placeholderText;
  defaultOption.disabled = true;
  defaultOption.selected = true;

  // Append to select
  selectElement.appendChild(defaultOption);
}
