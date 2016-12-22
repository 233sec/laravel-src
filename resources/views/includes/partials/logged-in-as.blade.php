@if (session()->has("admin_user_id") && session()->has("temp_user_id"))
    <div class="alert alert-success logged-in-as no-border">
        您当前穿越成了 <span class="label label-warning">{{ access()->user()->name }}</span> 重新登录回<a href="{{ route("auth.logout-as") }}">{{ session()->get("admin_user_name") }}</a>.
    </div>
@endif