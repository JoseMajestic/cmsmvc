<h3>Contacto</h3>
<div class="row">
    <div class="col s12 m8 offset-m2">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Contacta con DragonBall Saga CMS</span>
                <p class="grey-text">¿Tienes preguntas, sugerencias o quieres reportar un error? Estamos aquí para ayudarte.</p>
                
                <form id="contactForm" method="POST" action="/public/contacto">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person</i>
                            <input id="nombre" type="text" name="nombre" required>
                            <label for="nombre">Nombre *</label>
                            <span class="helper-text" data-error="Este campo es obligatorio"></span>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" name="email" required>
                            <label for="email">Email *</label>
                            <span class="helper-text" data-error="Introduce un email válido"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">subject</i>
                            <input id="asunto" type="text" name="asunto" required>
                            <label for="asunto">Asunto *</label>
                            <span class="helper-text" data-error="Este campo es obligatorio"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">message</i>
                            <textarea id="mensaje" name="mensaje" class="materialize-textarea" required></textarea>
                            <label for="mensaje">Mensaje *</label>
                            <span class="helper-text" data-error="Este campo es obligatorio"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">smartphone</i>
                            <input id="telefono" type="tel" name="telefono">
                            <label for="telefono">Teléfono (opcional)</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">category</i>
                            <select id="tipo" name="tipo">
                                <option value="" disabled selected>Selecciona un tipo</option>
                                <option value="consulta">Consulta general</option>
                                <option value="soporte">Soporte técnico</option>
                                <option value="sugerencia">Sugerencia</option>
                                <option value="error">Reportar error</option>
                                <option value="colaboracion">Colaboración</option>
                            </select>
                            <label>Tipo de consulta</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s12">
                            <label>
                                <input type="checkbox" id="terminos" name="terminos" required>
                                <span>Acepto la política de privacidad y términos de uso *</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s12">
                            <div class="g-recaptcha" data-sitekey="your-site-key"></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s12">
                            <button class="btn waves-effect waves-light red" type="submit" name="action">
                                <i class="material-icons left">send</i>
                                Enviar Mensaje
                            </button>
                            <button class="btn-flat waves-effect waves-grey" type="reset" name="reset">
                                <i class="material-icons left">clear</i>
                                Limpiar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Información de contacto adicional -->
        <div class="card blue-grey lighten-5">
            <div class="card-content">
                <span class="card-title">Otras formas de contacto</span>
                <div class="row">
                    <div class="col s12 m6">
                        <h6><i class="material-icons tiny">email</i> Email</h6>
                        <p>info@dragonballsaga.cms</p>
                    </div>
                    <div class="col s12 m6">
                        <h6><i class="material-icons tiny">phone</i> Teléfono</h6>
                        <p>+34 900 123 456</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <h6><i class="material-icons tiny">schedule</i> Horario</h6>
                        <p>Lunes a Viernes: 9:00 - 18:00</p>
                    </div>
                    <div class="col s12 m6">
                        <h6><i class="material-icons tiny">location_on</i> Ubicación</h6>
                        <p>DAWM2026 - Centro de Formación</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <h4><i class="material-icons green-text">check_circle</i> Mensaje Enviado</h4>
        <p>Tu mensaje ha sido enviado correctamente. Nos pondremos en contacto contigo lo antes posible.</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div>