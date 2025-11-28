<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail; // si tu veux envoyer un mail
use Illuminate\Validation\ValidationException;

class PcoController extends Controller
{
    /**
     * Liste des rôles considérés comme PCO
     */
    protected static array $pcoRoles = ['director', 'super_admin', 'admin', 'developer', 'security'];

    /**
     * Vérifie que l'utilisateur courant est un PCO autorisé.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    protected function ensurePco(): User
    {
        $user = Auth::user();
        if (! $user || ! in_array($user->role, self::$pcoRoles)) {
            abort(403, 'Accès non autorisé.');
        }

        return $user;
    }

    /**
     * Retourne la route du dashboard principale selon le rôle de l'utilisateur.
     * Utilise la méthode du modèle User si possible.
     */
    public static function dashboardRouteForUser(User $user): string
    {
        return $user->dashboardRoute();
    }

    /**
     * Tableau de bord général PCO : redirige vers la bonne vue selon rôle.
     */
    public function dashboard()
    {
        $user = $this->ensurePco();

        // Récupération des données spécifiques selon rôle
        $data = [];

        switch ($user->role) {
            case 'director':
                $data = $this->getDirectorDashboardData();
                return view('auth.director.dashboard', compact('user', 'data'));

            case 'super_admin':
            case 'admin':
                $data = $this->getAdminDashboardData();
                return view('auth.admin.dashboard', compact('user', 'data'));

            case 'developer':
                $data = $this->getDeveloperDashboardData();
                return view('auth.developer.dashboard', compact('user', 'data'));

            case 'security':
                $data = $this->getSecurityDashboardData();
                return view('auth.hacker.dashboard', compact('user', 'data'));

            default:
                // Redirection par défaut si rôle inconnu
                return view('auth.user.dashboard', compact('user'));
        }
    }

    /**
     * Méthode spécifique pour dashboard directeur (nécessaire pour la route dédiée)
     */
    public function dashboard_director()
    {
        $user = $this->ensurePco();
        $data = $this->getDirectorDashboardData();
        return view('auth.director.dashboard', compact('user', 'data'));
    }

    /**
     * Méthode spécifique pour dashboard admin (nécessaire pour la route dédiée)
     */
    public function dashboard_admin()
    {
        $user = $this->ensurePco();
        $data = $this->getAdminDashboardData();
        return view('auth.admin.dashboard', compact('user', 'data'));
    }

    /**
     * Méthode spécifique pour dashboard developer
     */
    public function dashboard_developer()
    {
        $user = $this->ensurePco();
        $data = $this->getDeveloperDashboardData();
        return view('auth.developer.dashboard', compact('user', 'data'));
    }

    /**
     * Méthode spécifique pour dashboard security
     */
    public function dashboard_security()
    {
        $user = $this->ensurePco();
        $data = $this->getSecurityDashboardData();
        return view('auth.hacker.dashboard', compact('user', 'data'));
    }

    /**
     * Données pour le tableau de bord du Directeur
     */
    protected function getDirectorDashboardData(): array
    {
        $totalUsers = User::count();
        $totalArticles = Article::count();

        // Liste des articles avec nom de l'auteur, date, etc
        $articles = Article::with('author')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'author_name' => $article->author ? trim($article->author->first_name.' '.$article->author->last_name) : 'Anonyme',
                    'published_at' => $article->created_at->toDateTimeString(),
                    'can_edit' => Auth::check() && (Auth::id() === $article->user_id || in_array(Auth::user()->role, ['super_admin', 'admin'])),
                ];
            })
            ->toArray();

        // Liste des utilisateurs récents (limité à 50)
        $usersList = User::select('id', 'first_name', 'last_name', 'email', 'role')
                         ->orderBy('created_at', 'desc')
                         ->limit(50)
                         ->get()
                         ->toArray();

        // Liste des PCOs récents (limité à 50)
        $pcosList = User::whereIn('role', self::$pcoRoles)
                        ->orderBy('created_at', 'desc')
                        ->limit(50)
                        ->get(['id', 'first_name', 'last_name', 'email', 'role'])
                        ->toArray();

        $activity = []; // à remplir si besoin
        $health = [];   // à remplir si besoin
        $kpis = [
            'usersCount' => $totalUsers,
            'articlesCount' => $totalArticles,
            'proposals30d' => $this->countProposalsLast30Days(),
            'resolutionRate' => $this->calculateResolutionRate(),
        ];

        $lastSync = now()->format('d/m/Y H:i');

        return [
            'totalUsers' => $totalUsers,
            'totalArticles' => $totalArticles,
            'articles' => $articles,
            'usersList' => $usersList,
            'pcosList' => $pcosList,
            'activity' => $activity,
            'health' => $health,
            'kpis' => $kpis,
            'lastSync' => $lastSync,
        ];
    }

    /**
     * Exemple de méthode calculant le nombre de propositions faites dans les 30 derniers jours
     * (Doit être adaptée selon ta structure de données)
     */
    protected function countProposalsLast30Days(): int
    {
        // Hypothèse: Article = proposition (à adapter)
        return Article::where('created_at', '>=', now()->subDays(30))->count();
    }

    /**
     * Exemple de méthode calculant un taux de résolution
     * (Doit être adaptée selon ta structure de données)
     */
    protected function calculateResolutionRate(): float
    {
        // Hypothèse: Articles traités / articles totaux (à adapter)
        $total = Article::count();
        if ($total === 0) {
            return 0;
        }
        $resolved = Article::whereNotNull('updated_at')->count(); // exemple basique
        return round(($resolved / $total) * 100, 2);
    }

    /**
     * Données pour le tableau de bord Admin (super_admin/admin)
     */
    protected function getAdminDashboardData(): array
    {
        $pcos = User::whereIn('role', self::$pcoRoles)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();

        return [
            'pcos' => $pcos,
            // Ajouter d'autres données utiles admin ici
        ];
    }

    /**
     * Données pour le tableau de bord Developer
     */
    protected function getDeveloperDashboardData(): array
    {
        return [
            'logs' => [], // À connecter à un système de logs si possible
            'recentDeployments' => [], // À connecter à un système de déploiement ou CI/CD
        ];
    }

    /**
     * Données pour le tableau de bord Hacker (security)
     */
    protected function getSecurityDashboardData(): array
    {
        return [
            'alerts' => [],  // À connecter aux alertes de sécurité
            'incidents' => [], // À connecter aux incidents de sécurité
            'audits' => [], // À connecter aux audits de sécurité
        ];
    }

    /**
     * Récupère la liste des PCOs (utilisateurs avec roles spécifiques)
     * GET /api/director/pcos
     */
    public function pcosIndex()
    {
        $this->ensurePco();

        $pcos = User::whereIn('role', self::$pcoRoles)
            ->orderByDesc('last_login_at')
            ->limit(100)
            ->get([
                'id', 'first_name', 'last_name', 'email', 'role',
                'last_login_at', 'must_change_password', 'two_factor_enabled',
            ])
            ->toArray();

        $list = collect($pcos)->map(function ($p) {
            return [
                'id' => $p['id'],
                'name' => trim($p['first_name'].' '.$p['last_name']),
                'email' => $p['email'],
                'pco_type' => $p['role'],
                'last_login' => $p['last_login_at'],
                'must_change_password' => $p['must_change_password'] ?? false,
                'two_factor_enabled' => $p['two_factor_enabled'] ?? false,
            ];
        });

        return response()->json($list);
    }

    /**
     * Crée un PCO (POST)
     * POST /api/director/pcos
     */
    public function createPco(Request $request)
    {
        $this->ensurePco();

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
                'pco_type' => ['required', 'string', Rule::in(['director', 'admin', 'developer', 'security'])],
            ]);
        } catch (ValidationException $e) {
            // Retourner les erreurs en JSON clair pour le frontend
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Validation échouée',
            ], 422);
        }

        // Découpe le nom complet en prénom et nom de famille
        [$first, $last] = $this->splitName($data['name']);

        // Génère un mot de passe temporaire aléatoire de 10 caractères
        $password = Str::random(10);

        // Créer l'utilisateur
        $user = User::create([
            'first_name' => $first,
            'last_name' => $last,
            'email' => $data['email'],
            'password' => Hash::make($password),
            'role' => $data['pco_type'],
            'must_change_password' => true,
        ]);

        // Optionnel: envoi d'un email au nouvel utilisateur
        /*
        try {
            Mail::to($user->email)->send(new \App\Mail\NewPcoMail($user, $password));
        } catch (\Exception $e) {
            // Log l'erreur mais ne bloque pas la création
            \Log::error("Erreur envoi mail création PCO : ".$e->getMessage());
        }
        */

        return response()->json([
            'success' => true,
            'user_id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['pco_type'],
        ]);
    }

    /**
     * Découpe un nom complet en prénom et nom.
     *
     * @return array [first_name, last_name]
     */
    protected function splitName(string $name): array
    {
        $parts = preg_split('/\s+/', trim($name));
        if (count($parts) === 1) {
            return [$parts[0], ''];
        }
        $first = array_shift($parts);
        $last = implode(' ', $parts);

        return [$first, $last];
    }

    // ... Les autres méthodes spécifiques (auditRecent, healthSummary, publishBulletin) restent inchangées ...
}

