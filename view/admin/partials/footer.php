</section>
</main>

<footer class="admin-footer">
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <h5 class="white-text">CMS Dragon Ball Saga</h5>
                <p class="grey-text text-lighten-4">
                    Panel de administración del sistema de gestión de contenido.
                </p>
            </div>
            <div class="col s12 m6">
                <h5 class="white-text">Enlaces Rápidos</h5>
                <ul>
                    <li><a href="/public/admin" class="grey-text text-lighten-3">Inicio Admin</a></li>
                    <li><a href="/public/admin/novas" class="grey-text text-lighten-3">Gestionar Novas</a></li>
                    <?php if ($_SESSION['usuarios'] == 1): ?>
                        <li><a href="/public/admin/usuarios" class="grey-text text-lighten-3">Gestionar Usuarios</a></li>
                    <?php endif; ?>
                    <li><a href="/public/" target="_blank" class="grey-text text-lighten-3">Ver Web</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                &copy; <?php echo date('Y'); ?> Dragon Ball Saga CMS - Desarrollado por Jose Makina de Guerra - DAWM2026
            </div>
        </div>
    </div>
</footer>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>