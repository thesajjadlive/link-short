<div class="list-group">
    <a href="{{ route('app.setting.general.index') }}" class="list-group-item {{ Request::is('app/setting/general')?'active':''}}">General</a>
    <a href="{{ route('app.setting.appearance.index') }}" class="list-group-item {{ Request::is('app/setting/appearance')?'active':''}}">Appearance</a>
    <a href="{{ route('app.setting.privacy.index') }}" class="list-group-item {{ Request::is('app/setting/privacy')?'active':''}}">Privacy Policy</a>
    <a href="{{ route('app.setting.term.index') }}" class="list-group-item {{ Request::is('app/setting/term')?'active':''}}">Terms of Use</a>
    <a href="{{ route('app.setting.about.index') }}" class="list-group-item {{ Request::is('app/setting/about')?'active':''}}">About</a>
</div>
