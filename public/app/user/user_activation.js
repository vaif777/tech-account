let buttonsConfirmation = document.querySelectorAll("button.btn.btn-secondary.btn-sm.float-left.mr-1");

  for (let i = 0; i <= buttonsConfirmation.length; i++) {

    $(document).ready(function () {
      $(buttonsConfirmation[i]).on('click', (function () {

        $.ajax({
          method: "GET",
          url: route('user.index'),
          data: {
            name: buttonsConfirmation[i].name,
            user_id: buttonsConfirmation[i].dataset.id,
            result: buttonsConfirmation[i].value
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

            divSuccess.insertAdjacentHTML('beforeend', `<div class="alert alert-success">Пользователь ${buttonsConfirmation[i].dataset.user} потвержден.</div>`);
            buttonsConfirmation[i].remove();

          });
      }))

    })

  }
