<div class="error-404-container">
    <div class="error-404-content">
        <div class="error-404-number">404</div>
        <div class="error-404-text">
            <h1>Página No Encontrada</h1>
            <p class="error-subtitle">El recurso que buscas puede haber sido destruido, eliminado o nunca existió.</p>
        </div>
        
        <div class="error-404-dragon">
            <div class="dragon-ball">
                <div class="ball-star"></div>
            </div>
            <div class="error-message">
                <p class="power-level">POWER LEVEL: OVER 9000!</p>
                <p class="error-detail">Pero esta página sigue siendo imposible de encontrar...</p>
            </div>
        </div>
        
        <div class="error-404-actions">
            <a href="/public/" class="btn-large waves-effect waves-light red">
                <i class="material-icons left">home</i>
                Volver al Inicio
            </a>
            <a href="/public/novas" class="btn-large waves-effect waves-grey">
                <i class="material-icons left">article</i>
                Ver Noticias
            </a>
        </div>
        
        <div class="error-404-suggestions">
            <h3>Quizás buscabas:</h3>
            <div class="suggestion-cards">
                <div class="suggestion-card">
                    <div class="card-content">
                        <i class="material-icons large red-text">article</i>
                        <h5>Últimas Noticias</h5>
                        <p>Descubre las últimas batallas y transformaciones</p>
                        <a href="/public/novas" class="btn-small red">Ver Noticias</a>
                    </div>
                </div>
                <div class="suggestion-card">
                    <div class="card-content">
                        <i class="material-icons large red-text">info</i>
                        <h5>Acerca de</h5>
                        <p>Conoce más sobre este CMS Dragon Ball</p>
                        <a href="/public/acercade" class="btn-small red">Más Info</a>
                    </div>
                </div>
                <div class="suggestion-card">
                    <div class="card-content">
                        <i class="material-icons large red-text">contact_mail</i>
                        <h5>Contacto</h5>
                        <p>Envía un mensaje si necesitas ayuda</p>
                        <a href="/public/contacto" class="btn-small red">Contactar</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="error-404-footer">
            <p class="error-quote">
                "Incluso los guerreros más poderosos a veces se pierden en el camino..."
            </p>
            <p class="error-back">
                <small>
                    <i class="material-icons tiny">sentiment_very_dissatisfied</i>
                    Error 404 - Página no encontrada
                </small>
            </p>
        </div>
    </div>
</div>

<style>
.error-404-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    padding: 20px;
}

.error-404-content {
    text-align: center;
    max-width: 800px;
    width: 100%;
}

.error-404-number {
    font-size: 12rem;
    font-weight: bold;
    color: #d32f2f;
    text-shadow: 4px 4px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    animation: pulse 2s infinite;
}

.error-404-text h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 10px;
}

.error-subtitle {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 40px;
}

.error-404-dragon {
    margin: 40px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.dragon-ball {
    width: 80px;
    height: 80px;
    background: radial-gradient(circle at 30% 30%, #ff6b35, #d32f2f);
    border-radius: 50%;
    position: relative;
    box-shadow: 0 4px 15px rgba(211, 47, 47, 0.3);
    animation: float 3s ease-in-out infinite;
}

.ball-star {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0;
    height: 0;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 25px solid #ffd700;
    transform: translate(-50%, -50%) rotate(180deg);
}

.error-message {
    text-align: left;
}

.power-level {
    font-size: 1.5rem;
    font-weight: bold;
    color: #d32f2f;
    margin: 0;
}

.error-detail {
    font-size: 1rem;
    color: #666;
    margin: 5px 0 0 0;
}

.error-404-actions {
    margin: 40px 0;
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.error-404-suggestions {
    margin: 60px 0;
}

.error-404-suggestions h3 {
    color: #333;
    margin-bottom: 30px;
}

.suggestion-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.suggestion-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.suggestion-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.suggestion-card h5 {
    color: #d32f2f;
    margin: 15px 0 10px 0;
}

.suggestion-card p {
    color: #666;
    margin-bottom: 15px;
}

.error-404-footer {
    margin-top: 60px;
    padding-top: 30px;
    border-top: 1px solid #e0e0e0;
}

.error-quote {
    font-style: italic;
    color: #666;
    margin-bottom: 10px;
}

.error-back {
    color: #999;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@media screen and (max-width: 768px) {
    .error-404-number {
        font-size: 8rem;
    }
    
    .error-404-text h1 {
        font-size: 2rem;
    }
    
    .error-404-dragon {
        flex-direction: column;
        gap: 20px;
    }
    
    .error-message {
        text-align: center;
    }
    
    .error-404-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .suggestion-cards {
        grid-template-columns: 1fr;
    }
}
</style>