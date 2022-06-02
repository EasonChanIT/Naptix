<head>
    <title>Naptix Login </title>
</head>


<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <?php

                                echo $this->Html->image("/images/naptix-logo.png", [
                                    "alt" => "Naptix", "height"=>"48", "class" => "mb-4"]
                                );

                                ?>
                                <h3>Sign In</h3>
                                <p>Please sign in to continue to Naptix.</p>
                            </div>

                            <?= $this->Flash->render() ?>
                            <?= $this->Form->create() ?>
                            <fieldset>

                                <div class="form-group position-relative has-icon-left">
                                    <div class="position-relative">
                                     <?php
                                        echo $this->Form->control('username', ['class'=>'form-control', 'placeholder'=>'Enter username', 'label' => 'Username','id'=>'username','required'=>true]);
                                    ?>
                                    <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                    </div>

                                    </div>


                                </div>

                                <div class="form-group position-relative has-icon-left">

                                    <div class="position-relative">
                                     <?php
                                        echo $this->Form->control('password', ['class'=>'form-control', 'placeholder'=>'Enter password', 'label' => 'Password','id'=>'password','required'=>true]);
                                    ?>
                                    <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                    </div>

                                    </div>


                                </div>

                               

                                <div style="font-size 30px; text-align: left; color: blue;"  data-bs-toggle="modal"
                                        data-bs-target="#default"><a href="#">  
                                     Forgot your Password?</a>

                                </div>

                              

                                    <!--Basic Modal -->
                                    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel1">Forgot your password?</h5>
                                                    <button type="button" class="close rounded-pill"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        If you have forgotten your password, you will need to contact the admin to reset your password.

                                                        

                                                        You can contact the admin via email on frank@naptix.com.au.

                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                   
                                                    <button type="button" class="btn btn-primary ml-1"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </fieldset>

                                 <div class="clearfix">
                                    

                                       <?php
                                            echo $this->Form->button('Login', ['type' => 'submit', 'class'=>'btn btn-primary float-end']);
                                        ?>
                                </div>

                              
                                <?= $this->Form->end() ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?= $this->Html->script('/js/feather-icons/feather.min.js') ?>
    <?= $this->Html->script('/js/app.js') ?>

    <?= $this->Html->script('/js/main.js') ?>

</body>




</div>
