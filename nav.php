<?php function getNavbar($isInCms, $hub, $user)
{
  $isUserProprietary = false;
  if ($user)
    if ($user->getHub())
      if ($user->getHub()->id == $hub->id) $isUserProprietary = true;
?>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Share this Hub</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" value="" id="nav-link">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="navigator.clipboard.writeText(getHubURL())">Copy to clipboard</button>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-light bg-light">
    <div class="nav ">
      <button class="navbar-toggler navaff" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon "></span>
      </button>
      <div class="navaff menutaille"><?= $hub->name ?><br>
        <div class="size"><?= $hub->desc ?></div>
      </div>

      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <div class="d-flex align-items-center justify-content-center">
            <div class="menutaille">ShareHub</div>
          </div>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Share this hub</a>
            </li>
            <li class="nav-item">
              <?php if ($isUserProprietary && !$isInCms) { ?>
              <a class="nav-link" href="cms">Edit this hub</a>
              <?php } if (!$isUserProprietary && !$isInCms) { ?>
                <a class="nav-link" href="cms">Edit your hub</a>
              <?php } if ($isInCms) { ?>
                <a class="nav-link" href="#" onclick="window.location.href=getHubURL()">Go to this hub</a>
              <?php } if ($user) { ?>
                <a class="nav-link" href="login?s=lg">Logout</a>
              <?php } else { ?> 
                <a class="nav-link" href="login?s=sg">Make your own hub</a>
                <a class="nav-link" href="login?s=lg">Login</a> 
                <?php } ?>
            </li>
          </ul>
          <div class="copyright">@Copyright ShareHub 2022</div>
        </div>
      </div>
    </div>
  </nav>
  <script>
    document.querySelector("#nav-link").value = getHubURL();
    
    function getHubURL() {
      return document.location.protocol + "//" + document.location.host + `/sharehub/?h=<?= $hub->id ?>`;
    }
  </script>
<?php } ?>