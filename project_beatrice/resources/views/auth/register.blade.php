<form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em;">
    @csrf
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" value="">
    </div>
    <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="{{ trans('labels.emailAddr') }}" value="">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" name="confirm-password" class="form-control"
            placeholder="{{ trans('labels.confirmPwd') }}">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" name="register-submit" class="form-control btn btn-primary"
                    value="{{ trans('labels.registerNow') }}">
            </div>
        </div>
    </div>
</form>
