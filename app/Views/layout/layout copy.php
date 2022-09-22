<!-- <?php
        echo view('layout/Header');
        ?>



  <?php
    echo view('layout/nav');
    echo view('layout/sidebar');
    //echo view('layout/testmenu');
    //echo $lst;

    ?>

 

  <?= $this->renderSection('content') ?>


  <?php
    echo view('layout/footer'); ?>
 -->


<?= $this->include('layout/Header') ?>
<?= $this->include('layout/nav') ?>
<?= $this->include('layout/testmenu') ?>
<?= $this->renderSection('content') ?>
<?= $this->include('layout/footer') ?>


?>