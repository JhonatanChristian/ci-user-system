<?php $this->load->view('app/login/header'); ?>

<div class="container-fluid mt-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-4">
      <div class="card p-4 rounded-0">
        <div class="row">
          <div class="col-12">
            <h4>Login</h4>
            <p>Faça login para entrar no sistema</p>
          </div>
        </div>
        <?php if($login_error === 'true'): ?>
          <div class="row">
            <div class="col-12">
              <div class="p-3 mt-1 mb-3 bg-danger text-white rounded">
                Usuário ou senha incorretos.
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="row">
          <div class="col-12">
            <form name="" method="post" action="<?php echo base_url() . 'request-login'; ?>" id="">
              <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" data-validation="required" placeholder="">
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" class="form-control" id="password" data-validation="required" placeholder="">
              </div>
              <button type="submit" class="btn btn-primary mt-2">Entrar</button>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <a href="#" title="Recuperar senha." class="mt-4 d-inline-block">Esqueceu a senha?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('app/login/footer'); ?>
