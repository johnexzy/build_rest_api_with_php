$(document).ready(function() {
  $('#handleSubmit').on('click', function() {
    let key = $('#commentKey').val();
    let name = $('#nameController').val();
    let comment = $('#commentController').val();
    let res;
    let mydata = {
      name: name,
      comment: comment,
      comment_key: key
    }
    $.ajax({
        url: 'http://127.0.0.1:8090/api/comment',
        type: 'POST',
        data: JSON.stringify(mydata),
        dataType: 'json',
        crossDomain: true,
        headers: { 'Content-Type': 'application/json' }
      })
      .done(function(data) {
        data.forEach(elem => {
          console.log(elem)
        });

      })
      .fail(function(err) {
        // console.log(err);
        alert("fail");
      })
  })
})