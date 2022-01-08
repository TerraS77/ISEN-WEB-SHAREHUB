<?php function getNavbar($isInCms, $hub, $user){ ?>
    <nav class="navbar navbar-light bg-light">
      <div class="nav ">
        <button class="navbar-toggler navaff" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon "></span>
        </button><div class="navaff menutaille"><?= $hub->name ?></div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <div class="d-flex align-items-center justify-content-center"> 
          <div class="menutaille"><?= $hub->name ?></div></div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" onclick="copier()">Share this hub</a>
              </li>
              <li class="nav-item">
                  </li>
                  <li class="nav-item">
                      <?php
                        if($user){
                            ?><a class="nav-link" href="login?s=lg">Logout</a>
                           <?php
                        }else {?> <a class="nav-link" href="login?s=sg">Make your own hub</a>
                         <a class="nav-link" href="login?s=lg">Login</a> <?php
                    }
                  ?>
              </li>
            </ul>
            <div class="copyright">@Copyright ShareHub 2022</div>
          </div>
        </div>
      </div>
    </nav>
<?php } ?>


<script>  

function copier(){

    Clipboard.writeText(document.location.href+`?h=${hub.id}`);
}

</script>