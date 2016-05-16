/*
** Set up Ajax header for CSRF token
*/

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*
** Mark ajax
*/

$('.mark').click(function (event) {
	event.preventDefault();

    var urlMark = "/mark";
	var mark = $(this).siblings('.template').children('option:selected').text();;
	var user_id = $(this).siblings('.user_id').val();
	var homework_id = $(this).siblings('.homework_id').val();
	// $mark_span = $(this).parent().parent().parent().children('.mark-span'); also right
	var mark_span = $(this).parent().parent().siblings('.mark-span');
	// console.log($mark);
	$.ajax({
		method: 'POST',
		url: urlMark,
		data: {
			mark: mark, 
			user_id: user_id, 
			homework_id: homework_id,
			dataType: "json"
		},
		success: function(response) {
			// also right
			// console.log(response['mark']);
			// event.target.parentNode.parentNode.parentNode.childNodes[1].nextElementSibling.innerText = response['mark'];
		},
        error: function(xhr,errmsg,err) {
            console.log(xhr.status + ": " + xhr.responseText);
        }
	})
		.done(function(msg){
			// console.log(msg['mark']);
			mark_span.text(msg['mark']);
			mark_span.removeClass('hidden');
		});

});

/*
**	Comment ajax
*/

// create comment

$('.btn-comment').click(function(event){
	event.preventDefault();

	var content = $(this).siblings('.content').val();
	var user_id = $(this).siblings('.user_id').val();
	var homework_id = $(this).siblings('.homework_id').val();
	var new_comment = $(this).parent().siblings('.new-comment');
	var new_comment_content = new_comment.children('p');
	var new_comment_footer = new_comment.children('footer');
	var new_comment_user = new_comment_footer.children().first();
	var new_comment_date = new_comment_footer.children().last();
	var textarea = $(this).siblings('.content');
	var owner_area = '<div>' +
                        '<button class="btn btn-success btn-xs btn-comment-edit" value=""><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button> ' +
                        '<button class="btn btn-danger btn-xs btn-comment-delete" value=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>' + 
                	 '</div>';
    var info_error = $(this).parent().siblings('.info-error');

	$.ajax({
		method: 'POST',
		url: '/comment',
		data: {
			content: content,
			user_id: user_id,
			homework_id: homework_id,
			dataType: 'json'
		},
  		error: function(data) {

            if( data.status === 422 ) {
                var errors = data.responseJSON.content;

              	$.each(errors, function(index, value){
              		info_error.find('ul').append('<li>'+ value +'</li>');
              	});
              	info_error.slideDown();
	            info_error.fadeTo(2000, 500).slideUp(500, function(){
	               info_error.hide().find('ul').empty();
	            });  
	            
              	// console.log(errors);
          	}
        },
        success: function(response) {
        	// console.log(response);
        }
	})
		.done(function(msg){
			console.log(msg['comment'].content);

			new_comment.removeClass('hidden');
			new_comment_content.text(msg['comment'].content);
			if(msg['comment'].user_id === msg['homework'].user_id) {
				new_comment_footer.prepend('<span>( Owner )</span>');
				new_comment.addClass('owner-comment');
			}
			new_comment_user.text(msg['user'].name);
			new_comment_date.text(msg['comment'].updated_at);
			new_comment.append(owner_area);
			// clear contents of the textarea
			textarea.val('');
		});
});

// delete comment 

$('.btn-comment-delete').click(function(event){
	event.preventDefault();

	var comment_id = $(this).val();
	var comfirm = confirm("Are you sure you want to delete?");
        if(comfirm)
        {
            $.ajax({
                type: "POST",
                url: '/comment-delete' + '/' + comment_id,
                success: function (data) {
                    if(data.success == false)
                    {
                        //
                    }
                    else
                    {
                        $("#comment-" + comment_id).remove();

                        $('#info-modal').modal('show');
                        $('#info-modal').find('p').text(data.msg);
                        // console.log(data.msg);

						var fade_out = function() {
							$("#info-modal").fadeTo('slow', 0.01, function(){
								$('#info-modal').modal('hide');
							});
						}

						setTimeout(fade_out, 600);
                    }
                },
            });

            return true;
            
        }
});

// edit comment modal show

$('.btn-comment-edit').click(function(event){
	event.preventDefault();

	var id = $(this).val();

	$.get('/comment/edit/' + id, function (data) {
			$('#comment-modal').modal('show');
			$('#comment-id').val(data.data.id);
            $('#comment-content').val(data.data.content);
            $('#homework-id').val(data.data.homework_id);
            $('#user-id').val(data.data.user_id);         
        })
		.done(function(data){
			console.log(data);
			console.log(id);
		});
});

// update comment 

$('.btn-comment-update').click(function(event){
	event.preventDefault();

	var id = $('#comment-id').val();
	var urlCommentUpdate = '/comment/update/' + id;
	var info = $('#comment-eidt-form').find('.info');
	var formData = {
		id: id,
		content: $('#comment-content').val(),
		homework_id: $('#homework-id').val(),
		user_id: $('#user-id').val()
	};

	$.ajax({

        type: 'POST',
        url: urlCommentUpdate,
        data: formData,
        dataType: 'json',
        success: function (data) {
        	// console.log(data);
        	// console.log(urlCommentUpdate);

        	$('#comment-'+id).children().first().text(data.data.content);
        	$('#comment-'+id).find('#update-time').text(data.data.updated_at);

        	$('#comment-edit-form').trigger("reset");
            $('#comment-modal').modal('hide');           
        },
        error: function (data) {
        	if( data.status === 422 ) {
                var errors = data.responseJSON.content;

              	$.each(errors, function(index, value){
              		info.find('ul').append('<li>'+ value +'</li>');
              	});
              	info.slideDown();
	            info.fadeTo(2000, 500).slideUp(500, function(){
	               info.hide().find('ul').empty();
	            });              
              	// console.log(errors);
          	}
        }
    });
});

// flash message modal

$('#flash-overlay-modal').modal();

var fade_out = function() {
	$("#flash-overlay-modal").fadeTo('slow', 0.01, function(){
		$('#flash-overlay-modal').modal('hide');
	});
}

setTimeout(fade_out, 1500);

