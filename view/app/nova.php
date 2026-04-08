<h3>
    <a href="/public/" title="Inicio">Inicio</a> <span>| </span>
    <a href="/public/novas" title="Novas">Novas</a> <span>| </span>
    <span><?php echo $datos->titulo ?></span>
</h3>
<div class="row">
    <article class="col s12">
        <div class="card horizontal large nova">
            <div class="card-image">
                <img src="/public/img/<?php echo $datos->imaxe ?>" alt="<?php echo $datos->titulo ?>">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <h4><?php echo $datos->titulo ?></h4>
                    <p><?php echo $datos->extracto ?></p>
                    <p><?php echo $datos->texto ?></p>
                    <br>
                    <p>
                        <strong>Data</strong>: <?php echo date("d/m/Y", strtotime($datos->datap)) ?><br>
                        <strong>Autor</strong>: <?php echo $datos->autor ?>
                    </p>
                </div>
                <div class="card-action">
                    <a href="/public/novas" class="btn waves-effect waves-light red">
                        <i class="material-icons left">arrow_back</i>
                        Volver a Noticias
                    </a>
                </div>
            </div>
        </div>
    </article>
</div>