<h3>
    <a href="<?php echo $_SESSION['home'] ?>admin" title="Inicio">Inicio</a> <span>| Novas</span>
</h3>
<div class="row">
    <!-- novo -->
    <article class="col s12 l6">
        <div class="card horizontal admin">
            <div class="card-stacked">
                <div class="card-content">
                    <i class="grey-text material-icons medium">image</i>
                    <h4 class="grey-text">
                        nova publicación
                    </h4><br><br>
                </div>
                <div class="card-action">
                    <a href="<?php echo $_SESSION['home']."admin/novas/crear" ?>" title="Engadir outra nova">
                        <i class="material-icons">add_circle</i>
                    </a>
                </div>
            </div>
        </div>
    </article>
    <?php foreach ($datos as $row){ ?>
        <article class="col s12 l6">
            <div class="card horizontal  sticky-action admin">
                <div class="card-stacked">
                    <?php if ($row->imaxe){ ?>
                        <div class="card-image">
                                <img src="<?php echo $_SESSION['public']."img/".$row->imaxe ?>" alt="<?php echo $row->titulo ?>">
                        </div>
                    <?php } ?>
                    <div class="card-content">
                        <?php if (!$row->imaxe){ ?>
                            <i class="grey-text material-icons medium">image</i>
                        <?php } ?>
                        <h4>
                            <?php echo $row->titulo ?>
                        </h4>
                        <strong>URL amigable:</strong> <?php echo $row->slug ?><br>
                        <strong>Data:</strong> <?php echo date("d/m/Y", strtotime($row->datap)) ?>
                    </div>
                    <div class="card-action">
                        <a href="<?php echo $_SESSION['home']."admin/novas/editar/".$row->id ?>" title="Editar">
                            <i class="material-icons">edit</i>
                        </a>
                        <?php $title = ($row->activo == 1) ? "Desactivar" : "Activar" ?>
                        <?php $color = ($row->activo == 1) ? "green-text" : "red-text" ?>
                        <?php $icono = ($row->activo == 1) ? "mood" : "mood_bad" ?>
                        <a href="<?php echo $_SESSION['home']."admin/novas/activar/".$row->id ?>" title="<?php echo $title ?>">
                            <i class="<?php echo $color ?> material-icons"><?php echo $icono ?></i>
                        </a>
                        <?php $title = ($row->home == 1) ? "Quitar da home" : "Mostrar na home" ?>
                        <?php $color = ($row->home == 1) ? "green-text" : "red-text" ?>
                        <a href="<?php echo $_SESSION['home']."admin/novas/home/".$row->id ?>" title="<?php echo $title ?>">
                            <i class="<?php echo $color ?> material-icons">home</i>
                        </a>
                        <a href="#" class="activator" title="Borrar">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>
                </div>
                <!--Confirmación de borrar-->
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Borrar nova<i class="material-icons right">close</i></span>
                    <p>
                        ¿Estás seguro de que queres borrar a nova<strong><?php echo $row->titulo ?></strong>?<br>
                        Esta acción non se pode desfacer.
                    </p>
                    <a href="<?php echo $_SESSION['home']."admin/novas/borrar/".$row->id ?>" title="Borrar">
                        <button class="btn waves-effect waves-light" type="button">Borrar
                            <i class="material-icons right">delete</i>
                        </button>
                    </a>
                </div>
            </div>
        </article>
    <?php } ?>
</div>