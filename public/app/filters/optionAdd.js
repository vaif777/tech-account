function optionAdd(select, options) {
  select.prop('disabled', options.disabled || false);
  if (options.clear) {
    select.empty();
  }
  const opt = $('<option>', { value: options.id, text: options.title, selected: options.selected });
  select.append(opt);
}