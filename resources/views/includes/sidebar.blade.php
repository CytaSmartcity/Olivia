<div class="sidebar-wrapper">
    <ul class="nav">

        <li @if (\Route::current()->getName()==='dashboard') class="active" @endif>
            <a href="/">
                <i class="now-ui-icons design_app"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <!-- <li>
            <a href="../examples/icons.html">
                <i class="now-ui-icons education_atom"></i>
                <p>Icons</p>
            </a>
        </li>-->
        <li @if (\Route::current()->getName()==='map') class="active" @endif>
            <a href="/map">
                <i class="now-ui-icons location_map-big"></i>
                <p>Maps</p>
            </a>
        </li>
        <li @if (\Route::current()->getName()==='fines.index') class="active" @endif>
            <a href="/fines">
                <i class="now-ui-icons location_map-big"></i>
                <p>Fines</p>
            </a>
        </li>
        <!-- <li>
            <a href="../examples/notifications.html">
                <i class="now-ui-icons ui-1_bell-53"></i>
                <p>Notifications</p>
            </a>
        </li>
        <li>
            <a href="../examples/user.html">
                <i class="now-ui-icons users_single-02"></i>
                <p>User Profile</p>
            </a>
        </li>  -->
        <li @if (\Route::current()->getName()==='complains.index') class="active" @endif>
            <a href="/complains">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p>Complains</p>
            </a>
        </li>
        <!-- <li>
            <a href="../examples/typography.html">
                <i class="now-ui-icons text_caps-small"></i>
                <p>Typography</p>
            </a>
        </li>
        <li class="active-pro">
            <a href="../examples/upgrade.html">
                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                <p>Upgrade to PRO</p>
            </a>
        </li> -->
    </ul>
</div>
