class UserManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function authenticateUser($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data for further processing
        }
        return null; // Authentication failed
    }

    public function redirectUser($user) {
        if ($user['status'] === 'active') {
            switch ($user['account_type']) {
                case 1:
                    header("Location: dashboard.php");
                    break;
                case 2:
                    header("Location: buyer_dashboard.php");
                    break;
                case 3:
                    header("Location: seller_dashboard.php");
                    break;
                case 4:
                    header("Location: agent_dashboard.php");
                    break;
            }
            exit();
        } else {
            echo "Account suspended.";
        }
    }
}
