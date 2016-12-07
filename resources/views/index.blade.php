<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="fr">

  @include('layout._head')

<body class="background-image">

  <div id="content">
    <div class="container-fluid">
      <div class="table-pricing-3">
        <ul class="list-unstyled">
          <span class="col-md-3" ></span >
          <li class="col-md-6">
            <div class="innerAll">
              <h1>Application d'affichage statistique d'anomalies</h1>
              <div class="pricing-features">
                <ul>
                  <li>Une application d'affichage des cotes de </li>
                  <li>la bourse et de leurs anomalies</li>
                </ul>
              </div>
              <div class="pricing-footer">
                <a href="{{ url('/register') }}" role="button" class="btn btn-success"><i class="icon-user-1"></i> Inscription</a>
                <a href="{{ url('/login') }}" role="button" class="btn btn-info"><i class="fa fa-unlock-alt"></i> Connexion</a>
              </div>
            </div>
          </li>
          <span class="col-md-3"></span >
         </ul>
      </div>
    </div>
  </div>

  @include('layout._footer')
</body>
</html>