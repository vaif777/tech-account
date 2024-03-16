function optionAdd(select, options) {
  select.prop('disabled', options.disabled || false);
  if (options.clear) {
    select.empty();
  }
  const opt = $('<option>', { value: options.id, text: options.title, selected: options.selected });
  select.append(opt);

  if ($.isEmptyObject(options.data))  return;

    for (const [key, element] of Object.entries(options.data)) {

      opt.data(key, element);
    }
}