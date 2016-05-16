<div id="comment-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Your Comment</h4>
      </div>
      <form id="comment-eidt-form">
        <div class="modal-body">
            <div class="alert alert-danger info" style="display:none;">
                <ul></ul>
            </div>
            <div class="form-group">
              <label for="comment-content">Comment</label>
              <textarea id="comment-content" class="form-control" rows="3">{{ $comment->content }}</textarea>
              <input id="homework-id" type="hidden" class="form-control" value="{{ $comment->homeword_id }}">
              <input id="user-id" type="hidden" class="form-control" value="{{ $comment->user_id }}">
              <input id="comment-id" type="hidden" class="form-control" value="{{ $comment->id }}">
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success btn-comment-update">Save changes</button>
        </div>
      </form>
    </div>/.modal-content
  </div>/.modal-dialog
</div><!-- /.modal -->