<?php

use backend\widgets\Menu;
use common\models\User;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Departament</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= User::findOne(Yii::$app->user->id)->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            $items = [
                [
                    'label' => 'Qo\'shimcha ma`lumotlar',
                    'icon' => 'tachometer-alt',
//                        'badge' => '<span class="right badge badge-info">2</span>',
                    'items' => [
                        ['label' => 'Muhsulot normativ hujjatlari', 'url' => ['nd/index'], 'iconStyle' => 'far'],
                        ['label' => 'Normativ hujjat toifalari', 'url' => ['nd-type/index'], 'iconStyle' => 'far'],
                        ['label' => 'Dastur turi', 'url' => ['profilactic/program-type/index'], 'iconStyle' => 'far'],
                        ['label' => 'Soha nomi', 'url' => ['control/product-type/index'], 'iconStyle' => 'far'],
                    ]
                ],
                ['label' => 'Foydalanuvchilar', 'url' => ['user/index'], 'icon' => 'fa fa-users'],
                ['label' => 'Davlat nazorati', 'url' => ['control/control/index'], 'icon' => 'th'],
                ['label' => 'Profilaktika', 'url' => ['profilactic/profilactic/index'], 'icon' => 'fa fa-building'],
                ['label' => 'Nazorat xaridi', 'url' => ['shopping/shopping/index'], 'icon' => 'fa fa-building'],
                ['label' => 'Berilgan ko\'rsatma va ogohlantirishlar', 'url' => ['caution/caution/index'], 'icon' => 'fa fa-building'],
                ['label' => 'Davlatlar', 'url' => ['country/index'], 'icon' => 'fas fa-globe'],
            ];
            $items = Yii::$app->user->identity->role == 'admin' ? $items : [
                ['label' => 'Davlat nazorati', 'url' => ['control/control/index'], 'icon' => 'th'],
                ['label' => 'Profilaktika', 'url' => ['profilactic/profilactic/index'], 'icon' => 'fa fa-building'],
                ['label' => 'Nazorat xaridi', 'url' => ['shopping/shopping/index'], 'icon' => 'fa fa-building'],
                ['label' => 'Berilgan ko\'rsatma va ogohlantirishlar', 'url' => ['caution/caution/index'], 'icon' => 'fa fa-building'],
            ];
            echo Menu::widget([
                'items' => $items,
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>