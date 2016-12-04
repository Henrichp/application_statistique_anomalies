<div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
    <div data-scrollable>
        <ul class="sidebar-menu">
            <li class="category">Navigation</li>
            <li {{(Request::path()=="cotes_graphiques") ? 'class=active' : ''}}><a href="/cotes_graphiques"><i class="icon-graph-up-2"></i> <span>Graphique</span></a></li>
            <!--<li {{(substr( Request::path(), 0, 6 )==="profil") ? 'class=active' : ''}}><a href="/anomalies"><i class="icon-user-1"></i> <span>Anomalies</span></a></li>-->
        <!--<li {{(Request::path()=="anomalies") ? 'class=active' : ''}}><a href="/anomalies"><i class="icon-alert"></i> <span>Anomalies</span></a></li>-->
        </ul>
    </div>
</div>