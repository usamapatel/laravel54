<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!! Form::open(['method' => 'delete', 'class' => 'js-delete-modal-form']) !!}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title bold uppercase font-dark" id="myModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body js-delete-confirmation-msg">
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="uie-btn uie-btn-primary ">Yes</button>
          <button type="button" class="uie-btn uie-secondary-btn" data-dismiss="modal">Cancel</button>
        </div>
        <input name="_method" value="DELETE" type="hidden" />
      {!! Form::close() !!}
    </div>
  </div>
</div>