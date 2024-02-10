let inputSettings = document.querySelectorAll("input#settings");

  for (let i = 0; i < inputSettings.length; i++) {

    $(document).ready(function () {
      $(inputSettings[i]).on('change', (function () {

        $.ajax({
          method: "GET",
          url: route('setting'),
          data: {
            name: inputSettings[i].name,
            result: inputSettings[i].checked ? 1 : 0
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
          .done(function (floors) {

            let divSuccess = document.getElementById('success');

            if (divSuccess.getElementsByTagName("div")[0]) {
              divSuccess.removeChild(divSuccess.getElementsByTagName("div")[0]);
            }


            if (inputSettings[i].checked) {
              divSuccess.insertAdjacentHTML('beforeend', `<div class="alert alert-success"> Надстройка "${inputSettings[i].dataset.title}" активирована.</div>`);
            } else {
              divSuccess.insertAdjacentHTML('beforeend', `<div class="alert alert-success"> Надстройка "${inputSettings[i].dataset.title}" деактивирована.</div>`);
            }


          });
      }))
    })
  }