<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations - Luxora</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles spécifiques à cette page */
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 20px;
        }
        
        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
        }
        
        .table-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .table-header i {
            margin-right: 10px;
        }
        
        .custom-table {
            margin: 0;
        }
        
        .custom-table thead {
            background-color: #f8f9fa;
        }
        
        .custom-table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 15px 20px;
        }
        
        .custom-table td {
            padding: 15px 20px;
            vertical-align: middle;
            border-color: #f1f3f4;
        }
        
        .custom-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .custom-table tbody tr:hover {
            background-color: #f8f9ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-en_attente {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .status-accepte {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-refuse {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .property-img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #e9ecef;
        }
        
        .client-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }
        
        .action-btn {
            padding: 6px 15px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            margin: 2px;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-accept {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        
        .btn-accept:hover {
            background: linear-gradient(135deg, #218838 0%, #1da57c 100%);
        }
        
        .btn-reject {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: white;
        }
        
        .btn-reject:hover {
            background: linear-gradient(135deg, #c82333 0%, #e8590c 100%);
        }
        
        .btn-reject:disabled,
        .btn-accept:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }
        
        .no-data {
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
        }
        
        .no-data i {
            font-size: 60px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .date-cell {
            min-width: 120px;
        }
        
        .property-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .property-location {
            color: #7f8c8d;
            font-size: 12px;
        }
        
        .client-name {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .client-email {
            color: #7f8c8d;
            font-size: 12px;
        }
        
        .logement-badge {
            font-size: 10px;
            padding: 3px 8px;
            margin-left: 5px;
        }
        
        .action-group {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }
        
        .btn-change {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }
        
        .btn-change:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
        }
        
        /* Header personnalisé */
        .custom-header {
            background: white;
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }
        
        .header-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #374151;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .header-link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .header-link:hover {
            color: #3730a3;
            text-decoration: underline;
        }
        
        .header-link-indigo {
            color: #4f46e5;
        }
        
        .header-link-indigo:hover {
            color: #3730a3;
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                border: none;
            }
            
            .custom-table th, 
            .custom-table td {
                padding: 12px 10px;
                font-size: 14px;
            }
            
            .action-btn {
                padding: 5px 10px;
                font-size: 12px;
            }
            
            .action-group {
                flex-direction: column;
                gap: 5px;
            }
            
            .header-title {
                font-size: 1.5rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header personnalisé -->
    <div class="custom-header">
        <div class="container-fluid">
            <div class="header-title">
                <span>Gestion des Réservations</span>
                
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <a href="{{ route('home') }}" class="header-link">
                        <i class="fas fa-home me-1"></i> Accueil
                    </a>
                    
                    @if(auth()->check() && auth()->user()->role === 'locateur')
                        <a href="{{ route('locateur.reservations') }}" class="header-link header-link-indigo">
                            <i class="fas fa-calendar-check me-1"></i> Mes Réservations
                        </a>
                    @endif
                    
                    @if(auth()->check() && auth()->user()->role === 'locateur')
                        <a href="{{ route('dashboard') }}" class="header-link">
                            <i class="fas fa-tachometer-alt me-1"></i> Tableau de bord
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-calendar-check"></i> Gestion des Réservations</h3>
                <p class="mb-0 opacity-75">Gérez toutes les demandes de réservation de vos propriétés</p>
            </div>
            
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-home me-1"></i> Logement</th>
                            <th><i class="fas fa-user me-1"></i> Client</th>
                            <th><i class="fas fa-info-circle me-1"></i> Statut</th>
                            <th><i class="fas fa-calendar-alt me-1"></i> Date</th>
                            <th class="text-end"><i class="fas fa-cogs me-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $res)
                        <tr>
                            <!-- Logement Column -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @if($res->logment && $res->logment->images && $res->logment->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $res->logment->images->first()->image_url) }}" 
                                                 alt="{{ $res->logment->titre }}" 
                                                 class="property-img">
                                        @else
                                            <div class="property-img d-flex align-items-center justify-content-center bg-light">
                                                <i class="fas fa-home fa-lg text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="property-title">
                                            {{ $res->logment->titre ?? 'Logement non disponible' }}
                                            @if($res->status == 'accepte')
                                                <span class="badge bg-danger logement-badge">Non disponible</span>
                                            @endif
                                        </div>
                                        <div class="property-location">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $res->logment->ville ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Client Column -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="client-avatar">
                                            {{ substr($res->client->name ?? '?', 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="client-name">
                                            {{ $res->client->name ?? 'Client inconnu' }}
                                        </div>
                                        <div class="client-email">
                                            {{ $res->client->email ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Status Column -->
                            <td>
                                @php
                                    $statusClasses = [
                                        'en_attente' => 'status-en_attente',
                                        'accepte' => 'status-accepte',
                                        'refuse' => 'status-refuse'
                                    ];
                                    $statusTexts = [
                                        'en_attente' => 'En attente',
                                        'accepte' => 'Acceptée',
                                        'refuse' => 'Refusée'
                                    ];
                                    $statusClass = $statusClasses[$res->status] ?? 'status-en_attente';
                                    $statusText = $statusTexts[$res->status] ?? 'En attente';
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            
                            <!-- Date Column -->
                            <td class="date-cell">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">{{ $res->created_at->format('d/m/Y') }}</span>
                                    <small class="text-muted">{{ $res->created_at->format('H:i') }}</small>
                                </div>
                            </td>
                            
                            <!-- Actions Column -->
                            <td class="text-end">
                                <div class="action-group">
                                    @if($res->status == 'en_attente')
                                        <!-- Quand c'est en attente, afficher les deux boutons -->
                                        <form action="{{ route('reservation.accepter', $res->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn btn-accept">
                                                <i class="fas fa-check me-1"></i> Accepter
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('reservation.refuser', $res->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn btn-reject">
                                                <i class="fas fa-times me-1"></i> Refuser
                                            </button>
                                        </form>
                                    
                                    @elseif($res->status == 'accepte')
                                        <!-- Quand c'est accepté, garder le bouton Refuser -->
                                        <form action="{{ route('reservation.accepter', $res->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn btn-accept" disabled>
                                                <i class="fas fa-check me-1"></i> Acceptée
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('reservation.refuser', $res->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn btn-change">
                                                <i class="fas fa-sync-alt me-1"></i> Changer en Refus
                                            </button>
                                        </form>
                                    
                                    @elseif($res->status == 'refuse')
                                        <!-- Quand c'est refusé, garder le bouton Accepter -->
                                        <form action="{{ route('reservation.accepter', $res->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn btn-change">
                                                <i class="fas fa-sync-alt me-1"></i> Changer en Accepté
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('reservation.refuser', $res->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn btn-reject" disabled>
                                                <i class="fas fa-times me-1"></i> Refusée
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="no-data">
                                    <i class="fas fa-calendar-times"></i>
                                    <h4 class="mt-3 mb-2">Aucune réservation</h4>
                                    <p class="text-muted">Vous n'avez aucune demande de réservation pour le moment.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($reservations->count() > 0)
            <div class="table-footer p-3 bg-light text-center">
                <p class="mb-0 text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Affichage de {{ $reservations->count() }} réservation{{ $reservations->count() > 1 ? 's' : '' }}
                </p>
            </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confirmation pour les actions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button');
                const action = button.textContent.trim();
                
                if (action.includes('Refuser') && !button.disabled) {
                    if (!confirm('Êtes-vous sûr de vouloir refuser cette réservation ?')) {
                        e.preventDefault();
                    }
                } else if (action.includes('Accepter') && !button.disabled) {
                    if (!confirm('Êtes-vous sûr de vouloir accepter cette réservation ?')) {
                        e.preventDefault();
                    }
                } else if (action.includes('Changer')) {
                    const newStatus = action.includes('Accepté') ? 'accepter' : 'refuser';
                    if (!confirm(`Êtes-vous sûr de vouloir changer le statut en "${newStatus}" ?`)) {
                        e.preventDefault();
                    }
                }
            });
        });

        // Animation pour les lignes
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.custom-table tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            // Auto-dismiss alerts
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    if (alert.classList.contains('alert-dismissible')) {
                        const closeButton = alert.querySelector('.btn-close');
                        if (closeButton) closeButton.click();
                    }
                });
            }, 5000);
        });
    </script>
</body>
</html>