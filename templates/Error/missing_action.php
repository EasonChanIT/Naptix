<body>
    <div id="error">

        <div class="container text-center pt-32">
            <h1>We couldn't find the page you are looking for.</h1>
            <a href="<?= $this->Url->build(['controller' => 'EmployeeTasks', 'action' => 'newdashboard']) ?>" class='btn btn-primary'>Go Home</a>

        </div>

        <div class="footer pt-32">
            <p class="text-center">Copyright &copy; Naptix 2021</p>
        </div>
    </div>
</body>