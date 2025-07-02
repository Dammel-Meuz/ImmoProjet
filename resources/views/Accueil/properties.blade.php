@extends('welcome')
@section('content')
<style>
:root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --background-light: #ecf0f1;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background: var(--secondary-color);
            transition: all 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
            left: 0;
        }

        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .page-header .container {
            position: relative;
            z-index: 2;
        }

        /* Search Section */
        .search-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: -60px;
            position: relative;
            z-index: 3;
        }

        .search-form .form-control, .search-form .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-form .form-control:focus, .search-form .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .search-btn {
            background: linear-gradient(135deg, var(--secondary-color), #2980b9);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }

        /* Properties Grid */
        .properties-section {
            padding: 80px 0;
            background: var(--background-light);
        }

        .property-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            position: relative;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .property-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .property-card:hover .property-image img {
            transform: scale(1.1);
        }

        .property-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }

        .property-badge.sale {
            background: var(--accent-color);
        }

        .property-badge.rent {
            background: var(--secondary-color);
        }

        .property-content {
            padding: 25px;
        }

        .property-price2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .property-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .property-location {
            color: var(--text-light);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .property-features {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .feature-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .feature-item i {
            margin-right: 5px;
            color: var(--secondary-color);
        }

        .property-actions {
            display: flex;
            gap: 10px;
        }

        .btn-view {
            flex: 1;
            background: linear-gradient(135deg, var(--secondary-color), #2980b9);
            border: none;
            padding: 10px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-favorite {
            background: white;
            border: 2px solid #e9ecef;
            padding: 10px 15px;
            border-radius: 8px;
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        .btn-favorite:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        /* Filters */
        .filters-section {
            background: white;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .filter-item {
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .filter-btn {
            background: transparent;
            border: 2px solid #e9ecef;
            padding: 8px 15px;
            border-radius: 20px;
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        .filter-btn.active, .filter-btn:hover {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }

        /* Pagination */
        .pagination-section {
            padding: 40px 0;
            text-align: center;
        }

        .pagination .page-link {
            border: none;
            color: var(--text-light);
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--secondary-color);
            color: white;
        }

        .pagination .page-item.active .page-link {
            background: var(--secondary-color);
            color: white;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            padding: 50px 0 20px;
        }

        .footer h5 {
            color: white;
            margin-bottom: 20px;
        }

        .footer p {
            color: rgba(255,255,255,0.8);
            margin-bottom: 10px;
        }

        .social-icons a {
            color: rgba(255,255,255,0.8);
            font-size: 1.2rem;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .property-features {
                flex-direction: column;
                gap: 10px;
            }
            
            .search-form .row {
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4 fw-bold mb-3">Nos Propriétés</h1>
                    <p class="lead">Découvrez notre sélection exclusive de biens immobiliers</p>
                    <div class="mt-4">
                        <span class="badge bg-light text-dark me-2 p-2">
                            <i class="fas fa-home me-1"></i>
                            <span id="totalProperties">47</span> Propriétés disponibles
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="container">
        <div class="search-section">
            <h3 class="text-center mb-4">
                <i class="fas fa-search me-2 text-primary"></i>
                Rechercher votre bien idéal
            </h3>
            <form class="search-form">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" id="propertyType">
                            <option value="">Type de bien</option>
                            <option value="appartement">Appartement</option>
                            <option value="maison">Maison</option>
                            <option value="villa">Villa</option>
                            <option value="terrain">Terrain</option>
                            <option value="bureau">Bureau</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="transactionType">
                            <option value="">Type de transaction</option>
                            <option value="vente">Vente</option>
                            <option value="location">Location</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="location" placeholder="Localisation">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="priceRange">
                            <option value="">Budget</option>
                            <option value="0-100000">0 - 100 000 €</option>
                            <option value="100000-300000">100 000 - 300 000 €</option>
                            <option value="300000-500000">300 000 - 500 000 €</option>
                            <option value="500000+">500 000 € +</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-2">
                        <select class="form-select" id="rooms">
                            <option value="">Pièces</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5+">5+</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="bedrooms">
                            <option value="">Chambres</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4+">4+</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" id="minSurface" placeholder="Surface min (m²)">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" id="maxSurface" placeholder="Surface max (m²)">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn search-btn w-100">
                            <i class="fas fa-search me-1"></i>
                            Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Filters -->
    <section class="filters-section">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center">
                <span class="me-3 fw-semibold">Filtres :</span>
                <button class="btn filter-btn active filter-item" data-filter="all">Tous</button>
                <button class="btn filter-btn filter-item" data-filter="vente">Vente</button>
                <button class="btn filter-btn filter-item" data-filter="location">Location</button>
                <button class="btn filter-btn filter-item" data-filter="recent">Récent</button>
                <button class="btn filter-btn filter-item" data-filter="price-asc">Prix croissant</button>
                <button class="btn filter-btn filter-item" data-filter="price-desc">Prix décroissant</button>
            </div>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="properties-section">
        <div class="container">
            <div class="row" id="propertiesGrid">
                @foreach ($propriétés as $propriété )
                    
                
                <div class="col-lg-4 col-md-6 property-item" data-type="vente" data-price="285000">
                    <div class="property-card">
                        <div class="property-image">
                            @if ($propriété->images->isEmpty()) 
                                <img src="{{ asset('img/default.png') }}" alt="Image" class="img-fluid">
                            @else
                            <img src="{{ asset('biens/' . $propriété->images[0]->image_path) }}" alt="Appartement moderne">
                            @endif
                            @if ($propriété->transaction_type == 'location')
                            <div class="property-badge rent ">À Louer</div>
                            @else
                            
                            <div class="property-badge sale">À Vendre</div>
                            @endif
                        </div>
                        <div class="property-content">
                            <div class="property-price2">{{ $propriété->prix }} Fr {{ $propriété->transaction_type == 'location' ? '/mois' : '' }}</div>
                            <h4 class="property-title">{{ $propriété->title }}</h4>
                            <div class="property-location">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $propriété->address }}
                            </div>
                            <div class="property-features">
                                @if ($propriété->nb_chambres)
                                <div class="feature-item">
                                    <i class="fas fa-bed"></i>
                                    {{ $propriété->nb_chambres }} 
                                </div>
                                    
                                @endif
                                @if ($propriété->nb_salles_bain)
                                <div class="feature-item">
                                    <i class="fas fa-bath"></i>
                                    {{ $propriété->nb_salles_bain }}
                                </div>
                               
                                @endif
                                <div class="feature-item">
                                    <i class="fas fa-ruler-combined"></i>
                                    {{ $propriété->surface_habitable }} m²
                                </div>
                            </div>
                            <div class="property-actions">
                                <a href="{{ route('accueil.bien.show', $propriété->id) }}" class="btn btn-view">
                                    <i class="fas fa-eye me-1"></i>
                                    Voir détails
                                </a>
                                <button class="btn btn-favorite" 
                                        data-propertie-id="{{ $propriété->id }}" 
                                        onclick="toggleFavorite(this)">
                                    <i class="{{ auth()->check() && auth()->user()->favorites->contains('propertie_id', $propriété->id) ? 'fas' : 'far' }} fa-heart "></i>
                                </button>
                                {{-- <button class="btn btn-favorite" 
                                    data-propertie-id="{{ $propriété->id }}" 
                                    onclick="toggleFavorite(this)">
                                <i class="{{ auth()->user()->favorites ? 'fas' : 'far' }} fa-heart"></i>
                            </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <!-- Pagination -->
                <div class="pagination-section">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
    </section>  

    <script>

            function toggleFavorite(button) {
                const propertieId = button.getAttribute('data-propertie-id');
              
                fetch('/favoris/' + propertieId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        propertie_id: propertieId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const icon = button.querySelector('i');
                        icon.classList.toggle('far');
                        icon.classList.toggle('fas');
                    }
                })
                .catch(error => console.error('Error:', error));
                }


                function toggleFavorite(button) {
    const propertieId = button.getAttribute('data-propertie-id');
    
    fetch('/favorites/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            propertie_id: propertieId
        })
    })
    .then(response => response.json())
    .then(data => {
        const icon = button.querySelector('i');
        if (data.status === 'added') {
            icon.classList.remove('far');
            icon.classList.add('fas');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
        }
    })
    .catch(error => console.error('Error:', error));
}
    // Dans la fonction toggleFavorite, après le changement de classe
$(icon).animate({ scale: 1.2 }, 200).animate({ scale: 1 }, 200);
    </script>

    @endsection