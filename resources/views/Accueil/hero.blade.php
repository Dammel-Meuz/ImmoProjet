<section class="hero-section" id="accueil">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="hero-title">Trouvez la Maison de Vos Rêves</h1>
                        <p class="hero-subtitle">Avec plus de 15 ans d'expérience, nous vous accompagnons dans tous vos projets immobiliers</p>
                        <a href="{{ route('accueil.biens') }}" class="btn btn-primary-custom">
                            <i class="fas fa-search me-2"></i>Découvrir nos biens
                        </a>
                    </div>
                    
                    <div class="search-form">
                        <h4 class="mb-3">Recherche rapide</h4>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-select">
                                        <option>Type de bien</option>
                                        <option>Appartement</option>
                                        <option>Maison</option>
                                        <option>Villa</option>
                                        <option>Bureau</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select">
                                        <option>Transaction</option>
                                        <option>Vente</option>
                                        <option>Location</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Ville ou quartier">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" placeholder="Prix minimum">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" placeholder="Prix maximum">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-custom w-100">
                                        <i class="fas fa-search me-2"></i>Rechercher
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>