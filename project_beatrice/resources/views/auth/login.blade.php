<form id="login-form" name="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em;">
    @csrf
    <div class="form-group" id="username_div">
        <input id="username" type="text" name="username" class="form-control" placeholder="Username">
        <span class="help-block"></span>
    </div>
    <div class="form-group" id="password_div">
        <input id="password" type="password" name="password" class="form-control" placeholder="Password">
        <span class="help-block"></span>
    </div>
    <!--<div class="form-group text-center">
        <input type="checkbox" name="remember">
        <label for="remember"> {{ trans('labels.rememberMe') }}</label>
    </div> -->
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" name="login-submit" class="form-control btn btn-primary"
                    value="{{ trans('labels.login') }}"
                    onclick="event.preventDefault(); checkLogin('{{ $lang }}');">
            </div>
        </div>
    </div>
    <!--
    <div class="form-group">

        <div class="text-center">
            <a href="#" class="forgot-password">{{ trans('labels.forgotPwd') }}</a>
        </div>

    </div>
-->
</form>
