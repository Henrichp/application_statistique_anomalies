<div class="navbar navbar-main navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-bars"></i></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Afficher le menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand navbar-brand-primary">Sans Nom</a>
        </div>
        <div class="collapse navbar-collapse" id="main-nav">
            <form class="navbar-form navbar-left hidden-xs" role="search" action="recherche" method="post">
                <div class="search-2">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-w-150" name="cote" placeholder="Trouver une cote">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-user">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Pascal Henrichon<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/profil') }}">Profil</a></li>
                        <li><a href="{{ url('/notifications') }}">Notifications</a></li>
                        <li><a href="{{ url('/deconnexion') }}">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>