<div class="form-group{{ $has_error ? ' has-error' : '' }}">
    <label for="{{ $id }}">{{ __($label) }}</label>
    <input type="email" class="form-control" name="{{ $name }}" id="{{ $id }}" value="{{ $old or $value }}" placeholder="{{ $placeholder }}" />
    @include('crud::fields.partials.help')
    @include('crud::fields.partials.errors')
</div>
