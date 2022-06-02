<html lang="en">

<head>
    <?= $this->Html->charset() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $this->fetch('title') ?> </title>

     <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->meta('icon', $this->Url->build('/images/naptix-favicon.jpg')) ?>

    <?= $this->Html->css('app.css') ?>

</head>

<body>
    <div id="error">

        <div class="container text-center pt-32">
     
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>

        <div class="footer pt-32">
            <p class="text-center">Copyright &copy; Naptix 2021</p>
        </div>
    </div>
</body>

</html>