<nav class="navbar sidebar-inverse" role="navigation" id="headernav" style="background-color: #F5F5F5">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#horizontal-navbar">
            <i class="fa fa-navicon"></i>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="horizontal-navbar">
        <ul class="nav navbar-nav smart-menu">
            <li class="active"><a href="/admin/<?=$type?>/"><i class="fa fa-language"></i> <span>Статьи</span></a></li>
            <li><a href="/admin/<?=$type?>/add/"><i class="fa fa-plus"></i> <span>Добавить статью</span></a></li>
            <li><a href="/admin/<?=$type?>/settings/"><i class="fa fa-cog"></i> <span>Настройки полей</span></a></li>
            <li><a href="/admin/<?=$type?>/draganddrop/"><i class="fa fa-cog"></i> <span>Перетаскивание</span></a></li>
        </ul>
    </div>
</nav>