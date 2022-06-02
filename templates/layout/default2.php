<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $this->fetch('title') ?> </title>


    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->meta('icon', $this->Url->build('/images/naptix-favicon.jpg')) ?>
    
    <?= $this->Html->css('app.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</body>