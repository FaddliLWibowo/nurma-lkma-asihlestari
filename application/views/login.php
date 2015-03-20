<div style="color:#fff" class="container">
  <div class="col-md-4 col-md-offset-4">
    <form method="POST" action="" class="form-signin">
      <h3 class="form-signin-heading">Login :: LKMA Asih Lestari</h3>
      <h5>Kecamatan Jukul Kabupaten Kulon Progo</h5>
      <hr/>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="inputusername" style="margin-top:10px" type="text" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="inputpassword" style="margin-top:10px" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
      <div class="checkbox">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <?php if(!empty($_GET['error'])):?>
      <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
    <?php endif; ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
  </div>
</div>