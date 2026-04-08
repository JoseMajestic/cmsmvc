<h3>
    <a href="/public/" title="Inicio">Inicio</a> <span>| Novas</span>
</h3>
<div class="row">
    <?php foreach ($datos as $row){ ?>
        <article class="col m12 l6">
            <div class="card horizontal small">
                <div class="card-image">
                    <img src="/public/img/<?php echo $row->imaxe ?>" alt="<?php echo $row->titulo ?>">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <h4><?php echo $row->titulo ?></h4>
                        <p><?php echo $row->extracto ?></p>
                    </div>
                    <div class="card-info">
                        <p><?php echo date("d/m/Y", strtotime($row->datap)) ?></p>
                    </div>
                    <div class="card-action">
                        <a href="/public/nova/<?php echo $row->slug ?>">Ler máis</a>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>