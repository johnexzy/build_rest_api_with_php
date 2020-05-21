$(document).ready(function() {
  $('#handleSubmit').on('click', function() {
    let key = $('#commentKey').val();
    let name = $('#nameController').val();
    let comment = $('#commentController').val();
    if (comment == "") {
      return false;
    }
    if (name == "") {
      name = "Anonymous"
    }
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
        var comments = '';
        $(".comment-ui").append(
            '<li class="comment-li card">' +
            '<div>' +
            '<figure class="comment-avatar">' +
            '<img src="../../assets/img/avatar.png" alt="">' +
            '</figure>' +
            '<address>By <a href="#">' + data[data.length - 1]['name'] + '</a>' +
            '</address>' +
            '<time class="comment-time"><i class="fa fa-clock"></i> Just Now </time>' +
            '<div class="comment-content">' +
            data[data.length - 1]['comment'] +
            '</div>' +
            '</div>' +
            '</li>')
          // data.forEach(elem => {
          //   comments +=
          //     '<li class="comment-li card">' +
          //     '<div>' +
          //     '<figure class="comment-avatar">' +
          //     '<img src="../../assets/img/avatar.png" alt="">' +
          //     '</figure>' +
          //     '<address>By <a href="#">' + elem['name'] + '</a>' +
          //     '</address>' +
          //     '<time class="comment-time">' + elem['created_at'] + ' </time>' +
          //     '<div class="comment-content">' +
          //     elem['comment'] +
          //     '</div>' +
          //     '</div>' +
          //     '</li>'
          // });
          // $(".comment-ui").html(comments);

        $('#commentController').val("")
        $('#nameController').attr("disabled", "");
        $('body,html').animate({
          scrollTop: 2000
        }, 1000);
      })
      .fail(function(err) {
        // console.log(err);
        alert("failed to add Comment");
      })
  })
})